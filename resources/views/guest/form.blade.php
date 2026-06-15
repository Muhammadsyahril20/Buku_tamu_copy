<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - Pelindo Dumai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-gray-800 font-sans min-h-screen flex justify-center py-12 px-4 relative overflow-x-hidden">
    
    <div class="absolute top-0 left-0 w-full h-64 bg-blue-600 rounded-b-[3rem] shadow-lg -z-10"></div>

    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl max-w-lg w-full border border-gray-100 relative z-10">
        
        <div class="text-center mb-8 border-b border-gray-100 pb-6">
            <h2 class="text-3xl font-extrabold text-blue-700 tracking-tight">PELINDO</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-1 font-semibold">Formulir Kunjungan Tamu</p>
        </div>

        <form action="{{ route('guest.submit') }}" method="POST" onsubmit="return validasiForm()" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="nama_tamu" required placeholder="Masukkan nama Anda" class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-gray-800 text-sm transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Asal Instansi / Perusahaan</label>
                <input type="text" name="asal_instansi" required placeholder="Contoh: PT. ABC / Dinas Sosial / Pribadi" class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-gray-800 text-sm transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">No. Handphone</label>
                    <input type="text" name="no_hp_tamu" required placeholder="08xxxxxxxx" class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-gray-800 text-sm transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Ditujukan Kepada</label>
                    <select name="pegawai_id" required class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-gray-800 text-sm appearance-none transition-all">
                        <option value="">-- Pilih Pejabat --</option>
                        @foreach($pegawais as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Keperluan Kunjungan</label>
                <textarea name="keperluan" rows="2" required placeholder="Jelaskan maksud kedatangan Anda..." class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-gray-800 text-sm transition-all"></textarea>
            </div>

            <div class="pt-2">
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Verifikasi Wajah</label>
                <div class="relative w-full aspect-video bg-gray-100 rounded-xl overflow-hidden border border-gray-300 shadow-inner">
                    <video id="webcam" autoplay playsinline class="w-full h-full object-cover"></video>
                    <canvas id="canvas" class="hidden absolute top-0 left-0 w-full h-full object-cover"></canvas>
                    <div id="suksesNotif" class="absolute inset-0 bg-emerald-600/90 backdrop-blur-sm hidden flex flex-col items-center justify-center text-white">
                        <span class="font-bold text-sm tracking-widest uppercase">Foto Tersimpan</span>
                    </div>
                </div>
                <button type="button" onclick="ambilFoto()" class="mt-3 w-full bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 font-semibold py-2.5 rounded-xl text-sm transition-colors shadow-sm">
                    Ambil Foto Wajah
                </button>
                <input type="hidden" name="foto_selfie" id="foto_selfie">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition-all text-sm tracking-wide shadow-lg shadow-blue-600/30 mt-6">
                KIRIM DATA KUNJUNGAN
            </button>
        </form>
    </div>

    <script>
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const hiddenInput = document.getElementById('foto_selfie');
        const suksesNotif = document.getElementById('suksesNotif');

        navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }, audio: false })
            .then(stream => { video.srcObject = stream; })
            .catch(err => { alert("Harap izinkan akses kamera!"); });

        function ambilFoto() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            hiddenInput.value = canvas.toDataURL('image/jpeg');
            suksesNotif.classList.remove('hidden');
        }

        function validasiForm() {
            if(!hiddenInput.value) {
                alert("Harap ambil foto wajah terlebih dahulu.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>