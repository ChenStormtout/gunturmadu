<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Controller buatan kita
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;   // Buka komennya nanti kalau udah dibuat
use App\Http\Controllers\Admin\AparaturController; // Buka komennya nanti kalau udah dibuat
use App\Http\Controllers\Admin\ProfilController;

/*
|--------------------------------------------------------------------------
| 1. AREA PUBLIK (Bisa diakses semua warga)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita.index');
// Ubah dari /berita/{slug} menjadi /baca/{slug}
Route::get('/baca/{slug}', [HomeController::class, 'detailBerita'])->name('berita.detail'); // Untuk baca full artikel
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri.index');

/*
|--------------------------------------------------------------------------
| 2. AREA DASHBOARD ADMIN (Harus Login)
|--------------------------------------------------------------------------
| Ini rute bawaan Breeze, biarkan saja untuk halaman utama panel admin
*/
Route::get('/dashboard', function () {
    // Tarik jumlah total data buat ditampilin di kartu statistik
    $total_berita = \App\Models\Berita::count();
    $total_galeri = \App\Models\Galeri::count();
    $total_aparatur = \App\Models\Aparatur::count();

    return view('dashboard', compact('total_berita', 'total_galeri', 'total_aparatur'));
})->middleware(['auth', 'verified'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| 3. AREA KELOLA KONTEN DESA (CRUD Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('berita', BeritaController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('aparatur', AparaturController::class);
    Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');
});

/*
|--------------------------------------------------------------------------
| 4. AREA PENGATURAN AKUN (Bawaan Breeze)
|--------------------------------------------------------------------------
| Untuk ganti nama admin, email, dan ganti password
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Sistem Login/Logout/Register bawaan
require __DIR__.'/auth.php';