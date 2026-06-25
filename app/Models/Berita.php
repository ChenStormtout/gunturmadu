<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Beri izin Laravel untuk mengisi kolom-kolom ini ke database
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
    ];
}