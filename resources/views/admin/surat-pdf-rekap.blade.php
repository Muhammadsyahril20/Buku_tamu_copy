<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Surat Masuk</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2, .header p { margin: 0; padding: 2px; }
        
        /* Tabel Utama */
        .main-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .main-table th, .main-table td { border: 1px solid #ddd; padding: 6px; text-align: left; vertical-align: middle; }
        .main-table th { background-color: #f4f4f4; text-transform: uppercase; font-size: 10px; text-align: center; }

        /* Tabel Khusus Tanda Tangan (Anti-Berantakan di DomPDF) */
        .sig-table { width: 100%; border-collapse: collapse; border: none; margin: 0; padding: 0; }
        .sig-table td { border: none; padding: 2px; text-align: center; vertical-align: bottom; width: 50%; }
        
        .sig-img { height: 40px; object-fit: contain; margin: 5px 0; }
        .sig-name { font-size: 9px; font-weight: bold; }
        .sig-title { font-size: 8px; color: #777; font-weight: bold; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Rekapitulasi Surat Masuk</h2>
        <p>PT Pelabuhan Indonesia (Persero) Regional 1 Dumai</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB</p>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal Masuk</th>
                <th width="15%">Nama Pengirim</th>
                <th width="15%">Asal Instansi</th>
                <th width="20%">Perihal</th>
                <th width="30%">Status Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($surats as $index => $s)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <!-- Memaksa jam sesuai dengan WIB -->
                <td style="text-align: center;">{{ $s->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                <td>{{ $s->nama_pengirim }}</td>
                <td>{{ $s->instansi }}</td>
                <td>{{ $s->perihal }}</td>
                <td style="padding: 0;">
                    <!-- Menggunakan Tabel di dalam Tabel agar tidak tumpang tindih -->
                    <table class="sig-table">
                        <tr>
                            <td style="border-right: 1px solid #eee;">
                                <div class="sig-title">PENGIRIM</div>
                                <img src="{{ $s->ttd_pengirim }}" class="sig-img">
                                <div class="sig-name">{{ $s->nama_pengirim }}</div>
                            </td>
                            <td>
                                <div class="sig-title">ADMIN</div>
                                <img src="{{ $s->ttd_penerima }}" class="sig-img">
                                <div class="sig-name">{{ $s->nama_penerima }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">Belum ada data surat masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>