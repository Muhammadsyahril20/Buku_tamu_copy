<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tanda Bukti Penerimaan Surat</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 14px; color: #000; line-height: 1.6; }
        
        /* Layout Header pakai tabel agar Logo dan Teks rapi sejajar */
        .header-table { width: 100%; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 30px; }
        .header-logo { width: 100px; text-align: left; vertical-align: middle; }
        .header-text { text-align: center; vertical-align: middle; padding-right: 100px; /* Offset logo agar teks di tengah */ }
        
        .header-text h1 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .header-text p { margin: 2px 0; font-size: 14px; }
        
        .title { text-align: center; font-weight: bold; font-size: 16px; text-decoration: underline; margin-bottom: 30px; }
        
        .content-table { width: 100%; margin-bottom: 50px; }
        .content-table td { padding: 8px 0; vertical-align: top; }
        .content-table td:first-child { width: 160px; font-weight: bold; }
        .content-table td:nth-child(2) { width: 20px; }
        
        .signature-box { width: 100%; margin-top: 50px; }
        .sig-left { width: 50%; float: left; text-align: center; }
        .sig-right { width: 50%; float: right; text-align: center; }
        .sig-img { height: 100px; margin: 10px 0; object-fit: contain; }
        
        .footer { clear: both; margin-top: 50px; font-size: 10px; color: #555; text-align: center; border-top: 1px dashed #ccc; padding-top: 10px; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ public_path('assets/logo_pelindo.png') }}" width="100">
            </td>
            <td class="header-text">
                <h1>PT Pelabuhan Indonesia (Persero)</h1>
                <p>Regional 1 Cabang Dumai</p>
                <p>Jl. Datuk Laksamana No.1, Dumai, Riau</p>
            </td>
        </tr>
    </table>

    <div class="title">
        TANDA BUKTI PENERIMAAN SURAT MASUK
    </div>

    <p>Pada hari ini, tanggal <strong>{{ $surat->created_at->translatedFormat('d F Y') }}</strong> pukul <strong>{{ $surat->created_at->format('H:i') }} WIB</strong>, telah diterima dokumen/surat dengan rincian sebagai berikut:</p>

    <table class="content-table">
        <tr>
            <td>Nama Pengirim / Kurir</td>
            <td>:</td>
            <td>{{ strtoupper($surat->nama_pengirim) }}</td>
        </tr>
        <tr>
            <td>Asal Instansi</td>
            <td>:</td>
            <td>{{ strtoupper($surat->instansi) }}</td>
        </tr>
        <tr>
            <td>Perihal / Isi Dokumen</td>
            <td>:</td>
            <td>{{ $surat->perihal }}</td>
        </tr>
        <tr>
            <td>Diterima Oleh</td>
            <td>:</td>
            <td>{{ strtoupper($surat->nama_penerima) }}</td>
        </tr>
    </table>

    <p>Demikian tanda bukti ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

    <div class="signature-box">
        <div class="sig-left">
            <p>Pihak Pengirim,</p>
            <img src="{{ $surat->ttd_pengirim }}" class="sig-img">
            <p style="text-decoration: underline; font-weight: bold;">{{ strtoupper($surat->nama_pengirim) }}</p>
        </div>
        <div class="sig-right">
            <p>Penerima,</p>
            <img src="{{ $surat->ttd_penerima }}" class="sig-img">
            <p style="text-decoration: underline; font-weight: bold;">{{ strtoupper($surat->nama_penerima) }}</p>
        </div>
    </div>

    <div class="footer">
        Dicetak secara otomatis dari Sistem Informasi Buku Tamu Digital Pelindo Regional 1 Dumai pada {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}.
    </div>

</body>
</html>