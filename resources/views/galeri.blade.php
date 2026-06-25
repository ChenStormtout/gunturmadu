@extends('layouts.frontend')

@section('title', 'Galeri Desa')

@section('content')
<section class="pt-32 pb-24 min-h-screen bg-slate-50 relative">
    <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/50 to-transparent z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 animate-[fadeInUp_1s_ease-out]">
            <span class="text-emerald-600 font-semibold uppercase tracking-widest text-sm">Jejak Visual</span>
            <h1 class="text-5xl font-black text-slate-900 mt-3 drop-shadow-sm">Galeri Desa</h1>
            <p class="mt-4 text-slate-500 text-lg">Merekam setiap momen, keindahan alam, dan kegiatan warga.</p>
        </div>

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
            @forelse($galeris as $item)
            <button type="button" class="gallery-item w-full break-inside-avoid group relative rounded-[24px] overflow-hidden text-left shadow-sm hover:shadow-xl transition-all duration-500" data-src="{{ asset('storage/'.$item->gambar) }}" data-title="{{ $item->judul }}">
                <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" class="w-full object-cover transform group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                    <h4 class="text-white font-bold text-lg leading-tight">{{ $item->judul }}</h4>
                </div>
            </button>
            @empty
            <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200 break-inside-avoid">
                <p class="text-slate-500">Belum ada foto di galeri saat ini.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $galeris->links() }}
        </div>
    </div>
</section>

<div id="lightbox" class="hidden fixed inset-0 z-[60] bg-slate-950/90 backdrop-blur-sm items-center justify-center p-6">
    <button id="lightbox-close" class="absolute top-6 right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
    <figure class="max-w-4xl w-full">
        <img id="lightbox-img" src="" alt="" class="w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl">
        <figcaption id="lightbox-caption" class="text-center text-white/80 mt-4 text-sm font-medium"></figcaption>
    </figure>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCaption = document.getElementById('lightbox-caption');

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', () => {
                lightboxImg.src = item.dataset.src;
                lightboxCaption.textContent = item.dataset.title;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            });
        });

        const closeLightbox = () => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            lightboxImg.src = '';
        };

        document.getElementById('lightbox-close').addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => { if (e.target === lightbox) closeLightbox(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeLightbox(); });
    });
</script>
<style>
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection