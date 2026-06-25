<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Galeri Foto') }}
            </h2>
            <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow transition text-sm">
                + Unggah Foto Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl font-semibold text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100 p-6 md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($galeris as $galeri)
                    <div class="group bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/60 flex flex-col shadow-sm hover:shadow-md transition">
                        <div class="h-44 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 flex flex-col flex-1 justify-between gap-4">
                            <h4 class="font-bold text-slate-800 text-sm line-clamp-2 leading-snug">{{ $galeri->judul }}</h4>
                            
                            <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus foto ini dari album?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 text-xs bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold rounded-lg transition border border-red-100 hover:border-red-600">
                                    Hapus Foto
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-16 border-2 border-dashed border-slate-200 rounded-3xl">
                        <p class="text-slate-500 font-medium">Belum ada dokumentasi foto yang diunggah.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>