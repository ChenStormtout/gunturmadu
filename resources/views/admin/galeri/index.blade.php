<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Album Galeri Desa') }}
            </h2>
            <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-2xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Unggah Foto Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)] relative">
        <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/40 to-transparent z-0 pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-white/80 backdrop-blur-md border-l-4 border-emerald-500 text-emerald-700 rounded-2xl shadow-sm font-semibold text-sm animate-[fadeInUp_0.3s_ease-out] flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl shadow-slate-200/40 rounded-[32px] border border-white p-6 md:p-8">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @forelse($galeris as $galeri)
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-100 flex flex-col shadow-sm hover:shadow-2xl hover:shadow-emerald-500/10 hover:-translate-y-2 transition-all duration-500">
                        
                        <div class="h-48 overflow-hidden relative bg-slate-100">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-1 justify-between gap-5 bg-white relative z-10">
                            <div>
                                <h4 class="font-bold text-slate-800 text-base line-clamp-2 leading-snug group-hover:text-emerald-600 transition-colors">{{ $galeri->judul }}</h4>
                                <p class="text-xs text-slate-400 mt-2 font-medium">{{ $galeri->created_at->format('d M Y') }}</p>
                            </div>
                            
                            <div class="flex gap-3 mt-auto pt-4 border-t border-slate-50">
                                <a href="{{ route('admin.galeri.edit', $galeri->id) }}" 
                                   class="flex-1 flex items-center justify-center gap-1.5 py-2.5 text-xs bg-slate-50 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 font-bold rounded-xl transition-all border border-slate-100 hover:border-emerald-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus foto ini dari album?');" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 py-2.5 text-xs bg-slate-50 text-slate-600 hover:bg-rose-50 hover:text-rose-600 font-bold rounded-xl transition-all border border-slate-100 hover:border-rose-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full flex flex-col items-center justify-center text-center py-24 px-6 border-2 border-dashed border-emerald-100 bg-emerald-50/30 rounded-[32px]">
                        <div class="w-20 h-20 mb-6 bg-white rounded-full flex items-center justify-center shadow-sm text-emerald-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-700 mb-2">Album Masih Kosong</h3>
                        <p class="text-slate-500 max-w-sm mx-auto">Mulai abadikan momen indah desa dengan mengunggah foto pertama ke dalam galeri.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>