<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Pusat Kendali Sistem') }}
                </h2>
                <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-wider">Portal Admin Desa Gunturmadu</p>
            </div>
            <div class="inline-flex items-center gap-2 text-xs font-bold px-4 py-2 bg-white text-slate-600 rounded-full border border-slate-200 shadow-sm tabular-nums">
                <span class="text-emerald-500 text-base">📅</span> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)] relative overflow-hidden">
        
        <!-- Ornamen Latar Belakang Dreamy -->
        <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/40 to-transparent z-0 pointer-events-none"></div>
        <div class="absolute -left-20 top-40 w-96 h-96 bg-cyan-200/20 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- 1. BANNER SELAMAT DATANG -->
            <div class="relative overflow-hidden bg-slate-900 rounded-[32px] p-8 md:p-10 shadow-2xl shadow-slate-900/10 text-white border border-slate-800 group">
                <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-emerald-500/20 blur-[80px] rounded-full group-hover:bg-emerald-400/30 transition-colors duration-700"></div>
                <div class="absolute right-1/4 top-0 w-40 h-40 bg-cyan-500/20 blur-[60px] rounded-full"></div>
                
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/10 text-emerald-300 text-[10px] font-black uppercase tracking-widest mb-5">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                        </span>
                        Sistem Berjalan Normal
                    </span>
                    <h3 class="text-3xl md:text-4xl font-black tracking-tight mb-3">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-sm md:text-base text-slate-300 font-medium leading-relaxed">
                        Selamat datang di pusat kendali administrasi digital. Pantau interaksi warga, kelola informasi publik, dan perbarui potensi desa dengan mudah dari sini.
                    </p>
                </div>
            </div>

            <!-- 2. GRID STATISTIK KONTEN -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
                
                <!-- Statistik Standar (Pakai Looping biar rapi kodenya) -->
                @php
                    $stats = [
                        ['label' => 'Artikel', 'count' => $total_berita ?? 0, 'icon' => '📰', 'color' => 'blue'],
                        ['label' => 'Potensi', 'count' => $total_potensi ?? 0, 'icon' => '🌟', 'color' => 'amber'],
                        ['label' => 'Galeri', 'count' => $total_galeri ?? 0, 'icon' => '📸', 'color' => 'rose'],
                        ['label' => 'Aparatur', 'count' => $total_aparatur ?? 0, 'icon' => '👨‍💼', 'color' => 'indigo'],
                    ];
                @endphp

                @foreach($stats as $stat)
                <div class="bg-white p-6 rounded-[28px] border border-slate-100 shadow-sm flex flex-col justify-between group hover:shadow-xl hover:shadow-{{ $stat['color'] }}-500/5 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-500 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                            {{ $stat['icon'] }}
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-slate-800 tracking-tight">{{ $stat['count'] }}</p>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ $stat['label'] }}</p>
                    </div>
                </div>
                @endforeach

                <!-- Highlight: Laporan Masuk (Sengaja dibikin beda biar mencolok) -->
                <a href="{{ route('admin.laporan.index') }}" class="col-span-2 md:col-span-1 lg:col-span-1 bg-gradient-to-br from-emerald-500 to-teal-600 p-6 rounded-[28px] shadow-lg shadow-emerald-600/20 flex flex-col justify-between group hover:from-emerald-600 hover:to-teal-700 hover:-translate-y-1 transition-all duration-300 text-white border border-emerald-400/30">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 text-white flex items-center justify-center text-2xl backdrop-blur-sm group-hover:animate-bounce">
                            📩
                        </div>
                        @if(($total_laporan_baru ?? 0) > 0)
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500 border border-white"></span>
                            </span>
                        @endif
                    </div>
                    <div>
                        <p class="text-3xl font-black tracking-tight">{{ $total_laporan_baru ?? 0 }}</p>
                        <p class="text-[11px] font-bold text-emerald-100 uppercase tracking-widest mt-1">Laporan Baru</p>
                    </div>
                </a>
            </div>

            <!-- 3. MENU AKSI CEPAT -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-6 md:p-8">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-3">
                    <span class="h-5 w-1.5 bg-emerald-500 rounded-full"></span> 
                    Aksi Cepat
                </h3>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4">
                    @php
                        $actions = [
                            ['route' => 'admin.berita.create', 'icon' => '✍️', 'label' => 'Buat Berita'],
                            ['route' => 'admin.potensi.create', 'icon' => '🌟', 'label' => 'Tambah Potensi'],
                            ['route' => 'admin.galeri.create', 'icon' => '🖼️', 'label' => 'Unggah Foto'],
                            ['route' => 'admin.aparatur.create', 'icon' => '👤', 'label' => 'Data Aparatur'],
                            ['route' => 'admin.laporan.index', 'icon' => '📩', 'label' => 'Cek Laporan', 'color' => 'emerald'],
                            ['route' => 'home', 'icon' => '🌏', 'label' => 'Buka Web', 'is_blank' => true],
                        ];
                    @endphp

                    @foreach($actions as $action)
                        <a href="{{ route($action['route']) }}" 
                           {{ isset($action['is_blank']) ? 'target="_blank"' : '' }} 
                           class="p-4 rounded-2xl border flex flex-col items-center justify-center gap-3 text-center transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 
                           {{ isset($action['color']) && $action['color'] == 'emerald' 
                                ? 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white' 
                                : 'border-slate-100 bg-slate-50 text-slate-700 hover:bg-slate-900 hover:text-white hover:border-slate-800' 
                           }}">
                            <span class="text-2xl">{{ $action['icon'] }}</span>
                            <span class="text-xs font-bold">{{ $action['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>