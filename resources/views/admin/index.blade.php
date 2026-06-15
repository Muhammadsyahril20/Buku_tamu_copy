<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Pelindo Regional 1 Dumai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="flex min-h-screen">
        
        <div class="w-64 bg-white border-r border-gray-200 p-6 flex flex-col shadow-sm z-10">
            <div class="mb-10 text-center">
                <img src="{{ asset('assets/logo_pelindo.png') }}" alt="Logo Pelindo" class=" h-10 mx-auto mb-2">
                <!-- <h1 class="text-3xl font-extrabold text-blue-700 tracking-tight">PELINDO</h1> -->
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1 font-semibold">Regional 1 Dumai</p>
            </div>
            
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu Utama</p>
            <nav class="space-y-2 mb-8">
                <a href="{{ route('admin.index') }}" class="flex items-center space-x-3 bg-blue-50 text-blue-700 p-3 rounded-lg border border-blue-100 font-medium transition-colors">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> <span>Dashboard Utama</span>
                </a>
                <a href="{{ route('admin.pegawai') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-users-tie w-5 text-center"></i> <span>Data Pegawai / Pejabat</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> <span>Rekap Data Tamu</span>
                </a>
            </nav>

            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3 px-3">Layanan Tamu</p>
            <nav class="space-y-2">
                <a href="{{ route('guest.form') }}" target="_blank" class="flex items-center space-x-3 text-emerald-600 p-3 rounded-lg bg-emerald-50 border border-emerald-100 font-bold transition-colors shadow-sm hover:bg-emerald-100">
                    <i class="fa-solid fa-pen-to-square w-5 text-center"></i> <span>Isi Form Tamu</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 p-10 overflow-y-auto">
            
            <div class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Resepsionis Pelindo Regional 1 Dumai</h2>
                    <p class="text-sm text-gray-500 mt-1">Pantauan antrean tamu masuk dan pendaftaran cepat pejabat tujuan.</p>
                </div>
                <div class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm flex items-center">
                    <i class="fa-regular fa-calendar mr-2 text-blue-600"></i> {{ date('l, d F Y') }}
                </div>
            </div>

            @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg relative mb-6 font-semibold shadow-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-10">
                <h3 class="text-lg font-bold mb-5 flex items-center text-gray-800 border-b border-gray-100 pb-3">
                    <i class="fa-solid fa-user-plus mr-2 text-blue-600"></i> Pendaftaran Cepat Pegawai / Pejabat
                </h3>
                <form action="{{ route('admin.storePegawai') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_pegawai" required placeholder="Nama Pejabat" class="w-full bg-white border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm focus:border-blue-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Alamat Email</label>
                            <input type="email" name="email" required placeholder="email@pelindo.co.id" class="w-full bg-white border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm focus:border-blue-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">No. WhatsApp</label>
                            <input type="text" name="no_wa" required placeholder="Contoh: 628123456789" class="w-full bg-white border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm focus:border-blue-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pilih Jabatan</label>
                            <select name="jabatan" required class="w-full bg-white border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm focus:border-blue-500 transition-all outline-none cursor-pointer">
                                <option value="">-- Pilih Level Jabatan --</option>
                                <option value="Executive General Manager">Executive General Manager</option>
                                <option value="Deputy Manager">Deputy Manager</option>
                                <option value="Manager">Manager</option>
                                <option value="Junior Manager">Junior Manager</option>
                                <option value="Staff / Pelaksana">Staff / Pelaksana</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pilih Divisi / Bagian</label>
                            <select name="bagian" required class="w-full bg-white border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm focus:border-blue-500 transition-all outline-none cursor-pointer">
                                <option value="">-- Pilih Bagian --</option>
                                <option value="Top Manajemen">Top Manajemen</option>
                                <option value="Sistem Manajemen">Sistem Manajemen</option>
                                <option value="Teknik">Teknik</option>
                                <option value="Umum">Umum</option>
                                <option value="Keuangan">Keuangan</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition-all text-sm">
                            <i class="fa-solid fa-save mr-1"></i> Simpan & Daftarkan Pejabat
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-white">
                    <h3 class="font-bold text-gray-800 text-lg">Log Kunjungan Tamu Hari Ini</h3>
                    <button onClick="window.location.reload();" class="text-xs bg-blue-50 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg font-bold transition-colors shadow-sm flex items-center">
                        <i class="fa-solid fa-rotate-right mr-2"></i> Refresh Layar
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Identitas Tamu</th>
                                <th class="px-6 py-4 font-semibold">Asal Instansi</th>
                                <th class="px-6 py-4 font-semibold">Tujuan (Pejabat)</th>
                                <th class="px-6 py-4 font-semibold">Keperluan</th>
                                <th class="px-6 py-4 font-semibold text-center">Status Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($kunjungans as $k)
                            <tr class="hover:bg-blue-50/50 transition-colors">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <img src="{{ $k->foto_selfie }}" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $k->nama_tamu }}</div>
                                        <div class="text-[11px] text-gray-500 font-medium">{{ $k->no_hp_tamu }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-600">{{ $k->asal_instansi }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $k->pegawai->nama_pegawai }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $k->keperluan }}</td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $warnaStatus = 'bg-amber-100 text-amber-700 border-amber-200';
                                        if($k->status == 'Silahkan Ditemui') $warnaStatus = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                                        if($k->status == 'Sedang Rapat') $warnaStatus = 'bg-orange-100 text-orange-700 border-orange-200';
                                        if($k->status == 'Tidak Bisa Ditemui') $warnaStatus = 'bg-rose-100 text-rose-700 border-rose-200';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold border {{ $warnaStatus }}">
                                        {{ strtoupper($k->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($kunjungans) == 0)
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400 font-medium">Belum ada aktivitas kunjungan tamu hari ini.</td>
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