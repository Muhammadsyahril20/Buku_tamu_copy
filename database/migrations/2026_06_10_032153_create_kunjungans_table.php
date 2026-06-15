<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // File: database/migrations/xxxx_xx_xx_create_kunjungans_table.php
public function up()
{
    Schema::create('kunjungans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_tamu');
        $table->string('asal_instansi'); // <-- Ganti jadi ini
        $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
        $table->text('keperluan');
        $table->string('no_hp_tamu');
        $table->longText('foto_selfie');
        $table->enum('status', ['Menunggu', 'Silahkan Ditemui', 'Sedang Rapat', 'Tidak Bisa Ditemui'])->default('Menunggu');
        $table->timestamps();
    });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
