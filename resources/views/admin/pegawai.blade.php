<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai - Pelindo Dumai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="flex min-h-screen">
        
        <div class="w-64 bg-white border-r border-gray-200 p-6 flex flex-col shadow-sm z-10">
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-extrabold text-blue-700 tracking-tight">PELINDO</h1>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1 font-semibold">Regional 1 Dumai</p>
            </div>
            
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu Utama</p>
            <nav class="space-y-2 mb-8">
                <a href="{{ route('admin.index') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> <span>Dashboard Utama</span>
                </a>
                <a href="{{ route('admin.pegawai') }}" class="flex items-center space-x-3 bg-blue-50 text-blue-700 p-3 rounded-lg border border-blue-100 font-medium transition-colors">
                    <i class="fa-solid fa-users-tie w-5 text-center"></i> <span>Data Pegawai / Pejabat</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> <span>Rekap Data Tamu</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 p-10 overflow-y-auto">
            
            <div class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Data Pegawai</h2>
                    <p class="text-sm text-gray-500 mt-1">Daftar lengkap pejabat dan pegawai tujuan tamu.</p>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg relative mb-6 font-semibold shadow-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-white">
                    <h3 class="font-bold text-gray-800 text-lg">Rekapitulasi Data Terdaftar</h3>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Baru
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider border border-gray-200 rounded-t-lg">
                            <tr>
                                <th class="px-6 py-4 font-semibold border-b border-gray-200">No</th>
                                <th class="px-6 py-4 font-semibold border-b border-gray-200">Nama Pegawai</th>
                                <th class="px-6 py-4 font-semibold border-b border-gray-200">Kontak</th>
                                <th class="px-6 py-4 font-semibold border-b border-gray-200">Jabatan</th>
                                <th class="px-6 py-4 font-semibold border-b border-gray-200">Bagian</th>
                                <th class="px-6 py-4 font-semibold border-b border-gray-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100 border-x border-b border-gray-200">
                            @foreach($pegawais as $index => $p)
                            <tr class="hover:bg-blue-50/50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-bold text-gray-800">{{ $p->nama_pegawai }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-700 font-medium">{{ $p->no_wa }}</div>
                                    <div class="text-[11px] text-gray-500">{{ $p->email }}</div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-700">{{ $p->jabatan }}</td>
                                <td class="px-6 py-4 text-blue-600 font-medium">{{ $p->bagian }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('admin.editPegawai', $p->id) }}" class="text-amber-500 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 p-2 rounded-lg transition-colors" title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.destroyPegawai', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 p-2 rounded-lg transition-colors" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($pegawais) == 0)
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400 font-medium">Belum ada data pegawai yang ditambahkan.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>