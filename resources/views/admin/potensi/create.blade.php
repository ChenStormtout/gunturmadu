<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Tambah Potensi Desa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)] relative">
        <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/40 to-transparent z-0 pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl shadow-slate-200/40 rounded-[32px] border border-white p-6 md:p-10">
                
                <form id="form-potensi" action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Potensi / Produk</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Misal: Kerajinan Anyaman Bambu Dusun X" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" rows="8" required placeholder="Ceritakan detail keunggulan, sejarah, atau cara pemesanan potensi ini..." class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm transition-colors">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Foto Potensi (Maks 5MB)</label>
                        <div class="flex flex-col items-start gap-4 mb-4">
                            <div id="wrapper-preview" class="w-full min-h-[224px] rounded-2xl overflow-hidden border border-dashed border-slate-300 relative bg-slate-50 flex items-center justify-center transition-all duration-300">
                                <img id="preview-gambar" src="" class="hidden w-full h-auto max-h-[450px] object-contain">
                                <div id="placeholder-text" class="text-center p-6 flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-xs font-semibold text-slate-500">Belum ada foto terpilih</p>
                                </div>
                            </div>
                        </div>
                        <input type="file" id="input-file" name="gambar" required accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 border border-slate-200 rounded-xl bg-slate-50 cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Fokus Tampilan Gambar Halaman Utama</label>
                        <select name="fokus_gambar" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            <option value="object-center">Tengah (Default Otomatis)</option>
                            <option value="object-top">Atas (Fokus area atas produk)</option>
                            <option value="object-bottom">Bawah (Fokus area bawah produk)</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100 mt-8">
                        <a href="{{ route('admin.potensi.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-6 rounded-xl text-sm">Batal</a>
                        <button type="submit" id="btn-simpan" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-emerald-500/30 text-sm">Simpan Potensi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('input-file');
            const previewGambar = document.getElementById('preview-gambar');
            const placeholderText = document.getElementById('placeholder-text');
            const wrapperPreview = document.getElementById('wrapper-preview');
            const btnSimpan = document.getElementById('btn-simpan');
            const formPotensi = document.getElementById('form-potensi');

            inputFile.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    previewGambar.src = URL.createObjectURL(file);
                    previewGambar.classList.remove('hidden');
                    placeholderText.classList.add('hidden');
                    wrapperPreview.classList.remove('border-dashed', 'border-slate-300', 'bg-slate-50');
                    wrapperPreview.classList.add('border-solid', 'border-slate-200', 'bg-slate-900/5');
                }
            });

            formPotensi.addEventListener('submit', function() {
                btnSimpan.innerHTML = 'Memproses...';
                btnSimpan.disabled = true;
            });
        });
    </script>
</x-app-layout>