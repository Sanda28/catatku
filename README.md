<p align="center">
  <a href="https://github.com/Sanda28/catatku" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">📒 Catatku - Aplikasi Buku Kas Digital</h1>

<p align="center">
  <b>Aplikasi pencatatan keuangan sederhana berbasis web menggunakan Laravel.</b><br>
  Cocok untuk UMKM, pedagang kecil, atau individu yang ingin memantau pemasukan dan pengeluaran harian.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red">
  <img src="https://img.shields.io/badge/status-Development-yellow">
  <img src="https://img.shields.io/badge/license-MIT-green">
</p>

---

### 🔗 Live Demo (UI)

👉 Coba antarmukanya langsung di sini: [catatku-ui](https://sanda28.github.io/catatku-ui/)

---

## ✨ Fitur Utama

- ✅ Manajemen data pemasukan & pengeluaran
- 📅 Kalender transaksi
- 📈 Dashboard keuangan dengan statistik mingguan
- 📊 Laporan dan rekap ke PDF
- 🔐 Sistem login dengan autentikasi Laravel Breeze
- 👥 Role user: user, admin, superadmin
- 📷 Absensi pekerja dengan QR Code yang berubah setiap 15 detik
- 📆 Rekap otomatis dan log histori absensi

---

## 🚀 Teknologi yang Digunakan

- Laravel 10
- MySQL
- Laravel Breeze
- Chart.js
- DomPDF (ekspor PDF)
- QR Code Generator (Real-time)

---

## ⚙️ Instalasi

```bash
git clone https://github.com/Sanda28/catatku.git
cd catatku
composer install
cp .env.example .env
php artisan key:generate
# Konfigurasi database pada file .env
php artisan migrate --seed
php artisan serve
