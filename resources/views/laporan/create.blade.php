@extends('layouts.frontend')

@section('title', 'Lapor Warga')

@section('content')
<section class="relative pt-32 pb-20 overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute inset-0 bg-slate-50 -z-10"></div>
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-emerald-100/50 rounded-full blur-3xl"></div>

    <div class="max-w-3xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Pusat Layanan Lapor</h1>
            <p class="text-slate-500 mt-2">Sampaikan aspirasi atau cek status laporan Anda.</p>
        </div>

        <!-- TABS MODERN -->
        <div class="flex bg-slate-200/50 p-1.5 rounded-2xl mb-8 w-fit mx-auto border border-slate-200">
            <button id="btn-tab-lapor" onclick="switchTab('lapor')" 
                class="px-8 py-3 rounded-xl font-bold text-sm transition-all duration-300 bg-white shadow-sm text-emerald-700">
                ✍️ Buat Laporan
            </button>
            <button id="btn-tab-cek" onclick="switchTab('cek')" 
                class="px-8 py-3 rounded-xl font-bold text-sm transition-all duration-300 text-slate-600 hover:text-slate-900">
                🔍 Cek Status
            </button>
        </div>

        <!-- FORM LAPOR -->
        <div id="section-lapor" class="animate-in fade-in zoom-in duration-300">
            <div class="bg-white p-8 md:p-10 rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100">
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_pelapor" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border-0 focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email Aktif</label>
                            <input type="email" name="email_pelapor" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border-0 focus:ring-2 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kategori</label>
                        <select name="kategori" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-0 focus:ring-2 focus:ring-emerald-500">
                            <option>Infrastruktur</option>
                            <option>Kebersihan</option>
                            <option>Keamanan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Detail Laporan</label>
                        <textarea name="isi_laporan" required rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-0 focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Foto Lampiran (Opsional)</label>
                        <input type="file" name="foto_lampiran" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-0">
                    </div>
                    <button type="submit" class="w-full py-4 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20">Kirim Laporan Sekarang</button>
                </form>
            </div>
        </div>

        <!-- CEK STATUS -->
        <div id="section-cek" class="hidden animate-in fade-in zoom-in duration-300">
            <div class="bg-white p-8 md:p-10 rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100">
                <form action="{{ route('laporan.create') }}" method="GET" class="flex gap-3">
                    <input type="text" name="kode_tiket" value="{{ request('kode_tiket') }}" placeholder="Masukkan Kode Tiket (Contoh: LPR-XXXXXX)" required
                        class="flex-1 px-4 py-3 rounded-xl bg-slate-50 border-0 focus:ring-2 focus:ring-slate-800">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition">Cari</button>
                </form>

                @if(request()->has('kode_tiket'))
                    <div class="mt-8 pt-8 border-t border-slate-100">
                        @php $laporanCek = \App\Models\Laporan::where('kode_tiket', request('kode_tiket'))->first(); @endphp
                        @if($laporanCek)
                            <div class="space-y-6">
                                <!-- Status Card -->
                                <div class="flex justify-between items-center bg-slate-50 p-4 rounded-2xl">
                                    <span class="text-xs font-bold text-slate-500 uppercase">Status Saat Ini</span>
                                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase 
                                        {{ $laporanCek->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $laporanCek->status }}
                                    </span>
                                </div>
                                
                                <!-- Detail Laporan -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div><p class="text-slate-400 text-xs font-bold uppercase">Pelapor</p><p class="font-bold text-slate-800">{{ $laporanCek->nama_pelapor }}</p></div>
                                    <div><p class="text-slate-400 text-xs font-bold uppercase">Kategori</p><p class="font-bold text-slate-800">{{ $laporanCek->kategori }}</p></div>
                                </div>

                                <div>
                                    <p class="text-slate-400 text-xs font-bold uppercase mb-2">Isi Laporan Anda</p>
                                    <div class="p-4 bg-slate-100 text-slate-700 rounded-2xl border border-slate-200">
                                        {{ $laporanCek->isi_laporan }}
                                    </div>
                                </div>

                                <!-- Tanggapan -->
                                <div>
                                    <p class="text-slate-400 text-xs font-bold uppercase mb-2">Tanggapan Resmi Admin</p>
                                    <div class="p-4 bg-emerald-50 text-emerald-900 rounded-2xl border border-emerald-100">
                                        {{ $laporanCek->tanggapan_admin ?? 'Laporan sedang dalam antrean peninjauan petugas desa.' }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center text-red-500 font-bold py-6">Maaf, kode tiket tidak ditemukan.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    function switchTab(type) {
        const btnLapor = document.getElementById('btn-tab-lapor');
        const btnCek = document.getElementById('btn-tab-cek');
        const sectionLapor = document.getElementById('section-lapor');
        const sectionCek = document.getElementById('section-cek');

        if(type === 'lapor') {
            btnLapor.classList.add('bg-white', 'shadow-sm', 'text-emerald-700');
            btnLapor.classList.remove('text-slate-600');
            btnCek.classList.remove('bg-white', 'shadow-sm', 'text-emerald-700');
            btnCek.classList.add('text-slate-600');
            sectionLapor.classList.remove('hidden');
            sectionCek.classList.add('hidden');
        } else {
            btnCek.classList.add('bg-white', 'shadow-sm', 'text-emerald-700');
            btnCek.classList.remove('text-slate-600');
            btnLapor.classList.remove('bg-white', 'shadow-sm', 'text-emerald-700');
            btnLapor.classList.add('text-slate-600');
            sectionCek.classList.remove('hidden');
            sectionLapor.classList.add('hidden');
        }
    }

    // Auto-switch jika ada parameter pencarian
    document.addEventListener('DOMContentLoaded', () => {
        if (new URLSearchParams(window.location.search).has('kode_tiket')) {
            switchTab('cek');
        }
    });
</script>
@endsection