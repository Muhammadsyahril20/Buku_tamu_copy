<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
protected $fillable = ['nama_pengirim', 'nama_penerima', 'instansi', 'perihal', 'foto_dokumen', 'ttd_pengirim', 'ttd_penerima'];
}
