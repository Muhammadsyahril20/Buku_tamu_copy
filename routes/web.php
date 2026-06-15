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

Route::get('/tamu', [GuestController::class, 'showForm'])->name('guest.form');
Route::post('/tamu/submit', [GuestController::class, 'submitForm'])->name('guest.submit');
Route::get('/tamu/menunggu/{id}', [GuestController::class, 'waitingRoom'])->name('guest.waiting');
Route::get('/api/cek-status/{id}', [GuestController::class, 'checkStatus']);

Route::get('/api/webhook-wa', [GuestController::class, 'handleWebhook']);