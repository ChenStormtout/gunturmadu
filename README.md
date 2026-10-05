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
