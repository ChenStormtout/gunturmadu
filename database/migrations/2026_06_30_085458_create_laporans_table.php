<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique(); // Untuk melacak laporan misal: LPR-8A9B
            $table->string('nama_pelapor');
            $table->string('email_pelapor');
            $table->string('kategori'); // Misal: Infrastruktur, Lingkungan, Layanan
            $table->text('isi_laporan');
            $table->string('foto_lampiran')->nullable();
            
            // Kolom krusial untuk fitur tanpa login
            $table->boolean('is_verified')->default(false); 
            
            // Status tindak lanjut oleh admin
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('tanggapan_admin')->nullable(); // Balasan dari desa
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};