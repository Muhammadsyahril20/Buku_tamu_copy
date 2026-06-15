<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Kunjungan;

class AdminController extends Controller
{
    // Menampilkan halaman Dashboard Utama
    public function index()
    {
        $kunjungans = Kunjungan::with('pegawai')->latest()->take(10)->get();
        return view('admin.index', compact('kunjungans'));
    }

    // Menampilkan halaman Data Pegawai
    public function pegawai()
    {
        $pegawais = Pegawai::latest()->get(); // Ambil semua data pegawai
        return view('admin.pegawai', compact('pegawais'));
    }

    // Proses menyimpan data pegawai baru dari form
    public function storePegawai(Request $request)
    {
        Pegawai::create($request->all());
        return back()->with('success', 'Data Pegawai berhasil disimpan!');
    }
    // Menampilkan form edit data pegawai
    public function editPegawai($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('admin.pegawai_edit', compact('pegawai'));
    }

    // Memproses update data ke database
    public function updatePegawai(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());
        
        return redirect()->route('admin.pegawai')->with('success', 'Data Pegawai berhasil diupdate!');
    }

    // Menghapus data pegawai
    public function destroyPegawai($id)
    {
        Pegawai::findOrFail($id)->delete();
        return back()->with('success', 'Data Pegawai berhasil dihapus dari sistem!');
    }
}