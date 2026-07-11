<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Pengaturan Profil & Statistik') }}
                </h2>
                <p class="text-xs font-medium text-slate-500 mt-1">Kelola data dasar dan demografi yang tampil di halaman utama warga</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-semibold text-sm shadow-sm flex items-center gap-2 animate-[fadeIn_0.5s_ease-out]">
                    <span>✅</span> <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Modal Peringatan Error -->
            <div id="error-banner" class="hidden mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl font-bold text-sm shadow-sm items-center gap-3">
                <span class="text-xl">⚠️</span>
                <span>Terdapat kesalahan jumlah data! Pastikan rincian demografi tidak melebihi Total Penduduk.</span>
            </div>

            <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-8" id="profilForm">
                @csrf
                @method('PUT')

                <!-- 1. WILAYAH ADMINISTRATIF -->
                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <span class="h-4 w-1 bg-blue-500 rounded-full"></span> 
                        Wilayah Administratif Desa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(['nama_desa'=>'Nama Desa', 'kecamatan'=>'Kecamatan', 'kabupaten'=>'Kabupaten', 'provinsi'=>'Provinsi'] as $key => $label)
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">{{ $label }}</label>
                                <input type="text" name="{{ $key }}" value="{{ $profil[$key] ?? '' }}" class="w-full rounded-xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm transition">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. STATISTIK KEPENDUDUKAN -->
                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-6 relative overflow-hidden">
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <span class="h-4 w-1 bg-emerald-500 rounded-full"></span> 
                        Statistik Kependudukan Dasar
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Laki-Laki</label>
                            <input type="number" name="penduduk_pria" id="pria" value="{{ $profil['penduduk_pria'] ?? 0 }}" class="w-full rounded-xl border-emerald-200 bg-emerald-50/50 text-sm focus:border-emerald-500 focus:ring-emerald-500 font-bold" oninput="validasiSemua()">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Perempuan</label>
                            <input type="number" name="penduduk_wanita" id="wanita" value="{{ $profil['penduduk_wanita'] ?? 0 }}" class="w-full rounded-xl border-pink-200 bg-pink-50/50 text-sm focus:border-pink-500 focus:ring-pink-500 font-bold" oninput="validasiSemua()">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-emerald-600 mb-2">TOTAL PENDUDUK</label>
                            <input type="number" name="total_penduduk" id="total" value="{{ $profil['total_penduduk'] ?? 0 }}" readonly class="w-full rounded-xl border-slate-200 bg-slate-100 text-slate-800 font-black cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <!-- 3. RINCIAN DEMOGRAFI LANJUTAN -->
                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-8">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <span class="h-4 w-1 bg-amber-500 rounded-full"></span> Rincian Demografi Lanjutan
                        </h3>
                    </div>

                    <!-- Groups (Agama, Pend, Kerja, Usia) -->
                    @php
                        $groups = [
                            'agama' => ['label' => 'Komposisi Agama', 'icon' => '🕌', 'items' => ['islam'=>'Islam', 'kristen'=>'Protestan', 'katolik'=>'Katolik', 'hindu'=>'Hindu', 'buddha'=>'Buddha', 'khonghucu'=>'Khonghucu']],
                            'pend' => ['label' => 'Pendidikan', 'icon' => '🎓', 'items' => ['tidak_sekolah'=>'Blm Sekolah', 'sd'=>'SD', 'smp'=>'SMP', 'sma'=>'SMA/K', 'tinggi'=>'Sarjana']],
                            'pekerjaan' => ['label' => 'Pekerjaan Utama', 'icon' => '💼', 'items' => ['petani'=>'Petani', 'pedagang'=>'Pedagang', 'swasta'=>'Swasta', 'pns'=>'PNS/TNI']],
                            'usia' => ['label' => 'Kelompok Usia', 'icon' => '⏳', 'items' => ['balita'=>'0-4 Thn', 'anak'=>'5-14 Thn', 'remaja'=>'15-24 Thn', 'dewasa'=>'25-54 Thn', 'lansia'=>'55+ Thn']]
                        ];
                    @endphp

                    @foreach($groups as $gKey => $g)
                    <div class="p-5 rounded-2xl border border-slate-100 bg-slate-50/50">
                        <div class="flex justify-between items-end mb-4 border-b border-slate-200 pb-3">
                            <h4 class="text-sm font-bold text-slate-700 uppercase tracking-widest">{{ $g['icon'] }} {{ $g['label'] }}</h4>
                            <div id="status-{{ $gKey }}" class="text-xs font-bold px-3 py-1 rounded-full bg-slate-200 text-slate-600">0 / 0</div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($g['items'] as $iKey => $iLabel)
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">{{ $iLabel }}</label>
                                <input type="number" name="{{ $gKey }}_{{ $iKey }}" value="{{ $profil[$gKey.'_'.$iKey] ?? 0 }}" class="val-{{ $gKey }} w-full rounded-xl border-slate-200 text-sm focus:ring-blue-500" oninput="validasiSemua()">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- 4. KONTAK & SOSIAL MEDIA -->
                <div class="bg-white p-6 md:p-8 rounded-[28px] border border-slate-100 shadow-sm space-y-6">
                    <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                        <span class="h-4 w-1 bg-cyan-500 rounded-full"></span> 
                        Kontak & Sosial Media Desa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(['telepon_desa'=>'Telepon/WhatsApp', 'email_desa'=>'Email Desa', 'instagram'=>'Instagram', 'facebook'=>'Facebook'] as $key => $label)
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">{{ $label }}</label>
                            <input type="text" name="{{ $key }}" value="{{ $profil[$key] ?? '' }}" class="w-full rounded-xl border-slate-200 text-sm focus:border-cyan-500 focus:ring-cyan-500 shadow-sm transition">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end pt-2 sticky bottom-6 z-50">
                    <button type="submit" id="btn-submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-10 rounded-2xl shadow-xl transition-all duration-300 text-sm">
                        💾 Simpan Semua Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function validasiSemua() {
        const total = parseInt(document.getElementById('total').value) || 0;
        const groups = ['agama', 'pend', 'pekerjaan', 'usia'];
        let hasError = false;

        groups.forEach(gKey => {
            let sum = 0;
            document.querySelectorAll('.val-' + gKey).forEach(el => sum += parseInt(el.value) || 0);
            const statusEl = document.getElementById('status-' + gKey);
            statusEl.textContent = `${sum} / ${total}`;
            
            if (sum > total) {
                statusEl.className = "text-xs font-bold px-3 py-1 rounded-full bg-rose-100 text-rose-700 animate-pulse";
                hasError = true;
            } else if (sum === total) {
                statusEl.className = "text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-700";
            } else {
                statusEl.className = "text-xs font-bold px-3 py-1 rounded-full bg-amber-100 text-amber-700";
            }
        });

        const btn = document.getElementById('btn-submit');
        const banner = document.getElementById('error-banner');
        if(hasError) {
            btn.disabled = true; btn.style.opacity = '0.5'; banner.classList.remove('hidden'); banner.classList.add('flex');
        } else {
            btn.disabled = false; btn.style.opacity = '1'; banner.classList.add('hidden'); banner.classList.remove('flex');
        }
    }

    function hitungTotal() {
        const pria = parseInt(document.getElementById('pria').value) || 0;
        const wanita = parseInt(document.getElementById('wanita').value) || 0;
        document.getElementById('total').value = pria + wanita;
        validasiSemua();
    }
    document.addEventListener('DOMContentLoaded', validasiSemua);
</script>