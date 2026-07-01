<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\ProfilDesa;
use App\Mail\VerifikasiLaporanMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LaporanWargaController extends Controller
{
    // Menampilkan halaman form lapor
    public function create()
    {
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();
        return view('laporan.create', compact('profil'));
    }

    // Proses simpan data & kirim email verifikasi
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor'  => 'required|string|max:255',
            'email_pelapor' => 'required|email|max:255',
            'kategori'      => 'required|string',
            'isi_laporan'   => 'required|string',
            'foto_lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $laporan = new Laporan();
        $laporan->kode_tiket = 'LPR-' . strtoupper(Str::random(6));
        $laporan->nama_pelapor = $request->nama_pelapor;
        $laporan->email_pelapor = $request->email_pelapor;
        $laporan->kategori = $request->kategori;
        $laporan->isi_laporan = $request->isi_laporan;
        $laporan->status = 'menunggu';
        $laporan->is_verified = false; 

        if ($request->hasFile('foto_lampiran')) {
            $laporan->foto_lampiran = $request->file('foto_lampiran')->store('lampiran-laporan', 'public');
        }

        $laporan->save();

        $urlVerifikasi = URL::temporarySignedRoute(
            'laporan.verify', now()->addMinutes(60), ['laporan' => $laporan->id]
        );

        Mail::to($laporan->email_pelapor)->send(new VerifikasiLaporanMail($laporan, $urlVerifikasi));

        return redirect()->back()->with('success', 'Laporan berhasil dibuat! Cek email Anda untuk verifikasi.');
    }

    // Proses ketika warga klik link dari email
    public function verify(Request $request, Laporan $laporan)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'Link verifikasi kedaluwarsa.');
        }

        $laporan->update(['is_verified' => true]);

        return redirect()->route('home')->with('success', 'Email berhasil diverifikasi! Tiket: '.$laporan->kode_tiket);
    }

    // Fitur Cek Status Laporan
    public function cekStatus(Request $request)
    {
        $laporan = null;
        $profil = ProfilDesa::pluck('nilai', 'kunci')->toArray();

        if ($request->has('kode_tiket')) {
            $laporan = Laporan::where('kode_tiket', $request->kode_tiket)->first();
        }

        return view('laporan.cek', compact('laporan', 'profil'));
    }
}