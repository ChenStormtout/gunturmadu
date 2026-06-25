<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unggah Foto Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100 p-6 md:p-8">
                
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Judul / Keterangan Foto</label>
                        <input type="text" name="judul" required placeholder="Misal: Kerja Bakti Dusun Ngaglik" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">File Gambar (Maks 2MB)</label>
                        <input type="file" name="gambar" required accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.galeri.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-5 rounded-xl transition text-sm">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow transition text-sm">Unggah Album</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>