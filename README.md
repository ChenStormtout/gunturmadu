# 🌿 SIPERDES GUNTURMADU
> Platform Digitalisasi Desa & Sistem Pengaduan Warga Berbasis Validasi Email Terenkripsi

[![Laravel](https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-%E2%89%A58.2-777BB4?style=flat-square&logo=php)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-v3.x-38B2AC?style=flat-square&logo=tailwind-css)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-v3.x-8BC0D0?style=flat-square&logo=alpine.js)](https://alpinejs.dev)

---

## 📐 Arsitektur Antarmuka & Layout Sistem

```text
┌──────────────────────────────────────────────────────────────────────────────────┐
│                         PORTAL PUBLIK DESA GUNTURMADU                            │
├──────────────────────────────────────────────────────────────────────────────────┤
│ [Hero & Live Weather] -> [Statistik Demografi (Chart.js)] -> [WebGIS Interaktif] │
│ [Etalase Potensi UMKM] -> [Galeri & Lightbox]          -> [Jurnal & Kabar Desa]  │
└────────────────────────────────────────┬─────────────────────────────────────────┘
                                         │
                         Form Pengaduan (Tanpa Login)
                                         │
                                         ▼
┌──────────────────────────────────────────────────────────────────────────────────┐
│                         SISTEM VERIFIKASI DUA ARAH                               │
├──────────────────────────────────────────────────────────────────────────────────┤
│ Pelapor Input Data ──> Kirim Temporary Signed URL ──> Verifikasi Email (60 Min)  │
└────────────────────────────────────────┬─────────────────────────────────────────┘
                                         │
                                   Status Valid
                                         │
                                         ▼
┌──────────────────────────────────────────────────────────────────────────────────┐
│                           PANEL CONTROL ADMIN DESA                               │
├──────────────────────────────────────────────────────────────────────────────────┤
│ [Dashboard Monitoring] ──> [Manajemen Laporan]  ──> [Modul Presisi Media]      │
│ (Aparatur, Berita,     │ (Menunggu / Diproses / │ (Cropper.js 1:1, Auto-Compress │
│  Galeri, Demografi)    │  Selesai / Ditolak)    │  & Focal Point Adjuster)       │
└──────────────────────────────────────────────────────────────────────────────────┘
🔄 Alur Kerja Pengaduan Warga (Passwordless Verification)
Cuplikan kode
graph TD
    A[Warga Kirim Laporan] -->|Form Tanpa Login| B(Simpan Draf Status Unverified)
    B --> C[Sistem Kirim Email]
    C -->|Temporary Signed URL| D[Warga Buka Email & Klik Verifikasi]
    D -->|Validasi Signature < 60 Min| E[Status Laporan Jadi Verified]
    E --> F[Notifikasi Masuk ke Dashboard Admin]
    F --> G{Admin Memproses}
    G -->|Tanggapan & Update Status| H[Status: Diproses / Selesai]
    H --> I[Warga Cek Status via Kode Tiket Unik]
⚡ Fitur Utama
Sistem Laporan Tanpa Akun: Warga melaporkan keluhan tanpa pendaftaran akun. Otentikasi keamanan menggunakan Signed Temporary URL via email dengan pembatasan waktu akses.

Tracking Tiket Unik: Pelapor memperoleh kode tiket unik (contoh: LPR-X8A2K9) untuk memantau perkembangan penanganan laporan secara transparan.

Demografi & Visualizer Real-Time: Grafik kependudukan interaktif (Gender, Agama, Pendidikan, Pekerjaan, Usia) terhubung langsung ke basis data dengan skrip validasi otomatis pencegah manipulasi data.

Studio Pemrosesan Media Presisi:

Cropper.js Integration: Pemotongan foto profil aparatur rasio 1:1 langsung di browser pengguna sebelum dikirim ke server.

Intervention Image Driver (GD): Kompresi otomatis gambar ke format .jpg (kualitas 70%, skala maksimum 800–1200px) untuk menghemat penggunaan kapasitas memori server.

Focal Point Adjuster: Pengaturan fokus visual (top, center, bottom) agar tampilan gambar tetap presisi di berbagai ukuran layar ponsel.

Integrasi GIS & Widget Cuaca: Peta spasial fasilitas desa terintegrasi langsung dengan Google Maps Direct Routing serta pembaruan kondisi cuaca real-time via Open-Meteo API.

🗄️ Skema Relasi Database
Cuplikan kode
erDiagram
    users ||--o{ laporans : "tindak_lanjut"
    profil_desas {
        bigint id PK
        string kunci UK
        text nilai
    }
    beritas {
        bigint id PK
        string judul
        string slug UK
        text konten
        string gambar
    }
    potensis {
        bigint id PK
        string judul
        string slug UK
        text deskripsi
        string gambar
    }
    aparaturs {
        bigint id PK
        string nama
        string jabatan
        string foto
    }
    laporans {
        bigint id PK
        string kode_tiket UK
        string nama_pelapor
        string email_pelapor
        string kategori
        text isi_laporan
        string foto_lampiran
        boolean is_verified
        enum status
        text tanggapan_admin
    }
🚀 Panduan Instalasi Lokal
1. Kloning & Dependensi
Bash
git clone [https://github.com/username/siperdes-gunturmadu.git](https://github.com/username/siperdes-gunturmadu.git)
cd siperdes-gunturmadu
composer install
npm install
2. Konfigurasi Lingkungan (.env)
Bash
cp .env.example .env
php artisan key:generate
Sesuaikan parameter database dan SMTP email pada file .env:

Cuplikan kode
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_gunturmadu
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-desa@gmail.com
MAIL_PASSWORD=app-specific-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@gunturmadu.desa.id"
MAIL_FROM_NAME="Desa Gunturmadu"
3. Migrasi, Seeder, & Storage Link
Bash
php artisan migrate --seed
php artisan storage:link
4. Jalankan Server
Bash
# Terminal 1 - Backend Server
php artisan serve

# Terminal 2 - Vite Compiler
npm run dev
Akses aplikasi melalui browser di http://127.0.0.1:8000.

🛠️ Stack Teknologi
Backend Framework: Laravel 11.x (PHP >= 8.2)

Frontend Engine: Tailwind CSS v3, Alpine.js v3, Chart.js v4

Media Processing: Intervention Image v3 (GD Driver), Cropper.js

Maps & Geolocation: WebGIS Leaflet Engine, Open-Meteo API

Security & Auth: Laravel Breeze, Signed Routes, CSRF Protection Guard
