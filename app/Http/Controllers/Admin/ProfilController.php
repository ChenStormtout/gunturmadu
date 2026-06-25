<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // FUNGSI INI YANG DICARI SAMA LARAVEL (Menampilkan Form)
    public function index()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        return view('admin.profil.index', compact('profil'));
    }

    // FUNGSI INI UNTUK MENYIMPAN DATA
    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        $pria = (int) $request->input('penduduk_pria', 0);
        $wanita = (int) $request->input('penduduk_wanita', 0);
        $inputs['total_penduduk'] = $pria + $wanita;

        foreach ($inputs as $kunci => $nilai) {
            ProfilDesa::updateOrCreate(
                ['kunci' => $kunci],
                ['nilai' => $nilai ?? '']
            );
        }

        return redirect()->route('admin.profil.index')->with('success', 'Profil dan Statistik Desa berhasil diperbarui! Total penduduk dihitung otomatis.');
    }
}