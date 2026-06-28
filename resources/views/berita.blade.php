@extends('layouts.frontend')
@section('title', 'Kabar Desa')

@section('content')
<section class="pt-32 pb-24 min-h-screen bg-slate-50 relative">
    <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/50 to-transparent z-0"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        
        <div class="text-center mb-16 animate-[fadeInUp_0.5s_ease-out]">
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Pusat Informasi</span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mt-3 drop-shadow-sm tracking-tight">Kabar & Jurnal Desa</h1>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($beritas as $item)
            @php
                // TRIK SAKTI: Pecah path gambar dan class fokus posisi yang dipilih dari admin
                $imgData = explode('|', $item->gambar);
                $pathGambar = $imgData[0];
                $posisiFokus = $imgData[1] ?? 'object-center'; // Default ke tengah jika format lama
            @endphp
            
            <article class="group bg-white rounded-[30px] overflow-hidden border border-slate-100 shadow-lg hover:-translate-y-3 hover:shadow-[0_25px_80px_rgba(16,185,129,0.15)] transition-all duration-500 flex flex-col animate-[fadeInUp_0.7s_ease-out]">
                
                @if($pathGambar)
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('storage/'.$pathGambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover {{ $posisiFokus }} group-hover:scale-110 transition duration-700 ease-out">
                    </div>
                @else
                    <div class="h-56 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white/70 group-hover:scale-110 transition duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                
                <div class="p-8 flex flex-col flex-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 mb-3">{{ $item->created_at->format('d M Y') }}</span>
                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition leading-snug">{{ $item->judul }}</h3>
                    <p class="mt-4 text-slate-500 line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($item->konten), 120) }}</p>
                    
                    <div class="mt-auto pt-8">
                        <a href="{{ route('berita.detail', $item->slug) }}" class="inline-flex items-center gap-2 text-emerald-600 font-bold hover:text-teal-700 transition">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 bg-white rounded-[32px] border border-dashed border-slate-200 py-24 text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-emerald-50 rounded-full flex items-center justify-center shadow-sm text-emerald-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 11-4 0m4 0a2 2 0 00-3-3.79M12 8h4m-4 4h4m-6 4h2"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Kabar</h3>
                <p class="text-slate-500">Belum ada berita atau jurnal yang dibagikan dari desa.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-16 flex justify-center">
            {{ $beritas->links() }}
        </div>
    </div>
</section>

@section('scripts')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@endsection