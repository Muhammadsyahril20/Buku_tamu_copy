<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Ini wajib agar semua kolom (termasuk email & bagian) bisa disimpan
    protected $guarded = []; 
}