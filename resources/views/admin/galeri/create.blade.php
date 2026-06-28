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
                        <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Misal: Kerja Bakti Dusun Ngaglik" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm transition-colors">
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">File Gambar (Maks 5MB)</label>
                        
                        <div class="flex flex-col items-start gap-4 mb-4">
                            <div id="wrapper-preview" class="w-full h-56 md:h-64 rounded-2xl overflow-hidden border border-dashed border-slate-300 relative bg-slate-50 flex items-center justify-center transition-all duration-300 group">
                                
                                <img id="preview-gambar" src="" alt="Preview" class="hidden w-full h-full object-cover">
                                
                                <div id="placeholder-text" class="text-center p-6 flex flex-col items-center gap-2 transition-opacity">
                                    <svg class="w-10 h-10 text-slate-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold text-slate-500">Belum ada foto terpilih</p>
                                </div>

                                <div id="label-status" class="hidden absolute top-3 left-3 bg-emerald-500/90 backdrop-blur-md text-white text-xs font-semibold px-3 py-1.5 rounded-lg border border-emerald-400 shadow-sm animate-[fadeIn_0.2s_ease-out]">
                                    Preview Foto Baru
                                </div>
                            </div>
                        </div>

                        <input type="file" id="input-file" name="gambar" required accept="image/jpeg,image/png,image/jpg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer border border-slate-200 rounded-xl bg-slate-50">
                        
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100 mt-8">
                        <a href="{{ route('admin.galeri.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-6 rounded-xl transition-colors text-sm">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                            Unggah Album
                        </button>
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
            const labelStatus = document.getElementById('label-status');

            inputFile.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    const objectUrl = URL.createObjectURL(file);
                    
                    // Masukkan src, munculkan tag img, sembunyikan icon placeholder
                    previewGambar.src = objectUrl;
                    previewGambar.classList.remove('hidden');
                    placeholderText.classList.add('hidden');
                    labelStatus.classList.remove('hidden');

                    // Ubah border dashed (putus-putus) jadi solid karena sudah ada fotonya
                    wrapperPreview.classList.remove('border-dashed', 'border-slate-300', 'bg-slate-50');
                    wrapperPreview.classList.add('border-solid', 'border-slate-200', 'bg-white');

                    // Efek jolt animasi halus pas muncul gambar
                    previewGambar.classList.add('scale-102');
                    setTimeout(() => previewGambar.classList.remove('scale-102'), 250);
                } else {
                    // Jika user membatalkan pilihan file, reset ke tampilan semula
                    previewGambar.src = '';
                    previewGambar.classList.add('hidden');
                    placeholderText.classList.remove('hidden');
                    labelStatus.classList.add('hidden');

                    wrapperPreview.classList.remove('border-solid', 'border-slate-200', 'bg-white');
                    wrapperPreview.classList.add('border-dashed', 'border-slate-300', 'bg-slate-50');
                }
            });
        });
    </script>
</x-app-layout>