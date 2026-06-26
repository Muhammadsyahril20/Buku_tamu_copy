<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/pegawai', [AdminController::class, 'pegawai'])->name('admin.pegawai');
Route::post('/admin/pegawai', [AdminController::class, 'storePegawai'])->name('admin.storePegawai');

// Rute Halaman Pegawai (Tabel, Edit, Update, Hapus)
Route::get('/admin/pegawai', [AdminController::class, 'pegawai'])->name('admin.pegawai');
Route::get('/admin/pegawai/{id}/edit', [AdminController::class, 'editPegawai'])->name('admin.editPegawai');
Route::put('/admin/pegawai/{id}', [AdminController::class, 'updatePegawai'])->name('admin.updatePegawai');
Route::delete('/admin/pegawai/{id}', [AdminController::class, 'destroyPegawai'])->name('admin.destroyPegawai');
// Route untuk Halaman Rekap
Route::get('/admin/rekap', [App\Http\Controllers\AdminController::class, 'rekap'])->name('admin.rekap');
Route::delete('/admin/rekap/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.rekap.destroy');

// Route untuk Ekspor
Route::get('/admin/rekap/export/excel', [App\Http\Controllers\AdminController::class, 'exportExcel'])->name('admin.rekap.excel');
Route::get('/admin/rekap/export/pdf', [App\Http\Controllers\AdminController::class, 'exportPdf'])->name('admin.rekap.pdf');
// Route Serah Terima Surat
Route::get('/admin/surat-masuk', [App\Http\Controllers\AdminController::class, 'suratMasuk'])->name('admin.surat');
Route::post('/admin/surat-masuk', [App\Http\Controllers\AdminController::class, 'storeSurat'])->name('admin.surat.store');
// Rute Serah Terima Surat Masuk
Route::get('/admin/surat-masuk', [App\Http\Controllers\AdminController::class, 'suratMasuk'])->name('admin.surat');
Route::post('/admin/surat-masuk', [App\Http\Controllers\AdminController::class, 'storeSurat'])->name('admin.surat.store');

// Rute Edit & Hapus Surat
Route::put('/admin/surat-masuk/{id}', [App\Http\Controllers\AdminController::class, 'updateSurat'])->name('admin.surat.update');
Route::delete('/admin/surat-masuk/{id}', [App\Http\Controllers\AdminController::class, 'destroySurat'])->name('admin.surat.destroy');

// Rute Export Rekap Semua Surat
Route::get('/admin/surat-masuk/export/excel', [App\Http\Controllers\AdminController::class, 'exportSuratExcel'])->name('admin.surat.excel');
Route::get('/admin/surat-masuk/export/pdf', [App\Http\Controllers\AdminController::class, 'exportSuratPdf'])->name('admin.surat.pdf');

// Rute Cetak Tanda Bukti per Surat (Format Formal)
Route::get('/admin/surat-masuk/print/{id}', [App\Http\Controllers\AdminController::class, 'printSuratSingle'])->name('admin.surat.print');

Route::get('/tamu', [GuestController::class, 'showForm'])->name('guest.form');
Route::post('/tamu/submit', [GuestController::class, 'submitForm'])->name('guest.submit');
Route::get('/tamu/menunggu/{id}', [GuestController::class, 'waitingRoom'])->name('guest.waiting');
Route::get('/api/cek-status/{id}', [GuestController::class, 'checkStatus']);

Route::get('/api/webhook-wa', [GuestController::class, 'handleWebhook']);