@extends('layouts.frontend')
@section('title', $potensi->judul)

@section('content')

@php
    $imgData = explode('|', $potensi->gambar);
    $pathGambar = $imgData[0];
@endphp

<div class="pt-28 pb-20 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        <nav class="flex text-sm text-slate-500 mb-8 font-medium">
            <a href="/" class="hover:text-emerald-600 transition">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('potensi.index') }}" class="hover:text-emerald-600 transition">Potensi Desa</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 truncate max-w-[150px] sm:max-w-xs font-semibold">{{ $potensi->judul }}</span>
        </nav>

        <header class="mb-10 animate-[fadeInUp_0.5s_ease-out]">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 text-amber-600 text-xs font-bold uppercase tracking-widest mb-4 border border-amber-100">
                💎 Keunggulan Lokal
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-[1.15] tracking-tight mb-6">
                {{ $potensi->judul }}
            </h1>
        </header>

        @if($pathGambar)
            <div id="trigger-lightbox" class="mb-12 rounded-[32px] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.03)] relative group animate-[fadeInUp_0.7s_ease-out] cursor-zoom-in bg-slate-900/[0.02] flex justify-center items-center border border-slate-100/80">
                <img src="{{ asset('storage/'.$pathGambar) }}" alt="{{ $potensi->judul }}" class="w-full h-auto max-h-[600px] object-contain transform group-hover:scale-[1.01] transition duration-700 ease-out">
                
                <div class="absolute inset-0 bg-slate-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <div class="bg-white/90 backdrop-blur-sm text-emerald-600 p-4 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            </div>
        @endif

        <article class="text-slate-700 leading-relaxed text-base sm:text-lg space-y-6 animate-[fadeInUp_0.9s_ease-out]">
            <div class="whitespace-pre-line font-normal tracking-wide">
                {!! nl2br(e($potensi->deskripsi)) !!}
            </div>
        </article>

        <div class="mt-16 border-t border-slate-200/80 pt-8 flex">
            <a href="{{ route('potensi.index') }}" class="inline-flex items-center gap-2.5 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold text-sm hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Katalog Potensi
            </a>
        </div>
    </div>
</div>

{{-- REKOMENDASI POTENSI LAINNYA --}}
@if(isset($potensiLainnya) && $potensiLainnya->count() > 0)
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center gap-3 tracking-tight">
            <span class="w-2 h-6 bg-amber-500 rounded-full"></span>
            Lihat Keunggulan Lainnya
        </h3>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($potensiLainnya as $lain)
            @php
                $lainImgData = explode('|', $lain->gambar);
                $lainPathGambar = $lainImgData[0];
                $lainPosisiFokus = $lainImgData[1] ?? 'object-center';
            @endphp
            <a href="{{ route('potensi.detail', $lain->slug) }}" class="group block flex flex-col h-full bg-slate-50/50 rounded-[30px] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                @if($lainPathGambar)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/'.$lainPathGambar) }}" alt="{{ $lain->judul }}" class="w-full h-full object-cover {{ $lainPosisiFokus }} group-hover:scale-110 transition duration-500">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                        <span class="text-4xl">🌟</span>
                    </div>
                @endif
                
                <div class="p-6 flex flex-col flex-1">
                    <h4 class="text-lg font-bold text-slate-900 group-hover:text-amber-500 transition leading-snug mb-3 line-clamp-2">
                        {{ $lain->judul }}
                    </h4>
                    <p class="text-sm text-slate-500 line-clamp-2 mt-auto">
                        {{ Str::limit(strip_tags($lain->deskripsi), 90) }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- LIGHTBOX --}}
<div id="lightbox" class="hidden fixed inset-0 z-[100] bg-slate-950/95 backdrop-blur-md items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
    <button id="lightbox-close" class="absolute top-4 right-4 sm:top-6 sm:right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-rose-500 hover:text-white text-white/70 flex items-center justify-center transition duration-300 z-10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
    <figure id="lightbox-content" class="max-w-6xl w-full flex flex-col items-center transform scale-95 transition-transform duration-300">
        <img id="lightbox-img" src="" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
        <figcaption id="lightbox-caption" class="text-center text-white/90 mt-5 text-sm sm:text-base font-medium tracking-wide"></figcaption>
    </figure>
</div>

@endsection

@section('scripts')
<style> @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } } </style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.getElementById('trigger-lightbox');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxContent = document.getElementById('lightbox-content');
        
        if (trigger) {
            trigger.addEventListener('click', () => {
                lightboxImg.src = trigger.querySelector('img').src;
                lightbox.classList.remove('hidden');
                setTimeout(() => { lightbox.classList.add('flex', 'opacity-100'); lightbox.classList.remove('opacity-0'); lightboxContent.classList.add('scale-100'); lightboxContent.classList.remove('scale-95'); }, 10);
                document.body.classList.add('overflow-hidden');
            });
        }
        function closeLightbox() {
            lightbox.classList.remove('opacity-100'); lightbox.classList.add('opacity-0'); lightboxContent.classList.remove('scale-100');
            setTimeout(() => { lightbox.classList.add('hidden'); lightbox.classList.remove('flex'); document.body.classList.remove('overflow-hidden'); }, 300);
        }
        document.getElementById('lightbox-close').addEventListener('click', closeLightbox);
        if (lightbox) lightbox.addEventListener('click', (e) => { if (e.target === lightbox) closeLightbox(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeLightbox(); });
    });
</script>
@endsection