<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Aparatur') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100 p-6 md:p-8">
                
                <form action="{{ route('admin.aparatur.update', $aparatur->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ $aparatur->nama }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jabatan Struktur Desa</label>
                        <input type="text" name="jabatan" value="{{ $aparatur->jabatan }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 mb-3">Foto Saat Ini</label>
                        <div class="w-24 h-24 rounded-full overflow-hidden border border-slate-200 shadow-sm mb-4">
                            <img src="{{ $aparatur->foto ? asset('storage/' . $aparatur->foto) : 'https://ui-avatars.com/api/?name='.urlencode($aparatur->nama).'&background=10b981&color=fff' }}" alt="{{ $aparatur->nama }}" class="w-full h-full object-cover">
                        </div>
                        <input type="file" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.aparatur.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-5 rounded-xl transition text-sm">Batal</a>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2.5 px-5 rounded-xl shadow transition text-sm">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>