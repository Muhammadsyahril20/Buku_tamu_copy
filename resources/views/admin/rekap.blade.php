<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Data Tamu - Pelindo Regional 1 Dumai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="flex min-h-screen">
        
        <div class="w-64 bg-white border-r border-gray-200 p-6 flex flex-col shadow-sm z-10">
            <div class="mb-10 text-center">
                <img src="{{ asset('assets/logo_pelindo.png') }}" alt="Logo Pelindo" class="h-10 mx-auto mb-2">
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1 font-semibold">Regional 1 Dumai</p>
            </div>
            
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu Utama</p>
            <nav class="space-y-2 mb-8">
                <a href="{{ route('admin.index') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> <span>Dashboard Utama</span>
                </a>
                <a href="{{ route('admin.pegawai') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-users-tie w-5 text-center"></i> <span>Data Pegawai / Pejabat</span>
                </a>
                <a href="{{ route('admin.rekap') }}" class="flex items-center space-x-3 bg-blue-50 text-blue-700 p-3 rounded-lg border border-blue-100 font-medium transition-colors">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> <span>Rekap Data Tamu</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 p-10 overflow-y-auto">
            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Rekapitulasi Data Tamu</h2>
                    <p class="text-sm text-gray-500 mt-1">Filter dan unduh laporan kunjungan tamu Pelindo.</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                
                <form action="{{ route('admin.rekap') }}" method="GET" class="flex items-center space-x-3 w-full md:w-auto">
                    <label class="text-sm font-semibold text-gray-600">Tampilkan:</label>
                    <select name="filter" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm focus:border-blue-500 outline-none cursor-pointer">
                        <option value="semua" {{ $filter == 'semua' ? 'selected' : '' }}>Semua Waktu</option>
                        <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="tahun" {{ $filter == 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
                    </select>
                </form>

                <div class="flex space-x-3 w-full md:w-auto">
                    <a href="{{ route('admin.rekap.excel', ['filter' => $filter]) }}" class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-5 rounded-lg shadow-sm transition-all text-sm flex items-center justify-center">
                        <i class="fa-solid fa-file-excel mr-2"></i> Export Excel
                    </a>
                    <a href="{{ route('admin.rekap.pdf', ['filter' => $filter]) }}" class="flex-1 md:flex-none bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2 px-5 rounded-lg shadow-sm transition-all text-sm flex items-center justify-center">
                        <i class="fa-solid fa-file-pdf mr-2"></i> Export PDF
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Tanggal</th>
                                <th class="px-6 py-4 font-semibold">Identitas Tamu</th>
                                <th class="px-6 py-4 font-semibold">Asal Instansi</th>
                                <th class="px-6 py-4 font-semibold">Tujuan (Pejabat)</th>
                                <th class="px-6 py-4 font-semibold">Status Konfirmasi</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th> </tr>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($kunjungans as $k)
                            <tr class="hover:bg-blue-50/50 transition-colors">
                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $k->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">{{ $k->nama_tamu }}</div>
                                    <div class="text-[11px] text-gray-500 font-medium">{{ $k->no_hp_tamu }}</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-600">{{ $k->asal_instansi }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $k->pegawai->nama_pegawai }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold border 
                                        {{ $k->status == 'Silahkan Ditemui' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 
                                          ($k->status == 'Sedang Rapat' ? 'bg-orange-100 text-orange-700 border-orange-200' : 
                                          ($k->status == 'Tidak Bisa Ditemui' ? 'bg-rose-100 text-rose-700 border-rose-200' : 'bg-amber-100 text-amber-700 border-amber-200')) }}">
                                        {{ strtoupper($k->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.rekap.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kunjungan tamu atas nama {{ $k->nama_tamu }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white border border-rose-200 p-2 rounded-lg transition-all shadow-sm" title="Hapus Data">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400 font-medium">Tidak ada data tamu pada periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>