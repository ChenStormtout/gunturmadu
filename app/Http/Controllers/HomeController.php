<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\ProfilDesa;
use App\Models\Galeri; 
use App\Models\Aparatur;
use App\Models\Potensi;

class HomeController extends Controller
{
    // Halaman Utama
    public function index()
    {
        $profilRaw = ProfilDesa::pluck('nilai', 'kunci')->toArray();

        // 1. GENDER (Patokan Utama)
        $pria = (int)($profilRaw['penduduk_pria'] ?? 0);
        $wanita = (int)($profilRaw['penduduk_wanita'] ?? 0);
        $totalPenduduk = $pria + $wanita;

        // 2. AGAMA (6 Agama Resmi + Lainnya)
        $islam = (int)($profilRaw['agama_islam'] ?? 0);
        $kristen = (int)($profilRaw['agama_kristen'] ?? 0);
        $katolik = (int)($profilRaw['agama_katolik'] ?? 0);
        $hindu = (int)($profilRaw['agama_hindu'] ?? 0);
        $buddha = (int)($profilRaw['agama_buddha'] ?? 0);
        $khonghucu = (int)($profilRaw['agama_khonghucu'] ?? 0);
        
        $totalAgama = $islam + $kristen + $katolik + $hindu + $buddha + $khonghucu;
        $agamaLainnya = max(0, $totalPenduduk - $totalAgama);

        // 3. PENDIDIKAN (5 Kategori + Lainnya)
        $pendTidakSekolah = (int)($profilRaw['pend_tidak_sekolah'] ?? 0);
        $pendSd = (int)($profilRaw['pend_sd'] ?? 0);
        $pendSmp = (int)($profilRaw['pend_smp'] ?? 0);
        $pendSma = (int)($profilRaw['pend_sma'] ?? 0);
        $pendTinggi = (int)($profilRaw['pend_tinggi'] ?? 0);
        
        $totalPend = $pendTidakSekolah + $pendSd + $pendSmp + $pendSma + $pendTinggi;
        $pendLainnya = max(0, $totalPenduduk - $totalPend);

        // 4. PEKERJAAN (4 Kategori + Lainnya)
        $petani = (int)($profilRaw['pekerjaan_petani'] ?? 0);
        $pedagang = (int)($profilRaw['pekerjaan_pedagang'] ?? 0);
        $swasta = (int)($profilRaw['pekerjaan_swasta'] ?? 0);
        $pns = (int)($profilRaw['pekerjaan_pns'] ?? 0);
        
        $totalKerja = $petani + $pedagang + $swasta + $pns;
        $pekerjaanLainnya = max(0, $totalPenduduk - $totalKerja);

        // 5. USIA (5 Kategori + Lainnya)
        $usiaBalita = (int)($profilRaw['usia_balita'] ?? 0);
        $usiaAnak = (int)($profilRaw['usia_anak'] ?? 0);
        $usiaRemaja = (int)($profilRaw['usia_remaja'] ?? 0);
        $usiaDewasa = (int)($profilRaw['usia_dewasa'] ?? 0);
        $usiaLansia = (int)($profilRaw['usia_lansia'] ?? 0);
        
        $totalUsia = $usiaBalita + $usiaAnak + $usiaRemaja + $usiaDewasa + $usiaLansia;
        $usiaLainnya = max(0, $totalPenduduk - $totalUsia);

        // Gabungkan semua ke dalam variabel $profil
        $profil = array_merge($profilRaw, [
            'total_penduduk' => $totalPenduduk,
            'penduduk_pria' => $pria,
            'penduduk_wanita' => $wanita,
            'agama_islam' => $islam,
            'agama_kristen' => $kristen,
            'agama_katolik' => $katolik,
            'agama_hindu' => $hindu,
            'agama_buddha' => $buddha,
            'agama_khonghucu' => $khonghucu,
            'agama_lainnya' => $agamaLainnya,
            'pend_tidak_sekolah' => $pendTidakSekolah,
            'pend_sd' => $pendSd,
            'pend_smp' => $pendSmp,
            'pend_sma' => $pendSma,
            'pend_tinggi' => $pendTinggi,
            'pend_lainnya' => $pendLainnya,
            'pekerjaan_petani' => $petani,
            'pekerjaan_pedagang' => $pedagang,
            'pekerjaan_swasta' => $swasta,
            'pekerjaan_pns' => $pns,
            'pekerjaan_lainnya' => $pekerjaanLainnya,
            'usia_balita' => $usiaBalita,
            'usia_anak' => $usiaAnak,
            'usia_remaja' => $usiaRemaja,
            'usia_dewasa' => $usiaDewasa,
            'usia_lansia' => $usiaLansia,
            'usia_lainnya' => $usiaLainnya,
        ]);

        $beritaTerbaru = Berita::latest()->take(3)->get();
        $galeris = Galeri::latest()->take(6)->get();
        $aparaturs = Aparatur::all(); 
        $potensis = Potensi::latest()->take(3)->get();
        
        return view('home', compact('profil', 'beritaTerbaru', 'galeris', 'aparaturs', 'potensis'));
    }

    // Halaman Semua Berita
    public function berita()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $beritas = Berita::latest()->paginate(9); 
        return view('berita', compact('profil', 'beritas'));
    }

    public function detailBerita($slug)
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $berita = Berita::where('slug', $slug)->firstOrFail(); 
        $beritaLainnya = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();
        return view('detail-berita', compact('profil', 'berita', 'beritaLainnya'));
    }

    public function galeri()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $galeris = Galeri::latest()->paginate(12);
        return view('galeri', compact('profil', 'galeris'));
    }

    public function potensi()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $potensis = Potensi::latest()->paginate(9);
        return view('potensi', compact('profil', 'potensis'));
    }

    public function detailPotensi($slug)
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $potensi = Potensi::where('slug', $slug)->firstOrFail(); 
        $potensiLainnya = Potensi::where('id', '!=', $potensi->id)->latest()->take(3)->get();
        return view('detail-potensi', compact('profil', 'potensi', 'potensiLainnya'));
    }
}