<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->string('instansi');
            $table->string('perihal');
            $table->string('foto_dokumen')->nullable();
            $table->longText('ttd_pengirim'); // Pakai longText karena menampung gambar Base64
            $table->longText('ttd_penerima'); // Pakai longText
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
