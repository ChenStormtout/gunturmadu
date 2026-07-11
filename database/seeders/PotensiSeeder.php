<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Potensi;
use Illuminate\Support\Str;

class PotensiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul' => 'Kopi Robusta Lereng Gunung',
                'deskripsi' => "Kopi pilihan hasil panen petani lokal dengan aroma khas pegunungan.\n\nDiproses secara tradisional turun temurun untuk mempertahankan cita rasa asli nusantara. Cocok dijadikan buah tangan maupun dinikmati di pagi hari.",
                'gambar' => '|object-center', // Trik agar gambar kosong dan memicu desain gradasi otomatis
            ],
            [
                'judul' => 'Kerajinan Anyaman Bambu',
                'deskripsi' => "Produk UMKM unggulan dari ibu-ibu PKK desa yang dibuat dari bambu pilihan.\n\nKerajinan ini mencakup tas, bakul, hingga dekorasi rumah yang estetik dan ramah lingkungan.",
                'gambar' => '|object-center',
            ],
            [
                'judul' => 'Air Terjun Tersembunyi',
                'deskripsi' => "Destinasi wisata alam yang belum banyak dijamah, menawarkan kesejukan dan kejernihan air langsung dari mata air pegunungan.\n\nLokasinya hanya berjarak 2KM dari Balai Desa dan sangat cocok untuk wisata keluarga di akhir pekan.",
                'gambar' => '|object-center',
            ],
        ];

        foreach($data as $item) {
            Potensi::create([
                'judul' => $item['judul'],
                'slug' => Str::slug($item['judul']),
                'deskripsi' => $item['deskripsi'],
                'gambar' => $item['gambar']
            ]);
        }
    }
}