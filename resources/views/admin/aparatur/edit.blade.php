<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Aparatur') }}
        </h2>
    </x-slot>

    <!-- Tambahkan CSS Cropper.js langsung via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100 p-6 md:p-8">
                
                <!-- Beri ID form-aparatur untuk ditangkap oleh Javascript -->
                <form id="form-aparatur" action="{{ route('admin.aparatur.update', $aparatur->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                        <label class="block text-sm font-bold text-slate-700 mb-3">Foto Aparatur</label>
                        
                        <!-- Area Foto Saat Ini -->
                        <div id="area-foto-lama" class="flex flex-col items-start gap-4 mb-4">
                            <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-emerald-100 shadow-sm">
                                <img src="{{ $aparatur->foto ? asset('storage/' . $aparatur->foto) : 'https://ui-avatars.com/api/?name='.urlencode($aparatur->nama).'&background=10b981&color=fff' }}" alt="{{ $aparatur->nama }}" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full">Foto saat ini</span>
                        </div>

                        <!-- Input File -->
                        <input type="file" id="input-foto" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">

                        <!-- Area Cropper (Awalnya disembunyikan, akan muncul pas milih foto) -->
                        <div id="area-cropper" class="hidden mt-4">
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                                <p class="text-xs font-semibold text-slate-600 mb-3 text-center">Geser & sesuaikan posisi foto 📸</p>
                                <div class="w-full max-h-[350px] overflow-hidden rounded-xl">
                                    <img id="gambar-preview" src="" alt="Preview Gambar" class="max-w-full block">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.aparatur.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-5 rounded-xl transition text-sm">Batal</a>
                        
                        <!-- Tombol ubah jadi button biasa biar diproses JS dulu sebelum dikirim -->
                        <button type="button" id="btn-simpan" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2.5 px-5 rounded-xl shadow transition text-sm">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Tambahkan JS Cropper.js sebelum penutup tag -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFoto = document.getElementById('input-foto');
            const gambarPreview = document.getElementById('gambar-preview');
            const areaCropper = document.getElementById('area-cropper');
            const areaFotoLama = document.getElementById('area-foto-lama');
            const formAparatur = document.getElementById('form-aparatur');
            const btnSimpan = document.getElementById('btn-simpan');
            
            let cropper;

            // Saat user memilih foto baru
            inputFoto.addEventListener('change', function(e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const reader = new FileReader();
                    
                    reader.onload = function(event) {
                        // Tampilkan modal/area crop, sembunyikan foto lama
                        areaCropper.classList.remove('hidden');
                        areaFotoLama.classList.add('hidden');
                        gambarPreview.src = event.target.result;

                        // Hancurkan cropper lama jika user ganti gambar berkali-kali
                        if (cropper) {
                            cropper.destroy();
                        }

                        // Seting pengaturan Cropper seperti WhatsApp
                        cropper = new Cropper(gambarPreview, {
                            aspectRatio: 1, // Memaksa rasio kotak 1:1 (sempurna untuk foto profil bulat)
                            viewMode: 1,    // Membatasi crop box di dalam ukuran gambar
                            dragMode: 'move', // Mengubah mode default agar gambar yang digeser, bukan kotaknya
                            autoCropArea: 0.9,
                            guides: false,
                            center: true,
                            highlight: false,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                        });
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            // Saat tombol simpan ditekan
            btnSimpan.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Ubah teks tombol jadi loading biar elegan
                btnSimpan.innerHTML = 'Memproses...';
                btnSimpan.disabled = true;

                if (cropper) {
                    // Ambil hasil crop dengan ukuran maksimal 500x500 biar enteng
                    cropper.getCroppedCanvas({
                        width: 500,
                        height: 500,
                    }).toBlob(function(blob) {
                        
                        // Buat file image baru dari hasil crop
                        const file = new File([blob], 'foto_aparatur_cropped.jpg', { type: 'image/jpeg', lastModified: new Date().getTime() });
                        
                        // Trik sakti: Ganti isi input "file" dengan file baru yang udah di-crop
                        const container = new DataTransfer();
                        container.items.add(file);
                        inputFoto.files = container.files;

                        // Submit form ke controller
                        formAparatur.submit();
                    }, 'image/jpeg', 0.9); // 0.9 adalah kualitas kompresi (90%)
                } else {
                    // Kalau gak jadi pilih foto baru, langsung submit nama/jabatan aja
                    formAparatur.submit();
                }
            });
        });
    </script>
</x-app-layout>