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
        
        <!-- SIDEBAR -->
        <div class="w-64 bg-white border-r border-gray-200 p-6 flex flex-col shadow-sm z-10">
            <div class="mb-10 text-center">
                <img src="{{ asset('assets/logo_pelindo.png') }}" alt="Logo Pelindo" class=" h-10 mx-auto mb-2">
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
                <a href="{{ route('admin.rekap') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> <span>Rekap Data Tamu</span>
                </a>
                <!-- MENU BARU: SURAT MASUK -->
                <a href="{{ route('admin.surat') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-envelope-open-text w-5 text-center"></i> <span>Surat Masuk (E-Sign)</span>
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

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-10 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500"></div>
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h3 class="text-lg font-bold flex items-center text-gray-800 mb-1">
                            <i class="fa-brands fa-whatsapp text-2xl mr-3 text-emerald-500"></i> Server WhatsApp Bot
                        </h3>
                        <p class="text-sm text-gray-500 mb-4">Pantau status koneksi WhatsApp untuk pengiriman notifikasi otomatis ke Pejabat.</p>
                        
                        <div class="flex items-center space-x-3">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Saat Ini:</span>
                            
                            <div id="botStatusBadge" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 transition-all">
                                <i class="fa-solid fa-spinner fa-spin mr-2"></i> Mengecek Server...
                            </div>
                            
                            <button onclick="resetBotWA()" id="btnResetBot" class="hidden items-center px-3 py-1 bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 hover:text-rose-700 rounded-full text-xs font-bold transition-all shadow-sm">
                                <i class="fa-solid fa-rotate-right mr-1"></i> Reset / Ganti Nomor WA
                            </button>
                        </div>
                    </div>

                    <div id="qrContainer" class="hidden flex-col items-center bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-inner">
                        <p class="text-xs font-bold text-rose-600 mb-3 animate-pulse">
                            <i class="fa-solid fa-mobile-screen-button mr-1"></i> Scan QR Ini via WA HP Resepsionis
                        </p>
                        <div class="bg-white p-2 rounded-lg shadow-sm border border-gray-200">
                            <img id="qrImage" src="" alt="QR Code WA" class="w-32 h-32 md:w-40 md:h-40 object-contain">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-10">
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

    <script>
        const botApiUrl = "{{ env('WA_BOT_URL', 'http://localhost:3000') }}";

        function cekStatusBotWA() {
            fetch(`${botApiUrl}/api/status`)
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('botStatusBadge');
                    const qrContainer = document.getElementById('qrContainer');
                    const qrImage = document.getElementById('qrImage');
                    const btnReset = document.getElementById('btnResetBot');

                    if (data.status === 'Terkoneksi') {
                        badge.className = "inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200";
                        badge.innerHTML = '<i class="fa-solid fa-check-circle mr-2"></i> Bot Aktif & Terhubung';
                        qrContainer.classList.add('hidden');
                        
                        // Munculkan tombol reset
                        btnReset.classList.remove('hidden');
                        btnReset.classList.add('inline-flex');
                    } 
                    else if (data.status === 'Menunggu Scan QR') {
                        badge.className = "inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200";
                        badge.innerHTML = '<i class="fa-solid fa-qrcode fa-fade mr-2"></i> Menunggu Scan QR Code';
                        qrContainer.classList.remove('hidden');
                        
                        // CEGAH ICON RUSAK: Hanya tampilkan jika QR sudah benar-benar ada
                        if(data.qr_code && data.qr_code !== "") {
                            qrImage.src = data.qr_code;
                            qrImage.style.display = 'block';
                        } else {
                            qrImage.style.display = 'none'; // Sembunyikan gambar sampai QR turun dari server
                        }
                        
                        // Sembunyikan tombol reset
                        btnReset.classList.add('hidden');
                        btnReset.classList.remove('inline-flex');
                    }
                    else {
                        badge.className = "inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200";
                        badge.innerHTML = '<i class="fa-solid fa-triangle-exclamation mr-2"></i> Menunggu Koneksi HP';
                        qrContainer.classList.add('hidden');
                        btnReset.classList.add('hidden');
                        btnReset.classList.remove('inline-flex');
                    }
                })
                .catch(error => {
                    const badge = document.getElementById('botStatusBadge');
                    const btnReset = document.getElementById('btnResetBot');
                    
                    badge.className = "inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200";
                    badge.innerHTML = '<i class="fa-solid fa-power-off mr-2"></i> Server Node.js Offline';
                    
                    document.getElementById('qrContainer').classList.add('hidden');
                    btnReset.classList.add('hidden');
                    btnReset.classList.remove('inline-flex');
                });
        }

        function resetBotWA() {
            if(confirm('Apakah Anda yakin ingin mengeluarkan nomor WA Resepsionis saat ini dan memunculkan QR Code baru?')) {
                const badge = document.getElementById('botStatusBadge');
                badge.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Sedang Memutus Koneksi...';
                
                fetch(`${botApiUrl}/api/logout`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    // Cek status lagi dalam 2 detik
                    setTimeout(cekStatusBotWA, 2000); 
                })
                .catch(error => alert('Gagal terhubung ke Server Bot.'));
            }
        }

        // Cek berkala setiap 4 detik
        setInterval(cekStatusBotWA, 4000);
        // Cek saat pertama dibuka
        document.addEventListener('DOMContentLoaded', cekStatusBotWA);
    </script>
</body>
</html>