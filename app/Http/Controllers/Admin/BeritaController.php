<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BeritaController extends Controller
{
    // 1. TAMPILKAN DAFTAR BERITA
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    // 2. FORM TAMBAH BERITA
    public function create()
    {
        return view('admin.berita.create');
    }

    // 3. PROSES SIMPAN BERITA BARU
    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Batas 5MB
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul); // Slug Wajib
        $berita->konten = $request->konten;

        // Logika kompresi foto
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'berita/' . $filename;

            // Batasi lebar 1200px, kualitas 70%
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $encoded = $image->scaleDown(width: 1200)->toJpeg(70);

            Storage::disk('public')->put($path, $encoded);
            $berita->gambar = $path;
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    // 4. FORM EDIT BERITA (Ini yang tadi hilang)
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    // 5. PROSES UPDATE BERITA
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul); // Slug Wajib
        $berita->konten = $request->konten;

        // Logika update & kompresi foto
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'berita/' . $filename;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $encoded = $image->scaleDown(width: 1200)->toJpeg(70);

            Storage::disk('public')->put($path, $encoded);
            $berita->gambar = $path;
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // 6. PROSES HAPUS BERITA
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus fisik gambar
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}