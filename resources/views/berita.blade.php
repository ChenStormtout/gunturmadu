@extends('layouts.frontend')
@section('title', 'Kabar Desa')
@section('content')
<section class="pt-32 pb-24 min-h-screen bg-slate-50 relative">
    <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/50 to-transparent z-0"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Pusat Informasi</span>
            <h1 class="text-5xl font-black text-slate-900 mt-3 drop-shadow-sm">Kabar & Jurnal Desa</h1>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($beritas as $item)
            <article class="group bg-white rounded-[30px] overflow-hidden border border-slate-100 shadow-lg hover:-translate-y-3 transition-all duration-500 flex flex-col">
                @if($item->gambar)
                    <div class="h-56 overflow-hidden"><img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500"></div>
                @else
                    <div class="h-56 bg-emerald-500 flex items-center justify-center"><span class="text-white font-bold">Berita Desa</span></div>
                @endif
                <div class="p-8 flex flex-col flex-1">
                    <span class="text-xs font-bold uppercase text-emerald-600">{{ $item->created_at->format('d M Y') }}</span>
                    <h3 class="mt-4 text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition">{{ $item->judul }}</h3>
                    <p class="mt-4 text-slate-500 line-clamp-3">{{ Str::limit(strip_tags($item->konten), 120) }}</p>
                    <div class="mt-auto pt-6"><a href="{{ route('berita.detail', $item->slug) }}" class="text-emerald-600 font-semibold hover:text-teal-700">Baca Selengkapnya →</a></div>
                </div>
            </article>
            @empty
            <div class="col-span-3 py-20 text-center"><p class="text-slate-500">Belum ada berita.</p></div>
            @endforelse
        </div>
        <div class="mt-12">{{ $beritas->links() }}</div>
    </div>
</section>
@endsection