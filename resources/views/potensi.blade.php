@extends('layouts.frontend')
@section('title', 'Potensi Desa')

@section('content')
<section class="pt-32 pb-24 min-h-screen bg-slate-50 relative">
    <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-amber-100/50 to-transparent z-0"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 animate-[fadeInUp_0.5s_ease-out]">
            <span class="text-amber-500 font-semibold uppercase tracking-widest text-sm">Keunggulan Lokal</span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mt-3 drop-shadow-sm tracking-tight">Etalase Potensi Desa</h1>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($potensis as $item)
            @php
                $imgData = explode('|', $item->gambar);
                $pathGambar = $imgData[0];
                $posisiFokus = $imgData[1] ?? 'object-center';
            @endphp
            
            <a href="{{ route('potensi.detail', $item->slug) }}" class="group bg-white rounded-[32px] overflow-hidden border border-slate-100 shadow-lg hover:-translate-y-3 hover:shadow-[0_25px_80px_rgba(245,158,11,0.15)] transition-all duration-500 flex flex-col animate-[fadeInUp_0.7s_ease-out]">
                
                @if($pathGambar)
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('storage/'.$pathGambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover {{ $posisiFokus }} group-hover:scale-110 transition duration-700 ease-out">
                    </div>
                @else
                    <div class="h-64 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                        <span class="text-4xl group-hover:scale-125 transition duration-500">🌟</span>
                    </div>
                @endif
                
                <div class="p-8 flex flex-col flex-1 relative">
                    <div class="absolute -top-6 right-8 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg text-amber-500 border border-slate-50 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-3">{{ $item->created_at->format('d M Y') }}</span>
                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-amber-500 transition leading-snug">{{ $item->judul }}</h3>
                    <p class="mt-4 text-slate-500 line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($item->deskripsi), 120) }}</p>
                    
                    <div class="mt-auto pt-8">
                        <div class="inline-flex items-center gap-2 text-amber-500 font-bold hover:text-amber-600 transition">
                            Lihat Detail Keunggulan
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 bg-white rounded-[32px] border border-dashed border-slate-200 py-24 text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-amber-50 rounded-full flex items-center justify-center shadow-sm text-amber-400">
                    <span class="text-3xl">🌾</span>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Etalase</h3>
                <p class="text-slate-500">Data potensi desa sedang dalam tahap pendataan.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-16 flex justify-center">
            {{ $potensis->links() }}
        </div>
    </div>
</section>

@section('scripts')
<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(25px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
@endsection