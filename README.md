<div align="center">

  <br />

  <!-- Logo / Badge Header -->
  <img src="https://raw.githubusercontent.com/PKM-Gunturmadu/assets/main/logo-gunturmadu.png" alt="Desa Gunturmadu Logo" width="120" style="border-radius: 24px;" onerror="this.src='https://ui-avatars.com/api/?name=Gunturmadu&background=059669&color=fff&size=120&bold=true'">

  # 🌿 SIPERDES GUNTURMADU
  ### *Next-Gen Village Digital Ecosystem & Public Citizen Reporting System*

  [![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP Version](https://img.shields.io/badge/PHP-%E2%89%A5%208.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
  [![Alpine.js](https://img.shields.io/badge/Alpine.js-v3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)](https://alpinejs.dev)
  [![License](https://img.shields.io/badge/License-MIT-emerald?style=for-the-badge)](LICENSE)

  <p align="center">
    <b>Portal Sistem Informasi Publik, Monitoring Demografi Real-Time, WebGIS Spasial Interaktif, dan Sistem Pengaduan Warga Berbasis Signed Email Link.</b>
    <br />
    <a href="#-demografi--fitur-utama"><strong>Jelajahi Fitur »</strong></a>
    ·
    <a href="#-panduan-instalasi"><strong>Instalasi Lokal »</strong></a>
    ·
    <a href="#-arsitektur-database"><strong>Skema Database »</strong></a>
  </p>

</div>

---

> [!NOTE]
> **SIPERDES Gunturmadu** adalah platform pengelolaan pemerintahan desa terpadu yang memadukan landing page publik berperforma tinggi dengan *Panel Kendali Sistem Admin*. Dirancang khusus untuk efisiensi server hosting (kompresi memori dinamis) serta mendukung transparansi data publik tanpa mengorbankan kenyamanan pengguna (*User Experience*).

---

## 📸 Overview Interface

| **Portal Publik & Hero Section** | **Peta Demografi Real-Time** |
| :---: | :---: |
| <img src="https://user-images.githubusercontent.com/placeholder/hero-preview.png" alt="Hero Section" width="100%" onerror="this.src='https://via.placeholder.com/600x350/0f172a/10b981?text=Public+Portal+Hero+UI'"> | <img src="https://user-images.githubusercontent.com/placeholder/demografi-preview.png" alt="Chart Demografi" width="100%" onerror="this.src='https://via.placeholder.com/600x350/f8fafc/0284c7?text=Chart.js+Demographic+UI'"> |

| **WebGIS Spasial Interaktif** | **Control Panel Admin (Dark Glassmorphism)** |
| :---: | :---: |
| <img src="https://user-images.githubusercontent.com/placeholder/gis-preview.png" alt="WebGIS Map" width="100%" onerror="this.src='https://via.placeholder.com/600x350/059669/ffffff?text=Interactive+WebGIS+Map'"> | <img src="https://user-images.githubusercontent.com/placeholder/admin-preview.png" alt="Admin Panel" width="100%" onerror="this.src='https://via.placeholder.com/600x350/0f172a/38bdf8?text=Admin+Dashboard+Panel'"> |

---

## 🔥 Fitur Unggulan

### 🏛️ Portal Informasi Publik (Frontend)
- **🌦️ Live Weather Integration**: Widget cuaca otomatis berbasis API [Open-Meteo](https://open-meteo.com) menyesuaikan koordinat geografis Desa.
- **📊 Dynamic Demographic Visualizer**: Visualisasi statistik penduduk interaktif (Doughnut, Pie, & Horizontal/Vertical Bar Charts) menggunakan **Chart.js** yang terhubung langsung dengan basis data desa.
- **🗺️ Embedded WebGIS Live**: Peta geospasial interaktif fasilitas desa yang terintegrasi dengan Google Maps Direct Routing.
- **🖼️ Masonry Photo Gallery & Lightbox**: Galeri foto berkategori *Full-viewport Lightbox Pop-up* dengan keyboard gesture controls (`Escape` to exit).
- **💎 Etalase Potensi & UMKM**: Promosi produk unggulan lokal, komoditas pertanian, dan destinasi wisata desa dengan custom focal alignment.
- **📰 Jurnal & Kabar Desa**: Portal artikel & berita ramah SEO (*Search Engine Friendly Slug*) dilengkapi fitur *Social Media Direct Share* (WhatsApp & Facebook).

### 📬 Sistem Pengaduan Warga (*Lapor Warga*)
- **🔒 Passwordless Email Verification**: Warga dapat membuat laporan tanpa perlu *Sign Up/Login*. Validasi dilakukan melalui *Temporary Signed URLs* yang dikirimkan ke email pelapor (Masa berlaku link: 60 menit).
- **🎫 Unique Ticket Tracker**: Sistem auto-generate kode tiket unik (Contoh: `LPR-ABCDEF`) untuk memantau status tindak lanjut admin secara transparan.
- **🔄 Status Workflow**: Tahapan transparan (`menunggu` ➔ `diproses` ➔ `selesai` / `ditolak`) beserta balasan resmi dari pihak perangkat desa.

### ⚙️ Panel Kendali Admin (Backend)
- **✂️ Cropper.js Profile Image Studio**: Fitur potong foto profil aparatur desa dengan rasio 1:1 (*WhatsApp-style crop*) langsung di sisi klien sebelum dikirim ke server.
- **🗜️ Intervention Image Compression Engine**: Mengubah dan mengompres ukuran gambar secara otomatis ke format `.jpg` (skala max 800px-1200px / Kualitas 70%) untuk menghemat kapasitas storage server.
- **🎯 Custom Focal Point Image Adjuster**: Opsi penyesuaian posisi gambar (`object-top`, `object-center`, `object-bottom`) untuk memastikan bagian terpenting foto tidak terpotong pada layar seluler.
- **🧮 Automatic Demographic Validation**: Kalkulasi total penduduk otomatis (Pria + Wanita) dengan sistem *real-time guardrail script* untuk mencegah jumlah data rincian melebihi total populasi.

---

## 🛠️ Arsitektur & Teknologi

| Sektor | Teknologi yang Digunakan |
| :--- | :--- |
| **Core Framework** | [Laravel 11.x](https://laravel.com/) (PHP 8.2+) |
| **Frontend UI** | [Tailwind CSS v3](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/), Blade Components |
| **Datavis & Charts** | [Chart.js v4](https://www.chartjs.org/) |
| **Spatial / GIS** | Embedded WebGIS (Leaflet.js Engine) + Open-Meteo Weather API |
| **Media Processing**| [Cropper.js](https://fengyuanchen.github.io/cropperjs/) & [Intervention Image v3 (GD Driver)](https://image.intervention.io/) |
| **Authentication** | Laravel Breeze (Sanctum / Session-based) |
| **Database** | MySQL / MariaDB / SQLite Support |

---

## 📂 Struktur Direktori Proyek

```plaintext
siperdes-gunturmadu/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/                # Controller CRUD Panel Admin (Aparatur, Berita, Galeri, dll)
│   │   ├── Auth/                 # Authentication Controllers (Laravel Breeze)
│   │   ├── HomeController.php    # Public Landing Page & Visualizer Aggregator
│   │   └── LaporanWargaController.php # Signed-URL Email Reporting Handler
│   ├── Mail/                     # Mailable Classes (VerifikasiLaporanMail)
│   └── Models/                   # Eloquent Models (Aparatur, Berita, Laporan, Potensi, ProfilDesa, Galeri)
├── database/
│   ├── migrations/               # Schema Migrations
│   └── seeders/                  # Database Seeders (Default Demographic & Profile Data)
├── resources/
│   ├── css/                      # Tailwind CSS Entry Points
│   ├── js/                       # Alpine.js & Axios Setup
│   └── views/                    # Blade Templates (Admin Dashboards & Frontend Layouts)
└── routes/
    ├── web.php                   # Public, Verification, & Admin Protected Routes
    └── auth.php                  # Authentication Routes
