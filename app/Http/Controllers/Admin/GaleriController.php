<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// Panggil library kompresi gambar
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi awal inputan user
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg', 
        ]);

        // Antisipasi jika file gagal masuk ke server karena menabrak limit php.ini di hosting
        if (!$request->hasFile('gambar') || !$request->file('gambar')->isValid()) {
            return redirect()->back()->withErrors(['gambar' => 'File gambar tidak valid atau ukurannya terlalu besar untuk server ini.'])->withInput();
        }

        $galeri = new Galeri();
        $galeri->judul = $request->judul;

        try {
            // PROSES KOMPRESI GAMBAR
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.jpg'; // Paksa ekstensi jadi .jpg biar ringan
            $path = 'galeri-desa/' . $filename;

            // 1. Siapkan mesin pengolah gambar (Intervention Image v3)
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            // 2. Resize otomatis jika gambar terlalu lebar (maksimal 1200px) biar ga menuhin layar
            // 3. Kompres kualitas gambar menjadi 70% format JPEG (sangat menghemat size, tapi visual tetap bagus)
            $encoded = $image->scaleDown(width: 1200)->toJpeg(70);

            // 4. Simpan gambar yang sudah dikompres ke storage public (di-cast ke string agar kompatibel dengan disk put)
            Storage::disk('public')->put($path, (string) $encoded);

            // 5. Simpan lokasi path ke database
            $galeri->gambar = $path;
            $galeri->save();

            return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dikompres dan ditambahkan ke galeri!');

        } catch (\Exception $e) {
            // Jika RAM server hosting tidak kuat mengompres resolusi gambar yang terlalu raksasa, dia akan aman masuk ke sini
            return redirect()->back()->withErrors(['gambar' => 'Gagal mengompres gambar. RAM Server tidak mencukupi untuk memproses resolusi gambar ini.'])->withInput();
        }
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Hapus file fisik gambar dari storage sebelum menghapus data di database
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus!');
    }
}