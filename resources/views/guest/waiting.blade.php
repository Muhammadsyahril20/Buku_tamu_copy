<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Konfirmasi - Pelindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-50 text-gray-800 font-sans min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-full h-64 bg-blue-600 rounded-b-[3rem] shadow-lg -z-10"></div>

    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full text-center border border-gray-100 relative z-10">
        
        <div id="loadingBox" class="space-y-6 py-4">
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-16 w-16 border-[5px] border-gray-100 border-t-blue-600 shadow-sm"></div>
            </div>
            <div>
                <h3 class="text-xl font-extrabold text-gray-800 tracking-tight">Menunggu Konfirmasi...</h3>
                <p class="text-sm text-gray-500 mt-2 leading-relaxed">Permintaan kunjungan Anda telah diteruskan ke<br><span class="text-blue-700 font-bold">{{ $kunjungan->pegawai->nama_pegawai }}</span></p>
            </div>
            
            <div class="bg-blue-50/50 p-4 rounded-xl text-left border border-blue-100 space-y-2 mt-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600"><i class="fa-solid fa-user text-sm"></i></div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Nama Tamu</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $kunjungan->nama_tamu }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600"><i class="fa-solid fa-briefcase text-sm"></i></div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Keperluan</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $kunjungan->keperluan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="resultBox" class="hidden space-y-6 py-4">
            <div id="iconContainer" class="mx-auto w-20 h-20 rounded-full flex items-center justify-center text-4xl shadow-lg mb-4">
                <i id="statusIcon" class="fa-solid"></i>
            </div>
            
            <h3 id="statusTitle" class="text-2xl font-black tracking-tight"></h3>
            <p id="statusDesc" class="text-sm text-gray-600 px-2 leading-relaxed"></p>
            
            <div class="pt-6 border-t border-gray-100 mt-6">
                <span class="bg-gray-100 text-gray-500 px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase">Tunjukkan Layar Ini ke Admin</span>
            </div>
            <a href="{{ route('admin.index') }}" class="mt-4 block text-xs text-blue-600 font-semibold hover:underline">← Kembali ke Dashboard</a>
        </div>

    </div>

    <script>
        const kunjunganId = {{ $kunjungan->id }};
        
        function cekStatusTerbaru() {
            fetch(`/api/cek-status/${kunjunganId}`)
                .then(response => response.json())
                .then(data => {
                    // Jika status di database BUKAN 'Menunggu' lagi
                    if (data.status !== 'Menunggu') {
                        clearInterval(intervalStatus); // Stop auto-refresh
                        
                        // Sembunyikan Loading, Tampilkan Hasil
                        document.getElementById('loadingBox').classList.add('hidden');
                        const resultBox = document.getElementById('resultBox');
                        const iconContainer = document.getElementById('iconContainer');
                        const statusIcon = document.getElementById('statusIcon');
                        const statusTitle = document.getElementById('statusTitle');
                        const statusDesc = document.getElementById('statusDesc');
                        
                        resultBox.classList.remove('hidden');

                        // Ganti Tampilan Berdasarkan Jawaban Bos
                        if (data.status === 'Silahkan Ditemui') {
                            iconContainer.className = "mx-auto w-20 h-20 rounded-full flex items-center justify-center text-4xl shadow-lg mb-4 bg-emerald-100 text-emerald-600 border-4 border-emerald-50";
                            statusIcon.className = "fa-solid fa-check";
                            statusTitle.innerText = "AKSES DIIZINKAN";
                            statusTitle.className = "text-2xl font-black tracking-tight text-emerald-600";
                            statusDesc.innerText = "Bapak/Ibu bersedia menemui Anda. Silakan menuju ke ruang tunggu utama.";
                        } 
                        else if (data.status === 'Sedang Rapat') {
                            iconContainer.className = "mx-auto w-20 h-20 rounded-full flex items-center justify-center text-4xl shadow-lg mb-4 bg-amber-100 text-amber-600 border-4 border-amber-50";
                            statusIcon.className = "fa-solid fa-clock-rotate-left";
                            statusTitle.innerText = "MOHON MENUNGGU";
                            statusTitle.className = "text-2xl font-black tracking-tight text-amber-600";
                            statusDesc.innerText = "Saat ini Pejabat yang dituju sedang dalam rapat. Mohon tunggu sejenak di area resepsionis.";
                        } 
                        else if (data.status === 'Tidak Bisa Ditemui') {
                            iconContainer.className = "mx-auto w-20 h-20 rounded-full flex items-center justify-center text-4xl shadow-lg mb-4 bg-rose-100 text-rose-600 border-4 border-rose-50";
                            statusIcon.className = "fa-solid fa-xmark";
                            statusTitle.innerText = "AKSES DITOLAK";
                            statusTitle.className = "text-2xl font-black tracking-tight text-rose-600";
                            statusDesc.innerText = "Mohon maaf, saat ini beliau tidak dapat ditemui karena ada agenda mendesak.";
                        }
                    }
                })
                .catch(error => console.error('Error fetching status:', error));
        }

        // Jalankan pengecekan setiap 3 detik (3000 ms)
        const intervalStatus = setInterval(cekStatusTerbaru, 3000);
    </script>
</body>
</html>