<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    // Tambahkan baris ini untuk membuka izin mass assignment
    protected $fillable = ['kunci', 'nilai'];
    
    // Jika tabel lu namanya 'profil_desas' (bukan 'profil_desae' dsb), pastikan ini ada jika diperlukan
    protected $table = 'profil_desas'; 
}