<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Pengaturan Profil & Statistik') }}
                </h2>
                <p class="text-xs font-medium text-slate-500 mt-1">Kelola data dasar yang tampil di halaman utama warga</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-semibold text-sm shadow-sm flex items-center gap-2 animate-[fadeIn_0.5s_ease-out]">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <span class="h-4 w-1 bg-blue-500 rounded-full"></span> 
                        Wilayah Administratif Desa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Nama Desa</label>
                            <input type="text" name="nama_desa" value="{{ $profil['nama_desa'] ?? '' }}" placeholder="Contoh: Gunturmadu" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Kecamatan</label>
                            <input type="text" name="kecamatan" value="{{ $profil['kecamatan'] ?? '' }}" placeholder="Contoh: Kedaton" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Kabupaten / Kota</label>
                            <input type="text" name="kabupaten" value="{{ $profil['kabupaten'] ?? '' }}" placeholder="Contoh: Lampung Selatan" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Provinsi</label>
                            <input type="text" name="provinsi" value="{{ $profil['provinsi'] ?? '' }}" placeholder="Contoh: Lampung" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <span class="h-4 w-1 bg-emerald-500 rounded-full"></span> 
                        Statistik Kependudukan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Jumlah Penduduk Laki-Laki</label>
                            <input type="number" name="penduduk_pria" id="pria" value="{{ $profil['penduduk_pria'] ?? 0 }}" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition" oninput="hitungTotal()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Jumlah Penduduk Perempuan</label>
                            <input type="number" name="penduduk_wanita" id="wanita" value="{{ $profil['penduduk_wanita'] ?? 0 }}" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition" oninput="hitungTotal()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Total Penduduk (Otomatis)</label>
                            <input type="number" name="total_penduduk" id="total" value="{{ $profil['total_penduduk'] ?? 0 }}" readonly class="w-full rounded-xl border-gray-200 bg-slate-50 text-slate-500 font-bold text-sm focus:outline-none cursor-not-allowed shadow-sm">
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium">💡 Sistem akan menjumlahkan otomatis angka di atas saat Anda mengetik, serta menyimpannya langsung ke database untuk grafik di halaman utama.</p>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <span class="h-4 w-1 bg-cyan-500 rounded-full"></span> 

                        Kontak & Sosial Media Desa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="telepon_desa" value="{{ $profil['telepon_desa'] ?? '' }}" placeholder="Contoh: 081234567890" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Email Desa</label>
                            <input type="email" name="email_desa" value="{{ $profil['email_desa'] ?? '' }}" placeholder="Contoh: pemdes@gunturmadu.desa.id" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Link Instagram</label>
                            <input type="url" name="instagram" value="{{ $profil['instagram'] ?? '' }}" placeholder="https://instagram.com/akun_desa" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Link Facebook</label>
                            <input type="url" name="facebook" value="{{ $profil['facebook'] ?? '' }}" placeholder="https://facebook.com/page_desa" class="w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">📞 Informasi ini krusial agar warga atau pihak luar bisa langsung menghubungi pihak perangkat desa secara digital.</p>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 text-sm">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

<script>
    function hitungTotal() {
        const pria = parseInt(document.getElementById('pria').value) || 0;
        const wanita = parseInt(document.getElementById('wanita').value) || 0;
        document.getElementById('total').value = pria + wanita;
    }
</script>