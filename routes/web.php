<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\AparaturController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\PotensiController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\LaporanWargaController;

/*
|--------------------------------------------------------------------------
| 1. AREA PUBLIK (Bisa diakses semua orang)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita.index');
Route::get('/baca/{slug}', [HomeController::class, 'detailBerita'])->name('berita.detail');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri.index');
// Rute Tampilan Publik Potensi Desa
Route::get('/potensi', [HomeController::class, 'potensi'])->name('potensi.index');
Route::get('/potensi/{slug}', [HomeController::class, 'detailPotensi'])->name('potensi.detail');

// Rute Tampilan Publik Potensi Desa
Route::get('/potensi/{slug}', function($slug) {
    $potensi = \App\Models\Potensi::where('slug', $slug)->firstOrFail();
    return view('detail-potensi', compact('potensi'));
})->name('potensi.detail');

// Rute Laporan Warga
Route::get('/cek-laporan', [LaporanWargaController::class, 'cekStatus'])->name('laporan.cek');
Route::get('/lapor', [LaporanWargaController::class, 'create'])->name('laporan.create');
Route::post('/lapor', [LaporanWargaController::class, 'store'])->name('laporan.store');
Route::get('/lapor/verifikasi/{laporan}', [LaporanWargaController::class, 'verify'])->name('laporan.verify');


/*
|--------------------------------------------------------------------------
| 2. AREA DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $total_berita = \App\Models\Berita::count();
    $total_galeri = \App\Models\Galeri::count();
    $total_aparatur = \App\Models\Aparatur::count();
    $total_potensi = \App\Models\Potensi::count(); // Tambahan hitungan potensi
    $total_laporan_baru = \App\Models\Laporan::where('is_verified', true)->where('status', 'menunggu')->count();

    return view('dashboard', compact('total_berita', 'total_galeri', 'total_aparatur', 'total_potensi', 'total_laporan_baru'));
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
    Route::resource('potensi', PotensiController::class); // Rute Potensi Admin yang benar
    
    Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');
    
    // Rute Laporan Admin
    Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::put('laporan/{laporan}', [AdminLaporanController::class, 'updateStatus'])->name('laporan.update');
});

/*
|--------------------------------------------------------------------------
| 4. AREA PENGATURAN AKUN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';