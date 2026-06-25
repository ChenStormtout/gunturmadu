<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Perangkat Aparatur') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100 p-6 md:p-8">
                
                <form action="{{ route('admin.aparatur.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap (Beserta Gelar)</label>
                        <input type="text" name="nama" required placeholder="Misal: Budi Santoso, S.Sos" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jabatan Struktur Desa</label>
                        <input type="text" name="custom_jabatan" id="custom_jabatan" placeholder="Misal: Kepala Dusun Ngaglik" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" oninput="document.getElementById('jabatan_select').value = this.value">
                        <select id="jabatan_select" class="mt-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" onchange="document.getElementById('custom_jabatan').value = this.value; document.getElementById('jabatan_hidden').value = this.value;">
                            <option value="">-- Atau Pilih Opsi Bawaan --</option>
                            <option value="Kepala Desa">Kepala Desa</option>
                            <option value="Sekretaris Desa">Sekretaris Desa</option>
                            <option value="Kaur Keuangan">Kaur Keuangan</option>
                            <option value="Kaur Perencanaan">Kaur Perencanaan</option>
                            <option value="Kaur Tata Usaha & Umum">Kaur Tata Usaha & Umum</option>
                            <option value="Kasi Pemerintahan">Kasi Pemerintahan</option>
                            <option value="Kasi Kesejahteraan">Kasi Kesejahteraan</option>
                            <option value="Kasi Pelayanan">Kasi Pelayanan</option>
                        </select>
                        <input type="hidden" name="jabatan" id="jabatan_hidden" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Foto Resmi Komunitas (Maks 2MB)</label>
                        <input type="file" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.aparatur.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-5 rounded-xl transition text-sm">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow transition text-sm" onclick="if(!document.getElementById('jabatan_hidden').value){ document.getElementById('jabatan_hidden').value = document.getElementById('custom_jabatan').value; }">Simpan Aparatur</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>