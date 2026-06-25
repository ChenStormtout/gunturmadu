@extends('layouts.frontend')

{{-- SEO & Meta Tags Dinamis --}}
@section('title', $berita->judul)
@section('meta_description', Str::limit(strip_tags($berita->konten), 150))
@if($berita->gambar)
    @section('og_image', asset('storage/'.$berita->gambar))
@endif

@section('content')

{{-- Spasi untuk fixed navbar --}}
<div class="pt-28 pb-16 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- BREADCRUMB --}}
        <nav class="flex text-sm text-slate-500 mb-8 font-medium">
            <a href="/" class="hover:text-emerald-600 transition">Beranda</a>
            <span class="mx-2">/</span>
            <a href="/berita" class="hover:text-emerald-600 transition">Berita</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 truncate max-w-[200px] sm:max-w-xs">{{ $berita->judul }}</span>
        </nav>

        {{-- HEADER BERITA --}}
        <header class="mb-10 animate-[fadeInUp_0.5s_ease-out]">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-widest mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $berita->created_at->translatedFormat('l, d F Y') }}
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-[1.15] tracking-tight mb-6">
                {{ $berita->judul }}
            </h1>
            
            {{-- Tombol Bagikan (Opsional) --}}
            <div class="flex items-center gap-3 border-y border-slate-200 py-4">
                <span class="text-sm font-semibold text-slate-500">Bagikan:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-colors" title="Bagikan ke WhatsApp">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Bagikan ke Facebook">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
            </div>
        </header>

        {{-- GAMBAR UTAMA BERITA --}}
        @if($berita->gambar)
            <div class="mb-12 rounded-[32px] overflow-hidden shadow-xl shadow-slate-200/50 relative group animate-[fadeInUp_0.7s_ease-out]">
                <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full max-h-[500px] object-cover hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
            </div>
        @endif

        {{-- ISI BERITA --}}
        <article class="prose prose-lg prose-slate max-w-none text-slate-700 leading-loose animate-[fadeInUp_0.9s_ease-out]">
            {{-- 
                Catatan: 
                Kalau di admin input beritanya pakai textarea biasa, gunakan: {!! nl2br(e($berita->konten)) !!}
                Tapi kalau pakai WYSIWYG editor (kayak CKEditor/Summernote), gunakan: {!! $berita->konten !!} 
            --}}
            <div class="whitespace-pre-line">
                {!! nl2br(e($berita->konten)) !!}
            </div>
        </article>

        {{-- TOMBOL KEMBALI --}}
        <div class="mt-16 border-t border-slate-200 pt-8">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : '/berita' }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-600 font-semibold hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Berita
            </a>
        </div>

    </div>
</div>

{{-- BERITA LAINNYA (Opsional, pastikan controller mengirim variabel $beritaLainnya) --}}
@if(isset($beritaLainnya) && $beritaLainnya->count() > 0)
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
            <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
            Baca Juga Berita Lainnya
        </h3>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($beritaLainnya as $lain)
            <a href="/berita/{{ $lain->slug }}" class="group block">
                <div class="bg-slate-50 rounded-[28px] overflow-hidden border border-slate-100 shadow-sm group-hover:shadow-xl group-hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                    
                    @if($lain->gambar)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/'.$lain->gambar) }}" alt="{{ $lain->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                    
                    <div class="p-6 flex flex-col flex-1">
                        <span class="text-xs font-bold text-emerald-600 mb-2">{{ $lain->created_at->format('d M Y') }}</span>
                        <h4 class="text-lg font-bold text-slate-800 group-hover:text-emerald-600 transition leading-snug mb-3">
                            {{ $lain->judul }}
                        </h4>
                        <p class="text-sm text-slate-500 line-clamp-2 mt-auto">
                            {{ Str::limit(strip_tags($lain->konten), 80) }}
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
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection