<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Foto Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100 p-6 md:p-8">
                
                <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Judul Foto</label>
                        <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm transition-colors">
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Ganti Foto (Opsional)</label>
                        
                        <div class="flex flex-col items-start gap-4 mb-4">
                            <div class="w-full h-56 md:h-64 rounded-2xl overflow-hidden border border-slate-200 shadow-inner relative group bg-slate-100 transition-all duration-300">
                                <img id="preview-gambar" src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover transition-transform duration-500">
                                
                                <div id="label-status" class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-md text-white text-xs font-semibold px-3 py-1.5 rounded-lg border border-white/10 transition-colors">
                                    Foto Saat Ini
                                </div>
                            </div>
                        </div>

                        <input type="file" id="input-file" name="gambar" accept="image/jpeg,image/png,image/jpg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer border border-slate-200 rounded-xl bg-slate-50">
                        <p class="text-xs text-slate-500 mt-2 font-medium">Biarkan kosong jika tidak ingin mengganti foto. Maksimal ukuran foto 5MB.</p>
                        
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100 mt-8">
                        <a href="{{ route('admin.galeri.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-6 rounded-xl transition-colors text-sm">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300 text-sm">
                            Simpan Perubahan
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
            const labelStatus = document.getElementById('label-status');

            // Menyimpan URL gambar asli (kalau user batal milih foto, bisa dikembalikan)
            const gambarAsli = previewGambar.src;

            inputFile.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    // Membuat URL sementara dari file lokal yang dipilih
                    const objectUrl = URL.createObjectURL(file);
                    
                    // Mengganti src gambar dengan gambar yang baru dipilih
                    previewGambar.src = objectUrl;
                    
                    // Mengubah label dan warnanya jadi agak kuning/oranye menandakan ada perubahan
                    labelStatus.textContent = 'Preview Foto Baru';
                    labelStatus.classList.remove('bg-slate-900/70', 'border-white/10');
                    labelStatus.classList.add('bg-amber-500/90', 'border-amber-400');
                    
                    // Sedikit animasi zoom-in pas gambar berubah
                    previewGambar.classList.add('scale-105');
                    setTimeout(() => previewGambar.classList.remove('scale-105'), 300);

                } else {
                    // Jika user klik 'Cancel' saat milih file, kembalikan ke foto asli
                    previewGambar.src = gambarAsli;
                    labelStatus.textContent = 'Foto Saat Ini';
                    labelStatus.classList.remove('bg-amber-500/90', 'border-amber-400');
                    labelStatus.classList.add('bg-slate-900/70', 'border-white/10');
                }
            });
        });
    </script>
</x-app-layout>