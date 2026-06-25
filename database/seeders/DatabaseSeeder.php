<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Aparatur;
use App\Models\ProfilDesa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Data Profil & Statistik Desa
        $profilData = [
            ['kunci' => 'nama_desa', 'nilai' => 'Gunturmadu'],
            ['kunci' => 'kecamatan', 'nilai' => 'Mojotengah'],
            ['kunci' => 'kabupaten', 'nilai' => 'Wonosobo'],
            ['kunci' => 'provinsi', 'nilai' => 'Jawa Tengah'],
            ['kunci' => 'penduduk_pria', 'nilai' => '1824'],
            ['kunci' => 'penduduk_wanita', 'nilai' => '1735'],
            ['kunci' => 'total_penduduk', 'nilai' => '3559'],
            ['kunci' => 'sejarah_desa', 'nilai' => 'Desa Gunturmadu memiliki sejarah panjang yang menjunjung tinggi nilai gotong royong dan kelestarian alam.'],
            ['kunci' => 'visi_misi', 'nilai' => 'Mewujudkan Desa Gunturmadu yang Maju, Sejahtera, dan Berbudaya.'],
        ];

        foreach ($profilData as $data) {
            ProfilDesa::create($data);
        }

        // 2. Data Aparatur Desa
        Aparatur::create(['nama' => 'Budi Santoso', 'jabatan' => 'Kepala Desa', 'foto' => null]);
        Aparatur::create(['nama' => 'Siti Aminah', 'jabatan' => 'Sekretaris Desa', 'foto' => null]);
        Aparatur::create(['nama' => 'Ahmad Fauzi', 'jabatan' => 'Kaur Keuangan', 'foto' => null]);

        // 3. Data Berita (Artikel)
        Berita::create([
            'judul' => 'Kerja Bakti Bersihkan Saluran Irigasi Menjelang Musim Tanam',
            'slug' => Str::slug('Kerja Bakti Bersihkan Saluran Irigasi Menjelang Musim Tanam'),
            'konten' => 'Seluruh warga Desa Gunturmadu antusias bergotong royong membersihkan saluran air utama desa untuk memastikan kelancaran irigasi persawahan.',
            'gambar' => null,
        ]);
        
        Berita::create([
            'judul' => 'Penyaluran Bantuan Bibit Unggul untuk Kelompok Tani',
            'slug' => Str::slug('Penyaluran Bantuan Bibit Unggul untuk Kelompok Tani'),
            'konten' => 'Pemerintah desa telah menyalurkan ratusan bibit unggul sebagai bentuk dukungan terhadap ketahanan pangan warga.',
            'gambar' => null,
        ]);

        // 4. Data Galeri
        Galeri::create(['judul' => 'Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes)', 'gambar' => 'dummy1.jpg']);
        Galeri::create(['judul' => 'Pemandangan Sawah Gunturmadu di Pagi Hari', 'gambar' => 'dummy2.jpg']);
        Galeri::create(['judul' => 'Kegiatan Posyandu Balita', 'gambar' => 'dummy3.jpg']);
    }
}