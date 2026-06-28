<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    @php
        // Pecah data gambar saat ini untuk mendapatkan posisi fokus yang tersimpan lama
        $imgData = explode('|', $berita->gambar);
        $pathGambar = $imgData[0];
        $currentPos = $imgData[1] ?? 'object-center';
    @endphp

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)] relative">
        <div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-emerald-100/40 to-transparent z-0 pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl shadow-slate-200/40 rounded-[32px] border border-white p-6 md:p-10">
                
                <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Judul Berita</label>
                        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Isi Berita</label>
                        <textarea name="konten" rows="8" required class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('konten', $berita->konten) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Ganti Gambar Sampul (Opsional)</label>
                        <div class="flex flex-col items-start gap-4 mb-4">
                            <div id="wrapper-preview" class="w-full min-h-[224px] rounded-2xl overflow-hidden border border-slate-200 relative bg-slate-900/5 flex items-center justify-center">
                                @if($pathGambar)
                                    <img id="preview-gambar" src="{{ asset('storage/' . $pathGambar) }}" class="w-full h-auto max-h-[450px] object-contain">
                                    <div id="label-status" class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-md text-white text-xs font-semibold px-3 py-1.5 rounded-lg border border-white/10">Sampul Saat Ini</div>
                                @else
                                    <img id="preview-gambar" src="" class="hidden w-full h-auto max-h-[450px] object-contain">
                                    <div id="placeholder-text" class="text-center p-6 text-slate-500">Tidak ada gambar sebelumnya</div>
                                @endif
                            </div>
                        </div>

                        <input type="file" id="input-file" name="gambar" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 border border-slate-200 rounded-xl bg-slate-50 cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Fokus Tampilan Gambar Halaman Utama</label>
                        <select name="fokus_gambar" class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            <option value="object-center" {{ $currentPos == 'object-center' ? 'selected' : '' }}>Tengah (Default Otomatis)</option>
                            <option value="object-top" {{ $currentPos == 'object-top' ? 'selected' : '' }}>Atas (Gunakan jika area wajah/kepala orang di bagian atas)</option>
                            <option value="object-bottom" {{ $currentPos == 'object-bottom' ? 'selected' : '' }}>Bawah (Gunakan jika objek penting di bagian bawah)</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100 mt-8">
                        <a href="{{ route('admin.berita.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-6 rounded-xl text-sm">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-emerald-500/30 text-sm">Simpan Perubahan</button>
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
            const placeholderText = document.getElementById('placeholder-text');

            inputFile.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    previewGambar.src = URL.createObjectURL(file);
                    previewGambar.classList.remove('hidden');
                    if (placeholderText) placeholderText.classList.add('hidden');
                    if (labelStatus) {
                        labelStatus.textContent = 'Preview Sampul Baru';
                        labelStatus.className = 'absolute top-3 left-3 bg-amber-500/90 backdrop-blur-md text-white text-xs font-semibold px-3 py-1.5 rounded-lg border border-amber-400';
                    }
                }
            });
        });
    </script>
</x-app-layout>