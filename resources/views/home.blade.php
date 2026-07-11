@extends('layouts.frontend')

@section('content')

<!-- 1. HERO SECTION & CUACA -->
<section class="relative min-h-[90vh] flex items-center pt-28 pb-32 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img
            src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=2000&q=80"
            alt="Pemandangan Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-900/50 to-slate-50"></div>
        <div class="absolute top-20 left-10 w-96 h-96 bg-emerald-400/20 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-400/20 blur-[120px] rounded-full animate-pulse [animation-delay:700ms]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center animate-[fadeInUp_1s_ease-out]">

        <div class="inline-flex flex-wrap items-center justify-center gap-3 sm:gap-5 px-5 sm:px-7 py-3 rounded-full bg-white/10 backdrop-blur-xl border border-white/15 text-white shadow-lg shadow-black/10 mb-8">
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                </span>
                <span class="text-xs sm:text-sm font-medium tracking-wide text-white/90">
                    Portal Resmi Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}
                </span>
            </div>

            <span class="hidden sm:block w-px h-4 bg-white/20"></span>

            <div class="flex items-center gap-2" id="weather-widget">
                <svg id="weather-icon" class="w-4 h-4 text-amber-300 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>
                </svg>
                <span id="weather-temp" class="text-sm font-semibold tabular-nums text-white">--°C</span>
                <span id="weather-desc" class="hidden sm:inline text-xs text-white/60">Memuat cuaca…</span>
            </div>
        </div>

        <h1 class="text-6xl md:text-8xl font-black tracking-tight leading-[0.95] text-white drop-shadow-2xl">
            Desa
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-cyan-200">
                {{ $profil['nama_desa'] ?? 'Gunturmadu' }}
            </span>
        </h1>
        <p class="max-w-3xl mx-auto mt-8 text-lg md:text-xl text-slate-200 leading-relaxed">
            Kecamatan {{ $profil['kecamatan'] ?? '-' }},
            Kabupaten {{ $profil['kabupaten'] ?? '-' }},
            {{ $profil['provinsi'] ?? '-' }}.
            Ruang digital komunitas untuk merayakan keindahan alam, berbagi cerita keseharian warga, dan mengenalkan potensi lokal ke dunia luar.
        </p>
        <div class="flex flex-wrap justify-center gap-4 mt-10">
            <a href="{{ route('berita.index') }}" class="px-8 py-4 rounded-2xl bg-emerald-500 text-white font-semibold shadow-xl shadow-emerald-500/30 hover:scale-105 transition duration-300">
                Baca Cerita Desa
            </a>
            <a href="#statistik" class="px-8 py-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 text-white hover:bg-white/20 transition duration-300">
                Kenali Lebih Dekat
            </a>
        </div>
    </div>

    <!-- Indikator scroll -->
    <a href="#statistik" aria-label="Gulir ke bawah" class="hidden md:flex absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce text-white/60 hover:text-white/90 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </a>
</section>

<!-- 2. STATISTIK & GRAFIK SECTION -->
<!-- 2. STATISTIK & GRAFIK SECTION (VERSI DEMOGRAFI SINKRON MUTAKHIR) -->
<section id="statistik" class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out relative z-20 max-w-7xl mx-auto px-6 -mt-16 mb-24">
    <div class="bg-white/90 backdrop-blur-xl rounded-[36px] border border-white shadow-[0_20px_80px_rgba(15,23,42,0.08)] p-8 md:p-12">
        
        <div class="text-center mb-12">
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Demografi Real-Time</span>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mt-2">Peta Statistik Penduduk</h2>
            <p class="text-slate-500 text-xs font-medium mt-1">Seluruh data rincian sinkron secara otomatis dengan data total warga.</p>
        </div>

        <!-- Baris Kartu Angka Utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="text-center bg-emerald-50 rounded-[28px] p-6 border border-emerald-100 group hover:-translate-y-1 transition-transform duration-300">
                <div class="text-5xl mb-2 group-hover:scale-110 transition-transform">👨‍👩‍👧‍👦</div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Total Warga Desa</p>
                <h3 class="text-4xl font-black text-emerald-600 mt-1 tabular-nums">{{ $profil['total_penduduk'] }}</h3>
            </div>
            <div class="text-center bg-sky-50 rounded-[28px] p-6 border border-sky-100 group hover:-translate-y-1 transition-transform duration-300">
                <div class="text-4xl mb-2 group-hover:scale-110 transition-transform">👨</div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Laki-Laki</p>
                <h3 class="text-3xl font-black text-sky-600 mt-1 tabular-nums">{{ $profil['penduduk_pria'] }}</h3>
            </div>
            <div class="text-center bg-pink-50 rounded-[28px] p-6 border border-pink-100 group hover:-translate-y-1 transition-transform duration-300">
                <div class="text-4xl mb-2 group-hover:scale-110 transition-transform">👩</div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Perempuan</p>
                <h3 class="text-3xl font-black text-pink-500 mt-1 tabular-nums">{{ $profil['penduduk_wanita'] }}</h3>
            </div>
        </div>

        <!-- Baris Grafik Grid (3 Kolom Atas, 2 Kolom Bawah) -->
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 1. Rasio Gender -->
                <div class="bg-slate-50/50 rounded-[28px] p-6 border border-slate-100 shadow-sm flex flex-col justify-between min-h-[320px]">
                    <h4 class="text-slate-700 font-bold text-center text-sm uppercase tracking-wide mb-4"> Rasio Gender</h4>
                    <div class="relative w-full max-w-[180px] aspect-square mx-auto flex items-center">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <!-- 2. Pemetaan Agama (6 Agama + Sisa) -->
                <div class="bg-slate-50/50 rounded-[28px] p-6 border border-slate-100 shadow-sm flex flex-col justify-between min-h-[320px]">
                    <h4 class="text-slate-700 font-bold text-center text-sm uppercase tracking-wide mb-4"> Komposisi Agama</h4>
                    <div class="relative w-full max-w-[180px] aspect-square mx-auto flex items-center">
                        <canvas id="agamaChart"></canvas>
                    </div>
                </div>

                <!-- 3. Tingkat Pendidikan -->
                <div class="bg-slate-50/50 rounded-[28px] p-6 border border-slate-100 shadow-sm flex flex-col justify-between min-h-[320px]">
                    <h4 class="text-slate-700 font-bold text-center text-sm uppercase tracking-wide mb-4"> Jenjang Pendidikan</h4>
                    <div class="relative w-full max-w-[180px] aspect-square mx-auto flex items-center">
                        <canvas id="pendidikanChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 4. Mata Pencaharian -->
                <div class="bg-slate-50/50 rounded-[28px] p-6 border border-slate-100 shadow-sm flex flex-col justify-between min-h-[280px]">
                    <h4 class="text-slate-700 font-bold text-sm uppercase tracking-wide mb-4 flex items-center gap-2"> Pekerjaan Utama</h4>
                    <div class="relative w-full h-[200px] my-auto">
                        <canvas id="pekerjaanChart"></canvas>
                    </div>
                </div>

                <!-- 5. Rentang Usia -->
                <div class="bg-slate-50/50 rounded-[28px] p-6 border border-slate-100 shadow-sm flex flex-col justify-between min-h-[280px]">
                    <h4 class="text-slate-700 font-bold text-sm uppercase tracking-wide mb-4 flex items-center gap-2"> Kelompok Usia</h4>
                    <div class="relative w-full h-[200px] my-auto">
                        <canvas id="usiaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- 3. TENTANG KAMI SECTION -->
<section id="tentang" class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-24">
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-[40px] overflow-hidden shadow-2xl">
        <div class="grid lg:grid-cols-2 gap-12 p-10 md:p-16 items-center">
            <div>
                <span class="inline-block px-4 py-2 rounded-full bg-white/20 text-white text-sm mb-6">Tentang Kami</span>
                <h2 class="text-4xl md:text-5xl font-black text-white leading-tight">Harmoni Alam dan Gotong Royong Warga</h2>
                <p class="mt-6 text-emerald-50 leading-relaxed text-lg">
                    Sebuah ruang yang dibangun dengan penuh kehangatan untuk mendokumentasikan kekayaan budaya, pesona wisata, dan denyut nadi kehidupan warga Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }} sehari-hari.
                </p>
            </div>
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 transform hover:scale-[1.02] transition-transform duration-500">
                <h3 class="text-white font-bold text-2xl mb-6">Kekayaan Desa Kita</h3>
                <div class="space-y-5 text-white font-medium">
                    <div class="flex items-center gap-3"><span>🌾</span> Hasil Bumi & Perkebunan</div>
                    <div class="flex items-center gap-3"><span>🏞️</span> Titik Wisata Tersembunyi</div>
                    <div class="flex items-center gap-3"><span>🏪</span> Karya Tangan & UMKM</div>
                    <div class="flex items-center gap-3"><span>🤝</span> Tradisi & Kebersamaan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. PENGGERAK DESA (APARATUR) SECTION -->
<section class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-24">
    <div class="text-center mb-12">
        <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Wajah Desa</span>
        <h2 class="text-4xl font-black text-slate-900 mt-2">Penggerak Komunitas</h2>
        <p class="text-slate-500 mt-3">Mereka yang berdedikasi melayani dan memajukan desa.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($aparaturs ?? [] as $aparatur)
        <div class="group bg-white rounded-3xl p-6 text-center border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden mb-4 border-4 border-emerald-50 group-hover:border-emerald-200 transition">
                <img src="{{ $aparatur->foto ? asset('storage/'.$aparatur->foto) : 'https://ui-avatars.com/api/?name='.urlencode($aparatur->nama).'&background=10b981&color=fff' }}" alt="{{ $aparatur->nama }}" class="w-full h-full object-cover">
            </div>
            <h4 class="font-bold text-slate-800 text-lg">{{ $aparatur->nama }}</h4>
            <p class="text-emerald-600 text-sm font-medium mt-1">{{ $aparatur->jabatan }}</p>
        </div>
        @empty
        <div class="col-span-full py-12 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
            <p class="text-slate-500">Data penggerak desa belum ditambahkan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- 5. GALERI SECTION (MASONRY GRID) -->
<section id="galeri" class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-24">
    
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
        <div>
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Jejak Visual</span>
            <h2 class="text-4xl font-black text-slate-900 mt-2">Album Kenangan</h2>
        </div>
        <a href="{{ route('galeri.index') }}" class="px-6 py-3 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-lg transition">
            Lihat Semua Foto →
        </a>
    </div>

    <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
        @forelse($galeris ?? [] as $galeri)
        @php
            // Pengamanan ekstrak path jika suatu saat galeri ikutan pakai trik "explode"
            $galeriImgData = explode('|', $galeri->gambar);
            $galeriPath = $galeriImgData[0];
        @endphp
        <button type="button"
                class="gallery-item w-full break-inside-avoid group relative rounded-[24px] overflow-hidden text-left focus:outline-none focus-visible:ring-4 focus-visible:ring-emerald-400/50"
                data-src="{{ asset('storage/'.$galeriPath) }}"
                data-title="{{ $galeri->judul }}">
            <img src="{{ asset('storage/'.$galeriPath) }}" alt="{{ $galeri->judul }}" class="w-full object-cover transform group-hover:scale-105 transition duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                <h4 class="text-white font-bold text-lg">{{ $galeri->judul }}</h4>
            </div>
        </button>
        @empty
        <div class="col-span-full py-20 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200 break-inside-avoid">
            <p class="text-slate-500">Galeri foto desa belum tersedia.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- Lightbox galeri -->
<div id="lightbox" class="hidden fixed inset-0 z-[60] bg-slate-950/90 backdrop-blur-sm items-center justify-center p-6">
    <button id="lightbox-close" aria-label="Tutup" class="absolute top-6 right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
    <figure class="max-w-4xl w-full">
        <img id="lightbox-img" src="" alt="" class="w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl">
        <figcaption id="lightbox-caption" class="text-center text-white/80 mt-4 text-sm"></figcaption>
    </figure>
</div>

<!-- ETALASE POTENSI DESA -->
<section class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-24">
    
    <!-- HEADER & TOMBOL LIHAT SEMUA -->
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
        <div>
            <span class="text-amber-500 font-semibold uppercase tracking-widest text-sm">Keunggulan Kita</span>
            <h2 class="text-4xl font-black text-slate-900 mt-2">Etalase Potensi Desa</h2>
            <p class="text-slate-500 mt-3">Produk lokal unggulan, kerajinan, dan kekayaan alam yang patut dibanggakan.</p>
        </div>
        <a href="{{ route('potensi.index') }}" class="px-6 py-3 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-lg hover:border-amber-300 hover:text-amber-600 transition-all font-semibold text-slate-700 whitespace-nowrap">
            Lihat Semua Potensi →
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @forelse($potensis ?? [] as $potensi)
        @php
            $imgData = explode('|', $potensi->gambar);
            $pathGambar = $imgData[0];
            $posisiFokus = $imgData[1] ?? 'object-center';
        @endphp
        
        <a href="{{ route('potensi.detail', $potensi->slug) }}" class="group bg-white rounded-[32px] overflow-hidden border border-slate-100 shadow-sm hover:-translate-y-3 hover:shadow-[0_20px_60px_rgba(245,158,11,0.15)] transition-all duration-500 flex flex-col block">
            @if($pathGambar)
                <div class="h-64 overflow-hidden relative">
                    <img src="{{ asset('storage/'.$pathGambar) }}" alt="{{ $potensi->judul }}" class="w-full h-full object-cover {{ $posisiFokus }} group-hover:scale-110 transition duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            @else
                <div class="h-64 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                    <span class="text-4xl">🌟</span>
                </div>
            @endif

            <div class="p-8 flex flex-col flex-1 bg-white relative">
                <!-- Ikon mengambang di pojok kanan -->
                <div class="absolute -top-6 right-8 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-amber-500 border border-slate-50 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                
                <h3 class="text-2xl font-black text-slate-800 group-hover:text-amber-500 transition-colors leading-snug mb-3">{{ $potensi->judul }}</h3>
                <p class="text-slate-500 line-clamp-2 leading-relaxed text-sm">{{ Str::limit(strip_tags($potensi->deskripsi), 90) }}</p>
                <div class="mt-6 flex items-center text-amber-500 font-bold text-sm">
                    Lihat Detail Keunggulan <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 py-16 bg-slate-50 border border-dashed border-slate-200 rounded-[32px] text-center">
            <span class="text-4xl mb-4 block">🌾</span>
            <p class="text-slate-500 font-medium">Data potensi desa sedang dalam tahap pendataan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- 6. CERITA TERBARU SECTION -->
<section class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-24">
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
        <div>
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Cerita Terbaru</span>
            <h2 class="text-4xl font-black text-slate-900 mt-2">Kabar & Jurnal Desa</h2>
        </div>
        <a href="{{ route('berita.index') }}" class="px-6 py-3 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-lg transition">
            Lihat Semua Jurnal →
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @forelse($beritaTerbaru ?? [] as $berita)
        @php
            // TRIK SAKTI: Pecah nama file gambar dan class posisi fokusnya
            $imgData = explode('|', $berita->gambar);
            $pathGambar = $imgData[0];
            $posisiFokus = $imgData[1] ?? 'object-center'; // Default ke tengah jika data lama
        @endphp
        
        <article class="group bg-white rounded-[30px] overflow-hidden border border-slate-100 shadow-lg hover:-translate-y-3 hover:shadow-[0_25px_80px_rgba(16,185,129,0.18)] transition-all duration-500 flex flex-col">
            
            @if($pathGambar)
                <div class="h-56 overflow-hidden">
                    <!-- Menyisipkan class $posisiFokus yang dipilih user di admin -->
                    <img src="{{ asset('storage/'.$pathGambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover {{ $posisiFokus }} group-hover:scale-110 transition duration-500">
                </div>
            @else
                <div class="h-56 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 flex items-center justify-center">
                    <svg class="w-20 h-20 text-white/70 group-hover:scale-110 transition duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif

            <div class="p-8 flex flex-col flex-1">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">{{ $berita->created_at->format('d M Y') }}</span>
                <h3 class="mt-4 text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition">{{ $berita->judul }}</h3>
                <p class="mt-4 text-slate-500 line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($berita->konten), 120) }}</p>
                <div class="mt-auto pt-6">
                    <a href="{{ route('berita.detail', $berita->slug) }}" class="inline-flex items-center gap-2 text-emerald-600 font-semibold hover:text-teal-700 transition">Mulai Membaca →</a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-3 bg-white rounded-[32px] border border-dashed border-slate-200 py-20 text-center">
            <p class="text-slate-500">Belum ada cerita yang dibagikan minggu ini.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- 7. PETA WILAYAH SECTION -->
<section class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-24">
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
        <div>
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Lokasi Kami</span>
            <h2 class="text-4xl font-black text-slate-900 mt-2">Peta Wilayah Desa</h2>
            <p class="text-slate-500 mt-3">Kunjungi kami dan nikmati keindahan alam {{ $profil['nama_desa'] ?? 'Gunturmadu' }} secara langsung.</p>
        </div>
    </div>

    <div class="relative w-full h-[400px] md:h-[500px] rounded-[40px] overflow-hidden shadow-[0_20px_80px_rgba(15,23,42,0.08)] border border-slate-100 group">
        <iframe
            src="https://maps.google.com/maps?q={{ urlencode('Desa '.($profil['nama_desa'] ?? 'Gunturmadu').', '.($profil['kecamatan'] ?? '').', '.($profil['kabupaten'] ?? '')) }}&t=&z=14&ie=UTF8&iwloc=&output=embed"
            class="absolute inset-0 w-full h-full border-0 grayscale-[20%] group-hover:grayscale-0 transition-all duration-700"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>

        <div class="absolute bottom-6 left-6 right-6 md:right-auto md:w-96 bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-white/50">
            <h4 class="font-bold text-slate-800 text-lg mb-2">📍 Balai Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}</h4>
            <p class="text-slate-500 text-sm leading-relaxed mb-4">
                Kecamatan {{ $profil['kecamatan'] ?? '-' }}, Kabupaten {{ $profil['kabupaten'] ?? '-' }}, Provinsi {{ $profil['provinsi'] ?? '-' }}
            </p>
            <a href="https://maps.google.com/maps?q={{ urlencode('Desa '.($profil['nama_desa'] ?? 'Gunturmadu').', '.($profil['kecamatan'] ?? '').', '.($profil['kabupaten'] ?? '')) }}" target="_blank" class="block w-full text-center px-4 py-2 bg-emerald-50 text-emerald-700 font-semibold rounded-xl hover:bg-emerald-100 transition">
                Buka di Google Maps
            </a>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="scroll-reveal opacity-0 translate-y-10 transition-all duration-1000 ease-out delay-100 max-w-7xl mx-auto px-6 mb-12">
    <div class="rounded-[40px] bg-slate-900 overflow-hidden relative">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-cyan-500/20"></div>
        <div class="relative p-12 md:p-20 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-white">Mari Merangkai Cerita dari Desa</h2>
            <p class="max-w-2xl mx-auto mt-6 text-slate-300 text-lg">
                Temukan kedamaian, inspirasi, dan kehangatan dari setiap sudut pandang warga Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}.
            </p>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ==========================================
        // KONFIGURASI GLOBAL CHART.JS
        // ==========================================
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.font.weight = '600';
        Chart.defaults.color = '#64748b'; 
        Chart.defaults.scale.grid.color = '#f1f5f9'; 

        // ==========================================
        // TRIK STRING WRAP BIAR VS CODE NGGAK ERROR
        // ==========================================
        const dataGender = [
            parseInt("{{ $profil['penduduk_pria'] ?? 0 }}"), 
            parseInt("{{ $profil['penduduk_wanita'] ?? 0 }}")
        ];
        
        const dataAgama = [
            parseInt("{{ $profil['agama_islam'] ?? 0 }}"), 
            parseInt("{{ $profil['agama_kristen'] ?? 0 }}"), 
            parseInt("{{ $profil['agama_katolik'] ?? 0 }}"), 
            parseInt("{{ $profil['agama_hindu'] ?? 0 }}"), 
            parseInt("{{ $profil['agama_buddha'] ?? 0 }}"), 
            parseInt("{{ $profil['agama_khonghucu'] ?? 0 }}"),
            parseInt("{{ $profil['agama_lainnya'] ?? 0 }}")
        ];

        const dataPendidikan = [
            parseInt("{{ $profil['pend_tidak_sekolah'] ?? 0 }}"), 
            parseInt("{{ $profil['pend_sd'] ?? 0 }}"), 
            parseInt("{{ $profil['pend_smp'] ?? 0 }}"), 
            parseInt("{{ $profil['pend_sma'] ?? 0 }}"), 
            parseInt("{{ $profil['pend_tinggi'] ?? 0 }}")
        ];

        const dataPekerjaan = [
            parseInt("{{ $profil['pekerjaan_petani'] ?? 0 }}"), 
            parseInt("{{ $profil['pekerjaan_pedagang'] ?? 0 }}"), 
            parseInt("{{ $profil['pekerjaan_swasta'] ?? 0 }}"), 
            parseInt("{{ $profil['pekerjaan_pns'] ?? 0 }}"), 
            parseInt("{{ $profil['pekerjaan_lainnya'] ?? 0 }}")
        ];

        const dataUsia = [
            parseInt("{{ $profil['usia_balita'] ?? 0 }}"), 
            parseInt("{{ $profil['usia_anak'] ?? 0 }}"), 
            parseInt("{{ $profil['usia_remaja'] ?? 0 }}"), 
            parseInt("{{ $profil['usia_dewasa'] ?? 0 }}"), 
            parseInt("{{ $profil['usia_lansia'] ?? 0 }}")
        ];

        // 1. CHART GENDER (Doughnut)
        new Chart(document.getElementById('genderChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    data: dataGender,
                    backgroundColor: ['#0ea5e9', '#ec4899'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '78%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, font: { size: 11 } } } } }
        });

        // 2. CHART AGAMA (Pie)
        new Chart(document.getElementById('agamaChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu', 'Lainnya'],
                datasets: [{
                    data: dataAgama,
                    backgroundColor: ['#10b981', '#8b5cf6', '#3b82f6', '#f59e0b', '#ec4899', '#f43f5e', '#cbd5e1'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 6, font: { size: 10 } } } } }
        });

        // 3. CHART PENDIDIKAN (Doughnut)
        new Chart(document.getElementById('pendidikanChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Blm Sekolah', 'SD', 'SMP', 'SMA/SMK', 'Sarjana'],
                datasets: [{
                    data: dataPendidikan,
                    backgroundColor: ['#64748b', '#f59e0b', '#3b82f6', '#10b981', '#ff0000'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 6, font: { size: 10 } } } } }
        });

        // 4. CHART PEKERJAAN (Horizontal Bar)
        new Chart(document.getElementById('pekerjaanChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Petani/Kebun', 'Pedagang/UMKM', 'Karyawan Swasta', 'PNS/TNI/Polri', 'Lainnya'],
                datasets: [{
                    label: 'Jumlah Warga',
                    data: dataPekerjaan,
                    backgroundColor: '#14b8a6', 
                    borderRadius: 6,
                    maxBarThickness: 32 
                }]
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { display: false } } } }
        });

        // 5. CHART KELOMPOK USIA (Vertical Bar)
        new Chart(document.getElementById('usiaChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['0-4 Thn', '5-14 Thn', '15-24 Thn', '25-54 Thn', '55+ Thn'],
                datasets: [{
                    label: 'Jumlah Warga',
                    data: dataUsia,
                    backgroundColor: '#6366f1', 
                    borderRadius: 6,
                    maxBarThickness: 40 
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { grid: { color: '#f8fafc' } } } }
        });

        // ==========================================
        // FITUR LAINNYA (Scroll, Cuaca, Lightbox)
        // (Kodingan bagian bawahnya biarkan persis seperti sebelumnya)
        // ==========================================


        // ==========================================
        // FITUR LAINNYA (Scroll, Cuaca, Lightbox)
        // ==========================================

        // --- Animasi scroll reveal ---
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-reveal').forEach((el) => observer.observe(el));

        // --- Widget cuaca (Open-Meteo) ---
        const lat = "{{ $profil['latitude'] ?? '' }}" || "-4.9489";
        const lon = "{{ $profil['longitude'] ?? '' }}" || "105.3271";

        const weatherIcons = {
            sun:   { d: '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>', label: 'Cerah', color: 'text-amber-300' },
            cloud: { d: '<path d="M6.8 18.5a4.3 4.3 0 010-8.6 5.8 5.8 0 0111.2-1.4A3.8 3.8 0 0117.3 16H6.8z"/>', label: 'Berawan', color: 'text-slate-200' },
            rain:  { d: '<path d="M6.8 14.5a4.3 4.3 0 010-8.6 5.8 5.8 0 0111.2-1.4A3.8 3.8 0 0117.3 12H6.8z"/><path d="M9 17.5v2M13 17.5v2M16.5 16v2" stroke-linecap="round"/>', label: 'Hujan', color: 'text-sky-300' },
            storm: { d: '<path d="M6.8 13.5a4.3 4.3 0 010-8.6 5.8 5.8 0 0111.2-1.4A3.8 3.8 0 0117.3 11H6.8z"/><path d="M12.5 12l-2 4h3l-1 4 4-6h-3l1-2z" fill="currentColor" stroke="none"/>', label: 'Badai', color: 'text-indigo-300' },
        };

        function applyWeatherIcon(key, temp) {
            const w = weatherIcons[key] || weatherIcons.cloud;
            const icon = document.getElementById('weather-icon');
            icon.innerHTML = w.d;
            icon.setAttribute('class', 'w-4 h-4 shrink-0 ' + w.color);
            document.getElementById('weather-temp').textContent = `${Math.round(temp)}°C`;
            document.getElementById('weather-desc').textContent = w.label;
        }

        async function fetchWeather() {
            try {
                const res = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`);
                const data = await res.json();
                const temp = data.current_weather.temperature;
                const code = data.current_weather.weathercode;

                let key = 'cloud';
                if (code === 0) key = 'sun';
                else if (code <= 3) key = 'cloud';
                else if (code >= 45 && code <= 48) key = 'cloud';
                else if (code >= 51 && code <= 82) key = 'rain';
                else if (code >= 95) key = 'storm';

                applyWeatherIcon(key, temp);
            } catch (e) {
                document.getElementById('weather-temp').textContent = '--°C';
                document.getElementById('weather-desc').textContent = 'Cuaca tidak tersedia';
            }
        }
        fetchWeather();

        // --- Lightbox galeri ---
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCaption = document.getElementById('lightbox-caption');

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', () => {
                lightboxImg.src = item.dataset.src;
                lightboxImg.alt = item.dataset.title;
                lightboxCaption.textContent = item.dataset.title;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            });
        });

        function closeLightbox() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            lightboxImg.src = '';
        }
        if (document.getElementById('lightbox-close')) {
            document.getElementById('lightbox-close').addEventListener('click', closeLightbox);
        }
        if (lightbox) {
            lightbox.addEventListener('click', (e) => { if (e.target === lightbox) closeLightbox(); });
        }
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeLightbox(); });
    });
</script>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection