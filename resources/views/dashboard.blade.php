<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Pusat Kendali Sistem') }}
                </h2>
                <p class="text-xs font-medium text-slate-500 mt-1">Portal Administrasi Resmi Desa Gunturmadu</p>
            </div>
            <div class="text-xs font-semibold px-4 py-2 bg-slate-100 text-slate-600 rounded-full border border-slate-200/60 tabular-nums shadow-sm self-start md:self-auto">
                📅 {{ \Carbon\Carbon::now()->format('d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 rounded-[32px] p-8 md:p-10 shadow-xl shadow-slate-950/10 text-white border border-slate-800">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/10 blur-[80px] rounded-full"></div>
                <div class="relative z-10 max-w-2xl">
                    <h3 class="text-2xl md:text-3xl font-black tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-3 text-sm md:text-base text-slate-300 font-medium leading-relaxed">
                        Selamat datang di pusat kendali Desa Gunturmadu. Pantau aktivitas warga dan kelola konten desa di sini.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md transition-all">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Artikel</p>
                        <p class="text-3xl font-black text-slate-800">{{ $total_berita ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-500 rounded-2xl text-xl">📰</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md transition-all">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Galeri</p>
                        <p class="text-3xl font-black text-slate-800">{{ $total_galeri ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-rose-50 text-rose-500 rounded-2xl text-xl">📸</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md transition-all">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aparatur</p>
                        <p class="text-3xl font-black text-slate-800">{{ $total_aparatur ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-500 rounded-2xl text-xl">👨‍💼</div>
                </div>

                <a href="{{ route('admin.laporan.index') }}" class="bg-emerald-600 p-6 rounded-3xl shadow-lg shadow-emerald-600/20 flex items-center justify-between group hover:bg-emerald-700 transition-all text-white">
                    <div>
                        <p class="text-[10px] font-bold text-emerald-100 uppercase tracking-widest">Laporan Masuk</p>
                        <p class="text-3xl font-black">{{ $total_laporan_baru ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-white/20 rounded-2xl text-xl animate-bounce">📩</div>
                </a>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-slate-800 tracking-tight mb-6 flex items-center gap-2">
                    <span class="h-4 w-1 bg-emerald-500 rounded-full"></span> Aksi Cepat
                </h3>
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
                    <a href="{{ route('admin.berita.create') }}" class="p-4 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-slate-900 hover:text-white transition text-center text-xs font-bold">✍️ Buat Berita</a>
                    <a href="{{ route('admin.galeri.create') }}" class="p-4 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-slate-900 hover:text-white transition text-center text-xs font-bold">🖼️ Tambah Foto</a>
                    <a href="{{ route('admin.aparatur.create') }}" class="p-4 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-slate-900 hover:text-white transition text-center text-xs font-bold">👤 Data Aparatur</a>
                    <a href="{{ route('admin.laporan.index') }}" class="p-4 rounded-2xl border border-emerald-200 bg-emerald-50 hover:bg-emerald-600 hover:text-white transition text-center text-xs font-bold">📩 Cek Laporan</a>
                    <a href="/" target="_blank" class="p-4 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-slate-900 hover:text-white transition text-center text-xs font-bold">🌏 Buka Web Desa</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>