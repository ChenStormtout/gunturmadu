<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// Tambahkan dua baris ini untuk memanggil Intervention Image
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AparaturController extends Controller
{
    public function index()
    {
        $aparaturs = Aparatur::all();
        return view('admin.aparatur.index', compact('aparaturs'));
    }

    public function create()
    {
        return view('admin.aparatur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:9120', // Boleh sampai 5MB karena bakal dikompres
        ]);

        $aparatur = new Aparatur();
        $aparatur->nama = $request->nama;
        $aparatur->jabatan = $request->jabatan;

        // Logika kompresi foto menggunakan Intervention Image
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.jpg'; // Paksa ekstensi .jpg
            $path = 'aparatur-desa/' . $filename;

            // Proses gambar: Batasi lebar maksimal 800px (cukup untuk foto profil) dan kualitas 70%
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $encoded = $image->scaleDown(width: 800)->toJpeg(70);

            Storage::disk('public')->put($path, $encoded);
            $aparatur->foto = $path;
        }

        $aparatur->save();

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aparatur = Aparatur::findOrFail($id);
        return view('admin.aparatur.edit', compact('aparatur'));
    }

    public function update(Request $request, $id)
    {
        $aparatur = Aparatur::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $aparatur->nama = $request->nama;
        $aparatur->jabatan = $request->jabatan;

        // Logika update foto dengan kompresi
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($aparatur->foto && Storage::disk('public')->exists($aparatur->foto)) {
                Storage::disk('public')->delete($aparatur->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.jpg';
            $path = 'aparatur-desa/' . $filename;

            // Proses gambar: Batasi lebar maksimal 800px dan kualitas 70%
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $encoded = $image->scaleDown(width: 800)->toJpeg(70);

            Storage::disk('public')->put($path, $encoded);
            $aparatur->foto = $path;
        }

        $aparatur->save();

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aparatur = Aparatur::findOrFail($id);
        
        // Hapus file fisik foto sebelum menghapus data dari database
        if ($aparatur->foto && Storage::disk('public')->exists($aparatur->foto)) {
            Storage::disk('public')->delete($aparatur->foto);
        }
        $aparatur->delete();

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil dihapus!');
    }
}