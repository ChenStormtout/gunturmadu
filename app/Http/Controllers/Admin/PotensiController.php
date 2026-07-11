<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PotensiController extends Controller
{
    public function index()
    {
        $potensis = Potensi::latest()->get();
        return view('admin.potensi.index', compact('potensis'));
    }

    public function create()
    {
        return view('admin.potensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $potensi = new Potensi();
        $potensi->judul = $request->judul;
        $potensi->slug = Str::slug($request->judul);
        $potensi->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'potensi-desa/' . $filename;

            // Simpan gambar asli ke storage
            Storage::disk('public')->put($path, file_get_contents($file));

            // Gabungkan path gambar dengan pilihan posisi fokus user
            $potensi->gambar = $path . '|' . $request->input('fokus_gambar', 'object-center');
        }

        $potensi->save();
        return redirect()->route('admin.potensi.index')->with('success', 'Data potensi desa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $potensi = Potensi::findOrFail($id);
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $potensi = Potensi::findOrFail($id);
        $potensi->judul = $request->judul;
        $potensi->slug = Str::slug($request->judul);
        $potensi->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            // Bersihkan gambar lama dari server
            if ($potensi->gambar) {
                $oldPath = explode('|', $potensi->gambar)[0];
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'potensi-desa/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($file));

            // Simpan path baru + fokus baru
            $potensi->gambar = $path . '|' . $request->input('fokus_gambar', 'object-center');
        } else {
            // Jika tidak ganti gambar, update rujukan fokusnya saja
            if ($potensi->gambar) {
                $oldPath = explode('|', $potensi->gambar)[0];
                $potensi->gambar = $oldPath . '|' . $request->input('fokus_gambar', 'object-center');
            }
        }

        $potensi->save();
        return redirect()->route('admin.potensi.index')->with('success', 'Data potensi desa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $potensi = Potensi::findOrFail($id);
        if ($potensi->gambar) {
            $path = explode('|', $potensi->gambar)[0];
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $potensi->delete();
        return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil dihapus!');
    }
}