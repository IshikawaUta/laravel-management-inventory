# 📦 Management Inventory System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
  Aplikasi manajemen inventaris gudang berbasis web yang dibangun dengan <strong>Laravel 12</strong>.
  Dilengkapi dengan desain premium <em>glassmorphism</em>, autentikasi, dan kontrol akses berbasis peran (RBAC).
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Database-SQLite-003B57?style=for-the-badge&logo=sqlite" alt="SQLite">
  <img src="https://img.shields.io/badge/Auth-Breeze-4A90E2?style=for-the-badge" alt="Laravel Breeze">
</p>

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---|---|
| 🔐 **Autentikasi** | Login/logout aman dengan Laravel Breeze |
| 👥 **RBAC** | Dua peran: **Admin** (akses penuh) dan **Staff** (akses terbatas) |
| 📊 **Dashboard** | Ringkasan metrik: total barang, total stok, low stock alert |
| 📦 **Manajemen Barang** | CRUD barang dengan kategori, SKU, harga, dan stok |
| 🔄 **Transaksi** | Pencatatan barang **Masuk (IN)** & **Keluar (OUT)** dengan update stok otomatis |
| 📈 **Laporan** | Riwayat transaksi dengan filter tanggal dan ekspor ke **CSV** |
| 🎨 **UI Premium** | Desain modern glassmorphism dengan Vanilla CSS |

---

## 🛠️ Teknologi

- **Backend:** [Laravel 12](https://laravel.com/) (PHP 8.2+)
- **Authentication:** [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
- **Database:** SQLite (default) — dapat diganti MySQL/PostgreSQL
- **Frontend:** Blade Templates + Vanilla CSS (Glassmorphism)
- **Icons:** Font Awesome 6
- **Fonts:** Google Fonts — Inter

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM

### Langkah Instalasi

```bash
# 1. Clone repository
git clone <repository-url>
cd management-inventory

# 2. Install dependensi PHP
composer install

# 3. Install dependensi Node
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Jalankan migrasi dan seeding database
php artisan migrate:fresh --seed

# 7. Build assets frontend
npm run build

# 8. Jalankan server
php artisan serve
```

Aplikasi akan berjalan di **http://127.0.0.1:8000**

---

## 👤 Akun Default

Setelah menjalankan `php artisan migrate:fresh --seed`, akun berikut tersedia:

| Peran | Email | Password |
|---|---|---|
| **Admin** | `admin@example.com` | `password` |
| **Staff** | `staff@example.com` | `password` |

---

## 🔑 Hak Akses (RBAC)

| Fitur | Admin | Staff |
|---|:---:|:---:|
| Dashboard | ✅ | ✅ |
| Lihat Daftar Barang | ✅ | ❌ |
| Tambah / Edit / Hapus Barang | ✅ | ❌ |
| Catat Transaksi (IN/OUT) | ✅ | ✅ |
| Lihat Laporan | ✅ | ✅ |
| Ekspor Laporan CSV | ✅ | ✅ |

---

## 🗂️ Struktur Database

```
users           → Data pengguna (nama, email, password, role)
categories      → Kategori barang (nama, deskripsi)
items           → Master barang (SKU, nama, kategori, harga, stok)
transactions    → Riwayat transaksi barang masuk/keluar
```

---

## 📁 Struktur Folder Utama

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── ItemController.php
│   │   ├── TransactionController.php
│   │   └── ReportController.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Item.php
│   └── Transaction.php
resources/
├── css/
│   └── premium.css         ← Custom CSS Glassmorphism
└── views/
    ├── layouts/            ← Template utama
    ├── dashboard.blade.php
    ├── items/              ← Halaman barang
    ├── transactions/       ← Halaman transaksi
    └── reports/            ← Halaman laporan
```

---

## ⚙️ Perintah Berguna

```bash
# Reset database (hapus semua data + seed ulang)
php artisan migrate:fresh --seed

# Jalankan server development
php artisan serve

# Build assets untuk production
npm run build

# Lihat semua route
php artisan route:list
```

---

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).