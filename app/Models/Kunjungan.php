<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $guarded = [];

    // Relasi ke tabel instansi dan pegawai
    public function instansi() {
        return $this->belongsTo(Instansi::class);
    }
    public function pegawai() {
        return $this->belongsTo(Pegawai::class);
    }
}
