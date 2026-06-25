<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // 1. FUNGSI UNTUK MENAMPILKAN HALAMAN FORM (Ini yang tadi hilang)
    public function index()
    {
        // Ambil semua data dari database dan ubah jadi array [key => value]
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        return view('admin.profil.index', compact('profil'));
    }

    // 2. FUNGSI UNTUK MENYIMPAN DATA & HITUNG OTOMATIS
    public function update(Request $request)
    {
        // Ambil semua inputan dari form kecuali token
        $inputs = $request->except(['_token', '_method']);

        // Ambil data pria & wanita, konversi ke angka integer
        $pria = (int) $request->input('penduduk_pria', 0);
        $wanita = (int) $request->input('penduduk_wanita', 0);
        
        // Jumlahkan otomatis dan timpa nilai 'total_penduduk'
        $inputs['total_penduduk'] = $pria + $wanita;

        // Looping untuk menyimpan ke database
        foreach ($inputs as $kunci => $nilai) {
            ProfilDesa::updateOrCreate(
                ['kunci' => $kunci],
                ['nilai' => $nilai ?? '']
            );
        }

        return redirect()->route('admin.profil.index')->with('success', 'Profil dan Statistik Desa berhasil diperbarui! Total penduduk dihitung otomatis.');
    }
}