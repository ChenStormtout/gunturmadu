@extends('layouts.frontend')

@section('title', $berita->judul)

@section('content')

@php
    // Pecah data gambar terlebih dahulu menggunakan trik explode
    // $imgData[0] berisi nama file asli di storage
    // $imgData[1] berisi posisi fokus untuk menu utama (kita abaikan di sini agar tampil full utuh)
    $imgData = explode('|', $berita->gambar);
    $pathGambar = $imgData[0];
@endphp

{{-- Spasi top-28 agar konten tidak tenggelam di bawah fixed navbar lu --}}
<div class="pt-28 pb-20 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- 1. BREADCRUMB (Navigasi Jejak) --}}
        <nav class="flex text-sm text-slate-500 mb-8 font-medium">
            <a href="/" class="hover:text-emerald-600 transition">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('berita.index') }}" class="hover:text-emerald-600 transition">Berita</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 truncate max-w-[200px] sm:max-w-xs font-semibold">{{ $berita->judul }}</span>
        </nav>

        {{-- 2. HEADER ARTIKEL --}}
        <header class="mb-10 animate-[fadeInUp_0.5s_ease-out]">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-widest mb-4 border border-emerald-100">
                📅 {{ $berita->created_at->translatedFormat('l, d F Y') }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-[1.15] tracking-tight mb-6">
                {{ $berita->judul }}
            </h1>
            
            {{-- Tombol Share Media Sosial --}}
            <div class="flex items-center gap-3 border-y border-slate-200/80 py-4">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Bagikan:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all shadow-sm" title="Bagikan ke WhatsApp">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Bagikan ke Facebook">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
            </div>
        </header>

        {{-- 3. FOTO UTAMA BERITA DENGAN TRIGGER LIGHTBOX --}}
        @if($pathGambar)
            {{-- Mengubah container agar flex justify-center dan memberikan bg-slate-900/5 untuk menjaga estetika jika foto berbentuk potret --}}
            <div id="trigger-lightbox" class="mb-12 rounded-[32px] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] relative group animate-[fadeInUp_0.7s_ease-out] cursor-zoom-in bg-slate-900/[0.02] flex justify-center items-center border border-slate-100">
                
                {{-- PERUBAHAN: Menggunakan h-auto, max-h-[600px] dan object-contain agar foto tampil 100% utuh tanpa kepotong sisi manapun --}}
                <img src="{{ asset('storage/'.$pathGambar) }}" alt="{{ $berita->judul }}" class="w-full h-auto max-h-[600px] object-contain transform group-hover:scale-[1.01] transition duration-700 ease-out">
                
                <div class="absolute inset-0 bg-slate-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <div class="bg-white/90 backdrop-blur-sm text-emerald-600 p-4 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
        @endif

        {{-- 4. KONTEN / ISI UTAMA ARTIKEL --}}
        <article class="text-slate-700 leading-relaxed text-base sm:text-lg space-y-6 animate-[fadeInUp_0.9s_ease-out]">
            <div class="whitespace-pre-line font-normal tracking-wide">
                {!! nl2br(e($berita->konten)) !!}
            </div>
        </article>

        {{-- 5. TOMBOL KEMBALI --}}
        <div class="mt-16 border-t border-slate-200/80 pt-8 flex">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2.5 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold text-sm hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Berita Desa
            </a>
        </div>

    </div>
</div>

{{-- STRUKTUR LIGHTBOX / POP-UP FULLSCREEN --}}
<div id="lightbox" class="hidden fixed inset-0 z-[100] bg-slate-950/95 backdrop-blur-md items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
    <button id="lightbox-close" aria-label="Tutup" class="absolute top-4 right-4 sm:top-6 sm:right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-rose-500 hover:text-white text-white/70 flex items-center justify-center transition duration-300 z-10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
    <figure id="lightbox-content" class="max-w-6xl w-full flex flex-col items-center transform scale-95 transition-transform duration-300">
        {{-- Di pop-up lightbox, gambar juga diset object-contain penuh agar terlihat total dimensinya --}}
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
        <figcaption id="lightbox-caption" class="text-center text-white/90 mt-5 text-sm sm:text-base font-medium tracking-wide"></figcaption>
    </figure>
</div>

{{-- 6. SEKSI REKOMENDASI BERITA LAIN (BACA JUGA) --}}
@if(isset($beritaLainnya) && $beritaLainnya->count() > 0)
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center gap-3 tracking-tight">
            <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
            Kabar Desa Lainnya
        </h3>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($beritaLainnya as $lain)
            @php
                // Pecah juga gambar berita rekomendasi lainnya
                $lainImgData = explode('|', $lain->gambar);
                $lainPathGambar = $lainImgData[0];
                $lainPosisiFokus = $lainImgData[1] ?? 'object-center';
            @endphp
            <a href="{{ route('berita.detail', $lain->slug) }}" class="group block flex flex-col h-full">
                <div class="bg-slate-50/50 rounded-[30px] overflow-hidden border border-slate-100 shadow-sm group-hover:shadow-xl group-hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                    
                    @if($lainPathGambar)
                        {{-- Pada bagian menu rekomendasi bawah, kita terapkan variabel posisi fokus agar terpotong visual secara rapi --}}
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/'.$lainPathGambar) }}" alt="{{ $lain->judul }}" class="w-full h-full object-cover {{ $lainPosisiFokus }} group-hover:scale-110 transition duration-500">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    @endif
                    
                    <div class="p-6 flex flex-col flex-1">
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-2">{{ $lain->created_at->format('d M Y') }}</span>
                        <h4 class="text-lg font-bold text-slate-900 group-hover:text-emerald-600 transition leading-snug mb-3 line-clamp-2">
                            {{ $lain->judul }}
                        </h4>
                        <p class="text-sm text-slate-500 line-clamp-2 mt-auto">
                            {{ Str::limit(strip_tags($lain->konten), 90) }}
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.getElementById('trigger-lightbox');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCaption = document.getElementById('lightbox-caption');
        const lightboxContent = document.getElementById('lightbox-content');
        const closeBtn = document.getElementById('lightbox-close');

        // Buka Lightbox
        if (trigger) {
            trigger.addEventListener('click', () => {
                const img = trigger.querySelector('img');
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt;
                lightboxCaption.textContent = img.alt;
                
                lightbox.classList.remove('hidden');
                
                setTimeout(() => {
                    lightbox.classList.add('flex', 'opacity-100');
                    lightbox.classList.remove('opacity-0');
                    lightboxContent.classList.add('scale-100');
                    lightboxContent.classList.remove('scale-95');
                }, 10);
                
                document.body.classList.add('overflow-hidden');
            });
        }

        // Fungsi Tutup Lightbox
        function closeLightbox() {
            lightbox.classList.remove('opacity-100');
            lightbox.classList.add('opacity-0');
            lightboxContent.classList.remove('scale-100');
            
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                lightboxImg.src = '';
            }, 300);
        }

        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
        
        if (lightbox) {
            lightbox.addEventListener('click', (e) => { 
                if (e.target === lightbox) closeLightbox(); 
            });
        }
        
        document.addEventListener('keydown', (e) => { 
            if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) closeLightbox(); 
        });
    });
</script>
@endsection