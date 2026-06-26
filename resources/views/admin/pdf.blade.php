<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kunjungan Tamu</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2, .header p { margin: 0; padding: 2px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; text-transform: uppercase; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Rekapitulasi Data Tamu</h2>
        <p>PT Pelabuhan Indonesia (Persero) Regional 1 Dumai</p>
        <p>Periode: {{ strtoupper($filter) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Nama Tamu</th>
                <th>No. Handphone</th>
                <th>Asal Instansi</th>
                <th>Tujuan (Pejabat)</th>
                <th>Keperluan</th>
                <th>Status Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kunjungans as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $k->nama_tamu }}</td>
                <td>{{ $k->no_hp_tamu }}</td>
                <td>{{ $k->asal_instansi }}</td>
                <td>{{ $k->pegawai->nama_pegawai }}</td>
                <td>{{ $k->keperluan }}</td>
                <td>{{ $k->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>