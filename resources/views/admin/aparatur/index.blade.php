<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Aparatur Desa') }}
            </h2>
            <a href="{{ route('admin.aparatur.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow transition text-sm">
                + Tambah Aparatur
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
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <th class="p-4">Foto</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Jabatan</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            @forelse($aparaturs as $aparatur)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-200 shadow-sm">
                                        <img src="{{ $aparatur->foto ? asset('storage/' . $aparatur->foto) : 'https://ui-avatars.com/api/?name='.urlencode($aparatur->nama).'&background=10b981&color=fff' }}" alt="{{ $aparatur->nama }}" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4 font-bold text-slate-800">{{ $aparatur->nama }}</td>
                                <td class="p-4 text-emerald-600 font-semibold">{{ $aparatur->jabatan }}</td>
                                <td class="p-4 flex items-center justify-center space-x-4 h-20">
                                    <a href="{{ route('admin.aparatur.edit', $aparatur->id) }}" class="text-yellow-500 hover:text-yellow-600 font-bold text-sm">Edit</a>
                                    <span class="text-slate-300">|</span>
                                    <form action="{{ route('admin.aparatur.destroy', $aparatur->id) }}" method="POST" onsubmit="return confirm('Hapus data aparatur ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 font-bold text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-slate-500 font-medium">Belum ada data aparatur desa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>