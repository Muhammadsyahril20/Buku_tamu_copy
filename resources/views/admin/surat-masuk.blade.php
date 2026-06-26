<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serah Terima Surat - Pelindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <style> .canvas-container { border: 2px dashed #cbd5e1; border-radius: 0.5rem; background-color: #f8fafc; touch-action: none; } </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    
    <div class="md:hidden bg-blue-700 text-white p-4 flex justify-between items-center shadow-md">
        <div class="font-bold tracking-wider text-sm flex items-center">
            <i class="fa-solid fa-ship mr-2"></i> PELINDO DUMAI
        </div>
        <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="text-white focus:outline-none">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>
    </div>

    <div class="flex min-h-screen relative">
        
        <div id="mobileMenu" class="hidden md:flex w-full md:w-64 bg-white border-r border-gray-200 p-6 flex-col shadow-sm absolute md:relative z-50 h-full">
            <div class="mb-10 text-center md:block hidden">
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
                <a href="{{ route('admin.rekap') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 font-medium transition-colors">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> <span>Rekap Data Tamu</span>
                </a>
                <a href="{{ route('admin.surat') }}" class="flex items-center space-x-3 bg-blue-50 text-blue-700 p-3 rounded-lg border border-blue-100 font-medium transition-colors">
                    <i class="fa-solid fa-envelope-open-text w-5 text-center"></i> <span>Surat Masuk (E-Sign)</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 p-4 md:p-10 overflow-y-auto w-full">
            
            <div class="mb-6 border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Serah Terima Surat Masuk</h2>
                <p class="text-sm text-gray-500 mt-1">Form penerimaan surat fisik beserta e-signature pengirim & admin.</p>
            </div>

            @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg relative mb-6 font-semibold shadow-sm text-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white p-4 md:p-6 rounded-xl border border-gray-200 shadow-sm mb-10">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2"><i class="fa-solid fa-pen-nib text-blue-600 mr-2"></i> Form Input Surat Baru</h3>
                <form action="{{ route('admin.surat.store') }}" method="POST" enctype="multipart/form-data" id="formSurat">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Pengirim</label>
                            <input type="text" name="nama_pengirim" required class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Admin (Penerima)</label>
                            <input type="text" name="nama_penerima" required placeholder="Nama Anda..." class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Asal Instansi</label>
                            <input type="text" name="instansi" required class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Foto Bukti Surat (Opsional)</label>
                            <input type="file" name="foto_dokumen" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Perihal / Isi Surat</label>
                            <input type="text" name="perihal" required class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:border-blue-500 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-blue-600 uppercase mb-2 text-center">TTD Pengirim</label>
                            <div class="canvas-container relative w-full h-48">
                                <canvas id="canvasPengirim" class="w-full h-full rounded-lg"></canvas>
                                <button type="button" onclick="padPengirim.clear()" class="absolute bottom-2 right-2 bg-gray-200 hover:bg-gray-300 text-gray-600 text-xs px-2 py-1 rounded shadow-sm">Hapus</button>
                            </div>
                            <input type="hidden" name="ttd_pengirim" id="inputTtdPengirim">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-600 uppercase mb-2 text-center">TTD Admin Penerima</label>
                            <div class="canvas-container relative w-full h-48">
                                <canvas id="canvasPenerima" class="w-full h-full rounded-lg"></canvas>
                                <button type="button" onclick="padPenerima.clear()" class="absolute bottom-2 right-2 bg-gray-200 hover:bg-gray-300 text-gray-600 text-xs px-2 py-1 rounded shadow-sm">Hapus</button>
                            </div>
                            <input type="hidden" name="ttd_penerima" id="inputTtdPenerima">
                        </div>
                    </div>

                    <button type="button" onclick="submitFormSurat()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all">
                        <i class="fa-solid fa-save mr-2"></i> Simpan Data & Tanda Tangan
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-10">
                <div class="p-4 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50">
                    <h3 class="font-bold text-gray-800"><i class="fa-solid fa-list text-blue-600 mr-2"></i> Log Surat Masuk</h3>
                    <div class="flex space-x-2 w-full md:w-auto">
                        <a href="{{ route('admin.surat.excel') }}" class="flex-1 text-center bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-2 px-4 rounded shadow-sm transition-all"><i class="fa-solid fa-file-excel mr-1"></i> Excel</a>
                        <a href="{{ route('admin.surat.pdf') }}" class="flex-1 text-center bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold py-2 px-4 rounded shadow-sm transition-all"><i class="fa-solid fa-file-pdf mr-1"></i> PDF</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-max">
                        <thead class="bg-white text-xs text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Tanggal</th>
                                <th class="px-4 py-3 font-semibold">Pengirim</th>
                                <th class="px-4 py-3 font-semibold">Instansi</th>
                                <th class="px-4 py-3 font-semibold">Perihal</th>
                                <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($surats as $s)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-4 py-3 text-gray-500">{{ $s->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 font-bold text-gray-800">{{ $s->nama_pengirim }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $s->instansi }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $s->perihal }}</td>
                                <td class="px-4 py-3 text-center space-x-1">
                                    
                                    <a href="{{ route('admin.surat.print', $s->id) }}" target="_blank" class="inline-block bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white p-2 rounded transition-all" title="Cetak Tanda Bukti">
                                        <i class="fa-solid fa-print"></i>
                                    </a>

                                    <button onclick="bukaModalEdit({{ $s->id }}, '{{ addslashes($s->nama_pengirim) }}', '{{ addslashes($s->nama_penerima) }}', '{{ addslashes($s->instansi) }}', '{{ addslashes($s->perihal) }}')" class="bg-amber-100 text-amber-700 hover:bg-amber-500 hover:text-white p-2 rounded transition-all" title="Edit Teks">
    <i class="fa-solid fa-edit"></i>
</button>

                                    <form action="{{ route('admin.surat.destroy', $s->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus data surat ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-rose-100 text-rose-700 hover:bg-rose-600 hover:text-white p-2 rounded transition-all" title="Hapus Data">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada surat masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[100] px-4">
        <div class="bg-white rounded-xl w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Edit Data Surat Masuk</h3>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500">Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" id="editNama" class="w-full border rounded px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500">Nama Penerima</label>
                        <input type="text" name="nama_penerima" id="editPenerima" class="w-full border rounded px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500">Instansi</label>
                        <input type="text" name="instansi" id="editInstansi" class="w-full border rounded px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500">Perihal</label>
                        <input type="text" name="perihal" id="editPerihal" class="w-full border rounded px-3 py-2 text-sm outline-none focus:border-blue-500">
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded text-sm font-bold">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded text-sm font-bold">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function resizeCanvas(canvas) {
            const ratio =  Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        const canvasPengirim = document.getElementById('canvasPengirim');
        const canvasPenerima = document.getElementById('canvasPenerima');

        window.onresize = () => { resizeCanvas(canvasPengirim); resizeCanvas(canvasPenerima); };
        resizeCanvas(canvasPengirim); resizeCanvas(canvasPenerima);

        const padPengirim = new SignaturePad(canvasPengirim, { penColor: 'rgb(0, 0, 255)' }); 
        const padPenerima = new SignaturePad(canvasPenerima, { penColor: 'rgb(0, 0, 0)' }); 

        function submitFormSurat() {
            if (padPengirim.isEmpty()) return alert("TTD Pengirim belum diisi!");
            if (padPenerima.isEmpty()) return alert("TTD Admin Penerima belum diisi!");

            document.getElementById('inputTtdPengirim').value = padPengirim.toDataURL();
            document.getElementById('inputTtdPenerima').value = padPenerima.toDataURL();
            document.getElementById('formSurat').submit();
        }

       // Fungsi buka Modal Edit
        function bukaModalEdit(id, nama, penerima, instansi, perihal) {
            document.getElementById('editNama').value = nama;
            document.getElementById('editPenerima').value = penerima;
            document.getElementById('editInstansi').value = instansi;
            document.getElementById('editPerihal').value = perihal;
            document.getElementById('formEdit').action = `/admin/surat-masuk/${id}`;
            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('modalEdit').classList.add('flex');
        }
    </script>
</body>
</html>