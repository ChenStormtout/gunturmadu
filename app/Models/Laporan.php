<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tiket',
        'nama_pelapor',
        'email_pelapor',
        'kategori',
        'isi_laporan',
        'foto_lampiran',
        'is_verified',
        'status',
        'tanggapan_admin',
    ];
}