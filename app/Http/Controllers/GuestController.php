<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Http; 

class GuestController extends Controller
{
    public function showForm() 
    {
        $pegawais = Pegawai::orderBy('nama_pegawai', 'asc')->get();
        return view('guest.form', compact('pegawais'));
    }

   public function submitForm(Request $request)
    {
        $kunjungan = Kunjungan::create([
            'nama_tamu' => $request->nama_tamu,
            'asal_instansi' => $request->asal_instansi,
            'pegawai_id' => $request->pegawai_id,
            'keperluan' => $request->keperluan,
            'no_hp_tamu' => $request->no_hp_tamu,
            'foto_selfie' => $request->foto_selfie,
        ]);

        $pegawai = Pegawai::find($request->pegawai_id);

        if ($pegawai) {
            $no_wa_bos = $pegawai->no_wa;
            // Pastikan nomor WA diawali dengan 62
            if (str_starts_with($no_wa_bos, '0')) {
                $no_wa_bos = '62' . substr($no_wa_bos, 1);
            }

            $pesan = "Halo Bapak/Ibu *" . $pegawai->nama_pegawai . "*,\n\n";
            $pesan .= "Ada tamu di Resepsionis yang ingin menemui Anda:\n\n";
            $pesan .= "👤 *Nama:* " . $request->nama_tamu . "\n";
            $pesan .= "🏢 *Instansi:* " . $request->asal_instansi . "\n";
            $pesan .= "📱 *No. HP:* " . $request->no_hp_tamu . "\n";
            $pesan .= "📝 *Keperluan:* " . $request->keperluan . "\n\n";
            $pesan .= "⚠️ *Mohon berikan balasan (ketik angkanya saja):*\n";
            $pesan .= "*1* - Silakan Ditemui\n";
            $pesan .= "*2* - Sedang Rapat\n";
            $pesan .= "*3* - Tidak Bisa Ditemui\n\n";
            $pesan .= "_Sistem Buku Tamu Pelindo_";
            
            $data_foto = $kunjungan->foto_selfie;

            // KUNCI UTAMA: Mengambil link Ngrok dari Vercel Environment Variables
            $botUrl = env('https://2214-182-1-33-214.ngrok-free.app/api/send');

            if ($botUrl) {
                try {
                    // Tembak pesan ke Node.js lokal via Ngrok
                    Http::timeout(5)->post($botUrl, [
                        'phone' => $no_wa_bos,
                        'message' => $pesan,
                        'photoData' => $data_foto
                    ]);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error("Gagal nembak ke Ngrok: " . $e->getMessage());
                }
            }
        }

        return redirect()->route('guest.waiting', $kunjungan->id);
    }

    public function waitingRoom($id)
    {
        $kunjungan = Kunjungan::with('pegawai')->findOrFail($id);
        return view('guest.waiting', compact('kunjungan'));
    }

   // Fungsi untuk dibaca oleh auto-refresh di layar ruang tunggu tamu
    public function checkStatus($id)
    {
        $kunjungan = Kunjungan::find($id);
        
        if ($kunjungan) {
            return response()->json([
                'status' => $kunjungan->status
            ]);
        }

        return response()->json([
            'status' => 'Menunggu'
        ]);
    }
    
    // Fungsi Webhook untuk menerima balasan WA dari Bos (SUDAH DIPERBAIKI)
    public function handleWebhook(Request $request)
    {
        $sender = $request->query('sender'); // e.g. 62895393372227
        $reply = $request->query('reply');   // e.g. 1

        // Cari pegawai berdasarkan 10 digit terakhir nomornya
        $cleanSender = substr($sender, -10);
        $pegawai = Pegawai::where('no_wa', 'LIKE', '%' . $cleanSender . '%')->first();

        if (!$pegawai) {
            return response()->json(['status' => 'gagal', 'pesan' => "Nomor Anda ($sender) tidak terdaftar di sistem."]);
        }

        // Cari tamu terbaru milik pegawai ini yang statusnya masih Menunggu
        $kunjungan = Kunjungan::where('pegawai_id', $pegawai->id)
                              ->where('status', 'Menunggu')
                              ->latest()
                              ->first();

        if (!$kunjungan) {
            return response()->json(['status' => 'gagal', 'pesan' => "Tidak ada antrean tamu aktif untuk Anda."]);
        }

        // Ubah Status sesuai angka
        if ($reply == '1') {
            $kunjungan->status = 'Silahkan Ditemui';
        } elseif ($reply == '2') {
            $kunjungan->status = 'Sedang Rapat';
        } elseif ($reply == '3') {
            $kunjungan->status = 'Tidak Bisa Ditemui';
        }

        $kunjungan->save();

        return response()->json([
            'status' => 'sukses',
            'pesan' => "Status tamu *" . $kunjungan->nama_tamu . "* sukses diubah menjadi: " . $kunjungan->status
        ]);
    }
}