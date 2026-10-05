# SIPERDES GUNTURMADU

Sistem Informasi Desa & Platform Pengaduan Masyarakat

![Laravel](https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-%E2%89%A58.2-777BB4?style=flat-square&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind-v3.x-38B2AC?style=flat-square&logo=tailwind-css)
![Alpine.js](https://img.shields.io/badge/Alpine.js-v3.x-8BC0D0?style=flat-square&logo=alpine.js)

---

## 1. Arsitektur Sistem

### 1.1 Struktur Modul Aplikasi

```text
PORTAL PUBLIK DESA GUNTURMADU
├── Informasi Publik & Live Weather Widget
├── Visualizer Demografi Interaktif (Chart.js)
├── Spasial Pemetaan WebGIS (Leaflet Engine)
├── Etalase Produk UMKM & Potensi Desa
├── Galeri Foto & Lightbox Viewer
└── Jurnal Berita Desa
       │
       ▼
SISTEM VERIFIKASI PENGADUAN
├── Form Laporan Warga (Tanpa Akun)
├── Engine Temporary Signed URL
└── Mailer Verifikasi Email (Timeout 60 Menit)
       │
       ▼
PANEL KENDALI ADMIN
├── Dashboard Monitoring & Analitik
├── Manajemen Status Laporan Warga
└── Studio Pemrosesan Media (Cropper.js & Intervention Image)
```

### 1.2 Alur Verifikasi Pengaduan Warga

```mermaid
graph TD
    A[Penginputan Laporan Warga] -->|Form Tanpa Login| B(Simpan Status Draft Unverified)
    B --> C[Generator Email Link]
    C -->|Temporary Signed URL| D[Buka Link Verifikasi Email]
    D -->|Validasi Signature < 60 Min| E[Update Status Verified]
    E --> F[Masuk Dashboard Admin]
    F --> G{Tindakan Admin}
    G -->|Proses & Balas| H[Status: Diproses / Selesai]
    H --> I[Tracking Status via Kode Tiket]
```

---

## 2. Spesifikasi Fitur

### 2.1 Modul Publik dan Verifikasi

* **Auth Pengaduan (Temporary Signed URL):** Otentikasi laporan warga tanpa pendaftaran akun.
* **Pelacakan Tiket (Unique Hash String):** Kode unik tracking status pengaduan (Contoh: LPR-X8A2K9).
* **Weather Widget (Open-Meteo API):** Pembaruan kondisi cuaca lokasi desa secara berkala.
* **WebGIS Spasial (Leaflet Engine):** Pemetaan lokasi fasilitas umum dan rute navigasi.

### 2.2 Modul Pemrosesan Media & Demografi

* **Image Cropper (Cropper.js):** Pemotongan foto profil aparatur desa rasio 1:1 di browser.
* **Image Compression (Intervention Image v3):** Kompresi otomatis .jpg max 1200px dengan kualitas 70%.
* **Focal Adjustment (Custom Object Position):** Penyesuaian titik fokus gambar (top, center, bottom).
* **Visualizer Data (Chart.js v4):** Grafik demografi kependudukan terintegrasi guardrail script.

---

## 3. Skema Relasi Database (ERD)

```mermaid
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
```

---

## 4. Panduan Instalasi

### 4.1 Kloning Repositori & Install Dependensi

```bash
git clone [https://github.com/username/siperdes-gunturmadu.git](https://github.com/username/siperdes-gunturmadu.git)
cd siperdes-gunturmadu
composer install
npm install
```

### 4.2 Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Konfigurasi `.env`:

```env
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
```

### 4.3 Migrasi Database & Storage Symlink

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4.4 Menjalankan Server Lokal

```bash
# Terminal 1 - Backend Server
php artisan serve

# Terminal 2 - Frontend Asset Compiler
npm run dev
```

---

## 5. Tech Stack Summary

* **Backend Core:** Laravel 11.x (PHP >= 8.2)
* **Frontend UI:** Tailwind CSS v3, Alpine.js v3
* **Data Visualization:** Chart.js v4
* **Media Engine:** Intervention Image v3 (GD Driver), Cropper.js
* **Maps & Weather:** Leaflet WebGIS Engine, Open-Meteo API
* **Security Layer:** Laravel Breeze, Signed Temporary URLs, CSRF Protection
