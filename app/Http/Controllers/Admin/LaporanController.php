<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Tampilkan hanya laporan yang sudah diverifikasi, terbaru di atas
        $laporans = Laporan::where('is_verified', true)->latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        // Validasi input untuk keamanan
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan_admin' => 'required|string|max:1000',
        ]);

        $laporan->update([
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin
        ]);

        return back()->with('success', 'Status dan tanggapan laporan berhasil diperbarui!');
    }
}