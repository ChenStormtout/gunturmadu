@extends('layouts.frontend')

@section('title', 'Cek Status Laporan')

@section('content')
<section class="pt-32 pb-20 min-h-screen bg-slate-50">
    <div class="max-w-2xl mx-auto px-6">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Pantau Laporan Anda</h1>
            <p class="text-slate-500 mt-3">Masukkan kode tiket untuk melihat status terkini laporan Anda.</p>
        </div>

        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-xl shadow-slate-200/50 mb-10">
            <form action="{{ route('laporan.cek') }}" method="GET" class="flex flex-col gap-4">
                <input type="text" name="kode_tiket" value="{{ request('kode_tiket') }}" 
                       placeholder="Contoh: LPR-ABCDEF" required
                       class="w-full px-6 py-4 rounded-2xl border-slate-200 bg-slate-50 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition">
                <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20">
                    Cek Status
                </button>
            </form>
        </div>

        @if(request()->has('kode_tiket'))
            @if($laporan)
                <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm animate-[fadeInUp_0.5s_ease-out]">
                    <div class="flex justify-between items-center mb-6 pb-6 border-b border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Status Laporan</span>
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase 
                            {{ $laporan->status == 'selesai' ? 'bg-green-100 text-green-700' : 
                               ($laporan->status == 'diproses' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Isi Laporan Anda:</p>
                            <p class="text-slate-700 leading-relaxed">{{ $laporan->isi_laporan }}</p>
                        </div>
                        <div class="bg-slate-50 p-6 rounded-2xl">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-2">Tanggapan Resmi Admin:</p>
                            <p class="text-slate-800 font-medium">
                                {{ $laporan->tanggapan_admin ?? 'Laporan Anda sedang menunggu antrean peninjauan oleh petugas desa.' }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-8 bg-rose-50 border border-rose-100 rounded-3xl text-center text-rose-600 font-bold">
                    Kode tiket tidak ditemukan. Mohon cek kembali kode Anda.
                </div>
            @endif
        @endif

    </div>
</section>
@endsection