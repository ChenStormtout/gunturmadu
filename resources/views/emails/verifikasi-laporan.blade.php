<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Laporan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; padding: 20px;">
    <div style="max-w: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; border-top: 4px solid #10b981;">
        <h2 style="color: #10b981; margin-top: 0;">Halo, {{ $laporan->nama_pelapor }}</h2>
        <p>Terima kasih telah berpartisipasi dalam membangun Desa Gunturmadu. Kami telah menerima draf laporan Anda dengan detail berikut:</p>
        
        <div style="background: #f1f5f9; padding: 15px; border-radius: 6px; margin: 20px 0;">
            <strong>Kode Tiket:</strong> {{ $laporan->kode_tiket }}<br>
            <strong>Kategori:</strong> {{ $laporan->kategori }}<br>
            <strong>Isi Laporan:</strong> {{ Str::limit($laporan->isi_laporan, 50) }}
        </div>

        <p>Agar laporan ini masuk ke meja kerja admin dan segera diproses, <strong>Anda wajib memverifikasi alamat email ini</strong> dengan mengklik tombol di bawah:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $urlVerifikasi }}" style="background-color: #10b981; color: white; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">Verifikasi Laporan Saya</a>
        </div>

        <p style="font-size: 12px; color: #64748b;">Tombol ini berisi tautan aman yang akan kedaluwarsa dalam 60 menit. Jika Anda tidak merasa membuat laporan ini, abaikan saja email ini.</p>
    </div>
</body>
</html>