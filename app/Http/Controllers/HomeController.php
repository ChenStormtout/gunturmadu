<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\ProfilDesa;
use App\Models\Galeri; 
use App\Models\Aparatur;

class HomeController extends Controller
{
    // Halaman Utama
    public function index()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $beritaTerbaru = Berita::latest()->take(3)->get();
        $galeris = Galeri::latest()->take(6)->get();
        
        // Kuncinya dibuka: Tarik semua data aparatur
        $aparaturs = Aparatur::all(); 
        
        // Jangan lupa masukkan 'aparaturs' ke dalam compact
        return view('home', compact('profil', 'beritaTerbaru', 'galeris', 'aparaturs'));
    }

    // Halaman Semua Berita
    public function berita()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $beritas = Berita::latest()->paginate(9); // Nampilin 9 berita per halaman
        return view('berita', compact('profil', 'beritas'));
    }

    // Halaman Baca Detail Berita
    public function detailBerita($slug)
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $berita = Berita::where('slug', $slug)->firstOrFail(); 
        
        // FITUR BARU: Ambil 3 berita terbaru lainnya (kecuali berita yang lagi dibaca)
        $beritaLainnya = Berita::where('id', '!=', $berita->id)->latest()->take(3)->get();

        // Kirim $beritaLainnya ke halaman view
        return view('detail-berita', compact('profil', 'berita', 'beritaLainnya'));
    }

    // Halaman Semua Galeri
    public function galeri()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        $galeris = Galeri::latest()->paginate(12); // Nampilin 12 foto per halaman
        return view('galeri', compact('profil', 'galeris'));
    }
}