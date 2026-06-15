<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Pesan WhatsApp - Pelindo Dumai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">
    
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full text-center border border-gray-100">
        <h3 class="text-2xl font-bold text-blue-700 mb-2">Data Berhasil Disimpan!</h3>
        <p class="text-gray-500 text-sm mb-6">Langkah selanjutnya: Kirim notifikasi WA ke pejabat yang dituju.</p>

        <div id="blockedWarning" class="hidden bg-rose-50 text-rose-600 text-xs p-3 rounded-lg border border-rose-100 mb-6 font-semibold">
            Browser memblokir pop-up otomatis. Silakan klik tombol biru di bawah secara manual.
        </div>

        <div class="space-y-3">
            <a href="{!! $waUrl !!}" target="_blank" onclick="lanjutKeRuangTunggu()" class="block w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-md">
                Kirim Pesan WhatsApp Web
            </a>

            <a href="{{ $waitingUrl }}" id="btnLanjut" class="hidden w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-md">
                Lanjut ke Ruang Tunggu Tamu
            </a>
        </div>
    </div>

    <script>
        // Coba buka WA Web secara otomatis
        let waWindow = window.open("{!! $waUrl !!}", '_blank');

        if (!waWindow || waWindow.closed || typeof waWindow.closed == 'undefined') {
            // JIKA DIBLOKIR: Tampilkan peringatan, tunggu admin klik manual
            document.getElementById('blockedWarning').classList.remove('hidden');
        } else {
            // JIKA BERHASIL TERBUKA OTOMATIS: Langsung pindahkan layar utama ke ruang tunggu
            window.location.href = "{{ $waitingUrl }}";
        }

        // Fungsi jika admin terpaksa klik tombol manual
        function lanjutKeRuangTunggu() {
            document.getElementById('btnLanjut').classList.remove('hidden');
            // Alihkan halaman setelah 2 detik
            setTimeout(function() {
                window.location.href = "{{ $waitingUrl }}";
            }, 2000);
        }
    </script>
</body>
</html>