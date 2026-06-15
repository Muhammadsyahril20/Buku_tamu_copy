<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pegawai - Pelindo Dumai</title>
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
            <nav class="space-y-2 mb-8">
                <a href="{{ route('admin.index') }}" class="flex items-center space-x-3 text-gray-600 p-3 rounded-lg hover:bg-blue-50 font-medium">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> <span>Dashboard Utama</span>
                </a>
                <a href="{{ route('admin.pegawai') }}" class="flex items-center space-x-3 bg-blue-50 text-blue-700 p-3 rounded-lg border border-blue-100 font-medium">
                    <i class="fa-solid fa-users-tie w-5 text-center"></i> <span>Data Pegawai / Pejabat</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 p-10 overflow-y-auto">
            <div class="mb-6">
                <a href="{{ route('admin.pegawai') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold mb-4 inline-block">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Daftar Pegawai
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Edit Data Pejabat: {{ $pegawai->nama_pegawai }}</h2>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-10 max-w-4xl">
                <form action="{{ route('admin.updatePegawai', $pegawai->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <input type="text" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-4 py-2.5 text-sm focus:bg-white focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                            <input type="email" name="email" value="{{ $pegawai->email }}" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-4 py-2.5 text-sm focus:bg-white focus:border-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">No. WhatsApp</label>
                            <input type="text" name="no_wa" value="{{ $pegawai->no_wa }}" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-4 py-2.5 text-sm focus:bg-white focus:border-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Pilih Jabatan</label>
                            <select name="jabatan" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-4 py-2.5 text-sm focus:bg-white focus:border-blue-500 outline-none">
                                <option value="General Manager" {{ $pegawai->jabatan == 'General Manager' ? 'selected' : '' }}>General Manager</option>
                                <option value="Manager" {{ $pegawai->jabatan == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Deputy Manager" {{ $pegawai->jabatan == 'Deputy Manager' ? 'selected' : '' }}>Deputy Manager</option>
                                <option value="Supervisor" {{ $pegawai->jabatan == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                <option value="Staff / Pelaksana" {{ $pegawai->jabatan == 'Staff / Pelaksana' ? 'selected' : '' }}>Staff / Pelaksana</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Pilih Divisi / Bagian</label>
                            <select name="bagian" required class="w-full bg-gray-50 border border-gray-300 text-gray-800 rounded-lg px-4 py-2.5 text-sm focus:bg-white focus:border-blue-500 outline-none">
                                <option value="Humas & Protokoler" {{ $pegawai->bagian == 'Humas & Protokoler' ? 'selected' : '' }}>Humas & Protokoler</option>
                                <option value="Komersial & Operasional" {{ $pegawai->bagian == 'Komersial & Operasional' ? 'selected' : '' }}>Komersial & Operasional</option>
                                <option value="Teknik & IT" {{ $pegawai->bagian == 'Teknik & IT' ? 'selected' : '' }}>Teknik & Sistem Informasi (IT)</option>
                                <option value="SDM & Umum" {{ $pegawai->bagian == 'SDM & Umum' ? 'selected' : '' }}>SDM & Umum</option>
                                <option value="Keuangan" {{ $pegawai->bagian == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-4 pt-4 border-t border-gray-100">
                        <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2.5 px-8 rounded-lg shadow-sm transition-all flex items-center">
                            <i class="fa-solid fa-save mr-2"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>