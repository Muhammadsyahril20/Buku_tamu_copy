<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Models\Pegawai;
use App\Models\Kunjungan;
use Carbon\Carbon; // <--- INI OBAT UNTUK ERROR-NYA BRO!
use App\Models\SuratMasuk;


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
    // 1. Fungsi Menampilkan Halaman Rekap & Filter
    public function rekap(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $query = Kunjungan::with('pegawai');

        if ($filter == 'minggu') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'bulan') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter == 'tahun') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $kunjungans = $query->latest()->get();
        return view('admin.rekap', compact('kunjungans', 'filter'));
    }

    // 2. Fungsi Export Excel (CSV Native)
    public function exportExcel(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $query = Kunjungan::with('pegawai');

        if ($filter == 'minggu') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'bulan') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter == 'tahun') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $kunjungans = $query->get();
        $fileName = 'Rekap_Tamu_Pelindo_' . date('Ymd') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Tanggal', 'Nama Tamu', 'Instansi', 'Pejabat Tujuan', 'Keperluan', 'Status'];

        $callback = function() use($kunjungans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $row = 1;

            foreach ($kunjungans as $k) {
                fputcsv($file, [
                    $row++,
                    $k->created_at->format('d-m-Y H:i'),
                    $k->nama_tamu,
                    $k->asal_instansi,
                    $k->pegawai->nama_pegawai,
                    $k->keperluan,
                    $k->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // 3. Fungsi Export PDF
    public function exportPdf(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $query = Kunjungan::with('pegawai');

        // Logika filter sama seperti di atas
        if ($filter == 'minggu') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'bulan') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter == 'tahun') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $kunjungans = $query->get();

        $pdf = Pdf::loadView('admin.pdf', compact('kunjungans', 'filter'))
                  ->setPaper('a4', 'landscape');
                  
        return $pdf->download('Rekap_Tamu_Pelindo_' . date('Ymd') . '.pdf');
    }
    public function destroy($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        
        // Opsional: Hapus fotonya juga dari storage/cloudinary jika ada
        // if ($kunjungan->foto_selfie) { ... }

        $kunjungan->delete();

        return redirect()->back()->with('success', 'Data tamu berhasil dihapus dari sistem!');
    }
// Menampilkan halaman Serah Terima Surat & Rekapnya
    public function suratMasuk()
    {
        // Ambil data terbaru untuk rekap di bawah form
        $surats = SuratMasuk::latest()->get();
        return view('admin.surat-masuk', compact('surats'));
    }

    // Menyimpan data form & tanda tangan
    public function storeSurat(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required',
            'nama_penerima' => 'required',
            'instansi' => 'required',
            'perihal' => 'required',
            'ttd_pengirim' => 'required',
            'ttd_penerima' => 'required',
        ]);

        $data = $request->all();

        // Proses Foto Dokumen jika ada yang diupload
        if ($request->hasFile('foto_dokumen')) {
            // Karena kamu pakai Cloudinary/Storage, sesuaikan script uploadmu di sini.
            // Contoh simpel jika pakai storage lokal:
            $path = $request->file('foto_dokumen')->store('surat_masuk', 'public');
            $data['foto_dokumen'] = $path;
        }

        SuratMasuk::create($data);

        return redirect()->back()->with('success', 'Data serah terima surat berhasil disimpan!');
    }
    // --- FUNGSI UPDATE SURAT ---
    public function updateSurat(Request $request, $id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->update([
            'nama_pengirim' => $request->nama_pengirim,
            'nama_penerima' => $request->nama_penerima,
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
        ]);
        return redirect()->back()->with('success', 'Data surat berhasil diperbarui!');
    }

    // --- FUNGSI HAPUS SURAT ---
    public function destroySurat($id)
    {
        SuratMasuk::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data surat berhasil dihapus!');
    }

    // --- FUNGSI EXPORT EXCEL (REKAP SURAT) ---
    public function exportSuratExcel()
    {
        $surats = SuratMasuk::latest()->get();
        $fileName = 'Rekap_Surat_Masuk_' . date('Ymd') . '.csv';
        $headers = [
            "Content-type" => "text/csv", "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache", "Cache-Control" => "must-revalidate, post-check=0, pre-check=0", "Expires" => "0"
        ];
        $columns = ['No', 'Tanggal', 'Pengirim', 'Instansi', 'Perihal'];

        $callback = function() use($surats, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $row = 1;
            foreach ($surats as $s) {
                fputcsv($file, [$row++, $s->created_at->format('d-m-Y H:i'), $s->nama_pengirim, $s->instansi, $s->perihal]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    // --- FUNGSI EXPORT PDF (REKAP SURAT) ---
    public function exportSuratPdf()
    {
        $surats = SuratMasuk::latest()->get();
        $pdf = Pdf::loadView('admin.surat-pdf-rekap', compact('surats'))->setPaper('a4', 'landscape');
        return $pdf->download('Rekap_Surat_Masuk_' . date('Ymd') . '.pdf');
    }

    // --- FUNGSI CETAK BUKTI PER SURAT ---
    public function printSuratSingle($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $pdf = Pdf::loadView('admin.surat-pdf-single', compact('surat'))->setPaper('a4', 'portrait');
        return $pdf->stream('Tanda_Bukti_Surat_' . $surat->id . '.pdf'); // Pakai stream agar bisa dilihat dulu sebelum didownload
    }

}