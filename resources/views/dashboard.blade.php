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
                <div class="absolute right-1/4 top-0 w-40 h-40 bg-cyan-500/10 blur-[60px] rounded-full"></div>
                
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold uppercase tracking-wider mb-4">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Sistem Aktif
                    </span>
                    <h3 class="text-2xl md:text-3xl font-black tracking-tight">Selamat Datang Kembali, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-3 text-sm md:text-base text-slate-300 font-medium leading-relaxed">
                        Ruang integrasi digital Desa Gunturmadu. Di sini Anda dapat memperbarui informasi publik, mengelola data statistik aparatur, serta mendokumentasikan album kegiatan warga secara *real-time*.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Artikel & Berita</p>
                        <p class="text-4xl font-black text-slate-800 tracking-tight">{{ $total_berita ?? 0 }}</p>
                        <p class="text-xs text-slate-500 font-medium pt-1">Telah dipublikasikan</p>
                    </div>
                    <div class="p-4 bg-blue-50 text-blue-500 rounded-2xl text-2xl group-hover:scale-110 transition-transform duration-300 shadow-inner">📰</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Dokumentasi Galeri</p>
                        <p class="text-4xl font-black text-slate-800 tracking-tight">{{ $total_galeri ?? 0 }}</p>
                        <p class="text-xs text-slate-500 font-medium pt-1">Foto album warga</p>
                    </div>
                    <div class="p-4 bg-rose-50 text-rose-500 rounded-2xl text-2xl group-hover:scale-110 transition-transform duration-300 shadow-inner">📸</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between group hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Struktur Aparatur</p>
                        <p class="text-4xl font-black text-slate-800 tracking-tight">{{ $total_aparatur ?? 0 }}</p>
                        <p class="text-xs text-slate-500 font-medium pt-1">Penggerak pemerintahan</p>
                    </div>
                    <div class="p-4 bg-amber-50 text-amber-500 rounded-2xl text-2xl group-hover:scale-110 transition-transform duration-300 shadow-inner">👨‍💼</div>
                </div>
            </div>

            <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-slate-800 tracking-tight mb-6 flex items-center gap-2">
                    <span class="h-4 w-1 bg-emerald-500 rounded-full"></span>
                    Aksi Kendali Cepat
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.berita.create') }}" class="p-4 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-slate-900 hover:text-white transition-all duration-300 font-semibold text-sm text-slate-700 text-center flex flex-col items-center justify-center gap-2 shadow-sm">
                        <span class="text-xl">✍️</span> Tulis Berita Baru
                    </a>
                    <a href="{{ route('admin.galeri.create') }}" class="p-4 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-slate-900 hover:text-white transition-all duration-300 font-semibold text-sm text-slate-700 text-center flex flex-col items-center justify-center gap-2 shadow-sm">
                        <span class="text-xl">🖼️</span> Unggah Foto Galeri
                    </a>
                    <a href="{{ route('admin.aparatur.create') }}" class="p-4 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-slate-900 hover:text-white transition-all duration-300 font-semibold text-sm text-slate-700 text-center flex flex-col items-center justify-center gap-2 shadow-sm">
                        <span class="text-xl">👤</span> Tambah Aparatur Desa
                    </a>
                    <a href="/" target="_blank" class="p-4 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all duration-300 font-bold text-sm text-center flex flex-col items-center justify-center gap-2 shadow-sm">
                        <span class="text-xl">🌏</span> Lihat Tampilan Warga ↗
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>