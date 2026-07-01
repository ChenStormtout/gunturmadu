<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 tracking-tight">Kelola Laporan Warga</h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-100">
                <div class="p-6 md:p-8 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Daftar Laporan Masuk</h3>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $laporans->count() }} Data</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <th class="p-6">Tiket</th>
                                <th class="p-6">Pelapor</th>
                                <th class="p-6">Lampiran</th> {{-- Kolom Baru --}}
                                <th class="p-6">Status</th>
                                <th class="p-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            @forelse($laporans as $l)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-6 font-black text-slate-900">{{ $l->kode_tiket }}</td>
                                <td class="p-6">
                                    <div class="font-bold">{{ $l->nama_pelapor }}</div>
                                    <div class="text-xs text-slate-400">{{ $l->kategori }}</div>
                                </td>
                                <td class="p-6">
                                    @if($l->foto_lampiran)
                                        <a href="{{ asset('storage/'.$l->foto_lampiran) }}" target="_blank" 
                                           class="inline-block px-3 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-600 hover:text-emerald-700 rounded-lg text-[10px] font-bold transition">
                                            Lihat Foto
                                        </a>
                                    @else
                                        <span class="text-[10px] text-slate-300 italic">Tanpa lampiran</span>
                                    @endif
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                        {{ $l->status == 'selesai' ? 'bg-emerald-100 text-emerald-700' : 
                                           ($l->status == 'diproses' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700') }}">
                                        {{ $l->status }}
                                    </span>
                                </td>
                                <td class="p-6 text-center">
                                    <button type="button" 
                                            class="btn-tanggapi inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-lg shadow-slate-900/10"
                                            data-id="{{ $l->id }}"
                                            data-tanggapan="{{ $l->tanggapan_admin }}"
                                            data-status="{{ $l->status }}">
                                        Tanggapi
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-slate-400 font-medium">Belum ada laporan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tanggapan --}}
    <div id="modal-tanggapan" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="tutupModal()"></div>
        <div class="relative bg-white rounded-[32px] p-8 w-full max-w-md shadow-2xl">
            <h3 class="text-xl font-black text-slate-800 mb-6">Tanggapi Laporan</h3>
            <form id="form-tanggapan" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Ubah Status</label>
                        <select name="status" id="status-select" class="w-full bg-slate-50 border-0 rounded-xl p-3 text-sm focus:ring-2 focus:ring-emerald-500">
                            <option value="menunggu">Menunggu</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Isi Tanggapan</label>
                        <textarea name="tanggapan_admin" id="tanggapan_admin" rows="4" required class="w-full bg-slate-50 border-0 rounded-xl p-3 text-sm focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                </div>
                <div class="flex gap-3 mt-8">
                    <button type="button" onclick="tutupModal()" class="flex-1 px-4 py-3 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-lg transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal-tanggapan');
            const form = document.getElementById('form-tanggapan');
            
            document.querySelectorAll('.btn-tanggapi').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const tanggapan = this.getAttribute('data-tanggapan');
                    const status = this.getAttribute('data-status');
                    
                    form.action = "{{ url('admin/laporan') }}/" + id;
                    document.getElementById('tanggapan_admin').value = (tanggapan === 'null') ? '' : tanggapan;
                    document.getElementById('status-select').value = status;
                    
                    modal.classList.remove('hidden');
                });
            });
        });

        function tutupModal() { 
            document.getElementById('modal-tanggapan').classList.add('hidden'); 
        }
    </script>
</x-app-layout>