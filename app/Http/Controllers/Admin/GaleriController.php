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
        // max:2048 kita hapus, biarkan upload sebesar apapun (selama kuat di php.ini)
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg', 
        ]);

        $galeri = new Galeri();
        $galeri->judul = $request->judul;

        // PROSES KOMPRESI GAMBAR
        $file = $request->file('gambar');
        $filename = time() . '_' . uniqid() . '.jpg'; // Paksa ekstensi jadi .jpg biar ringan
        $path = 'galeri-desa/' . $filename;

        // 1. Siapkan mesin pengolah gambar
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        // 2. Resize otomatis jika gambar terlalu lebar (maksimal 1200px) biar ga menuhin layar
        // 3. Kompres kualitas gambar menjadi 70% format JPEG (sangat menghemat size, tapi visual tetap bagus)
        $encoded = $image->scaleDown(width: 1200)->toJpeg(70);

        // 4. Simpan gambar yang sudah dikompres ke storage public
        Storage::disk('public')->put($path, $encoded);

        // 5. Simpan lokasi path ke database
        $galeri->gambar = $path;
        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dikompres dan ditambahkan ke galeri!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus!');
    }
}