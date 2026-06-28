<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ImageManager; // Sesuaikan jika lu pakai v3 atau v2
// use Intervention\Image\ImageManager; // (Aktifkan jika v3)
// use Intervention\Image\Drivers\Gd\Driver;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul);
        $berita->konten = $request->konten;

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'berita-desa/' . $filename;

            // Proses simpan biasa/kompresi (contoh tanpa library khusus agar enteng)
            Storage::disk('public')->put($path, file_get_contents($file));

            // TRIK SAKTI: Gabungkan path gambar dengan class posisi objek pilihan user
            $berita->gambar = $path . '|' . $request->input('fokus_gambar', 'object-center');
        }

        $berita->save();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul);
        $berita->konten = $request->konten;

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            // Bersihkan file lama
            if ($berita->gambar) {
                $oldPath = explode('|', $berita->gambar)[0];
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'berita-desa/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($file));

            // Simpan path baru + fokus baru
            $berita->gambar = $path . '|' . $request->input('fokus_gambar', 'object-center');
        } else {
            // Jika tidak ganti gambar, tapi user mengubah rujukan posisi fokusnya saja
            if ($berita->gambar) {
                $oldPath = explode('|', $berita->gambar)[0];
                $berita->gambar = $oldPath . '|' . $request->input('fokus_gambar', 'object-center');
            }
        }

        $berita->save();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar) {
            $path = explode('|', $berita->gambar)[0];
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}