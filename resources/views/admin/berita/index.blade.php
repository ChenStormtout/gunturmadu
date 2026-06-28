<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Kelola Berita Desa') }}
            </h2>
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-2xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tulis Berita Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)] relative">
        <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/40 to-transparent z-0 pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-white/80 backdrop-blur-md border-l-4 border-emerald-500 text-emerald-700 rounded-2xl shadow-sm font-semibold text-sm animate-[fadeInUp_0.3s_ease-out] flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl shadow-slate-200/40 rounded-[32px] border border-white p-6 md:p-8">
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-bold text-slate-500 uppercase tracking-wider">Daftar Jurnal & Kabar</h3>
                    <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">Total: {{ $beritas->count() }} Artikel</span>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-100 bg-white">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-600 text-sm font-bold">
                                <th class="p-4 w-16 text-center">No</th>
                                <th class="p-4">Judul Artikel Berita</th>
                                <th class="p-4 w-48">Tanggal Rilis</th>
                                <th class="p-4 w-44 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-sm">
                            @forelse($beritas as $index => $berita)
                            <tr class="hover:bg-slate-50/50 transition duration-150 group">
                                <td class="p-4 text-center text-slate-400 font-medium tabular-nums">
                                    {{ $index + 1 }}
                                </td>
                                <td class="p-4">
                                    <span class="font-bold text-slate-800 group-hover:text-emerald-600 transition-colors block text-base leading-snug">
                                        {{ $berita->judul }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold">
                                        📅 {{ $berita->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 hover:bg-amber-50 hover:text-amber-600 font-bold text-xs rounded-xl transition border border-slate-100 hover:border-amber-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus berita ini secara permanen?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-600 hover:bg-rose-50 hover:text-rose-600 font-bold text-xs rounded-xl transition border border-slate-100 hover:border-rose-200 shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
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
                                        <div class="w-16 h-16 mb-4 bg-white rounded-full flex items-center justify-center shadow-sm text-emerald-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 11-4 0m4 0a2 2 0 00-3-3.79M12 8h4m-4 4h4m-6 4h2"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Berita</h4>
                                        <p class="text-slate-500 max-w-sm mx-auto text-xs font-medium">Klik tombol "Tulis Berita Baru" di atas untuk menyiarkan kabar pertama desa.</p>
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

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>