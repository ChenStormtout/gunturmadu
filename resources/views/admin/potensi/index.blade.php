<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Kelola Potensi Desa') }}
            </h2>
            <a href="{{ route('admin.potensi.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-2xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Potensi Baru
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
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-bold text-slate-500 uppercase tracking-wider">Katalog Potensi</h3>
                    <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">Total: {{ $potensis->count() }} Data</span>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-100 bg-white">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-600 text-sm font-bold">
                                <th class="p-4 w-16 text-center">No</th>
                                <th class="p-4">Nama Potensi / Produk</th>
                                <th class="p-4 w-48">Tanggal Upload</th>
                                <th class="p-4 w-44 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-sm">
                            @forelse($potensis as $index => $item)
                            <tr class="hover:bg-slate-50/50 transition duration-150 group">
                                <td class="p-4 text-center text-slate-400 font-medium tabular-nums">{{ $index + 1 }}</td>
                                <td class="p-4">
                                    <span class="font-bold text-slate-800 group-hover:text-emerald-600 transition-colors block text-base leading-snug">
                                        {{ $item->judul }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold">
                                        📅 {{ $item->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.potensi.edit', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 hover:bg-amber-50 hover:text-amber-600 font-bold text-xs rounded-xl transition border border-slate-100 hover:border-amber-200 shadow-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.potensi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus potensi ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 hover:bg-rose-50 hover:text-rose-600 font-bold text-xs rounded-xl transition border border-slate-100 hover:border-rose-200 shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-0">
                                    <div class="flex flex-col items-center justify-center text-center py-20 px-6 bg-emerald-50/20">
                                        <div class="w-16 h-16 mb-4 bg-white rounded-full flex items-center justify-center shadow-sm text-emerald-300 text-3xl">🌱</div>
                                        <h4 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Potensi Desa</h4>
                                        <p class="text-slate-500 max-w-sm mx-auto text-xs font-medium">Klik tombol "Tambah Potensi Baru" di atas untuk mempromosikan keunggulan desa.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>