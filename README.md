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
  <img src="https://img.shields.io/badge/Database-MySQL%2FMariaDB-4479A1?style=for-the-badge&logo=mysql" alt="MariaDB">
  <img src="https://img.shields.io/badge/Tools-phpMyAdmin-6C78AF?style=for-the-badge&logo=phpmyadmin" alt="phpMyAdmin">
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
- **Database:** MySQL/MariaDB (via phpMyAdmin)
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
git clone https://github.com/IshikawaUta/laravel-management-inventory.git
cd laravel-management-inventory

# 2. Install dependensi PHP
composer install

# 3. Install dependensi Node
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi Database (.env)
# Buat database 'laravel_inventory' di phpMyAdmin, lalu sesuaikan:
DB_CONNECTION=mysql
DB_DATABASE=laravel_inventory
DB_USERNAME=root
DB_PASSWORD=

# 7. Jalankan migrasi dan seeding database
php artisan migrate --seed

# 8. Build assets frontend
npm run build
```

---

## 🌐 Akses Aplikasi

Aplikasi ini dapat diakses melalui dua cara:

1.  **Production (Apache)**: [http://ishikawauta.com](http://ishikawauta.com) (Direkomendasikan)
2.  **Development**: Jalankan `php artisan serve` dan akses [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 👤 Akun Default

Setelah menjalankan `php artisan migrate:fresh --seed`, akun berikut tersedia:

| Peran | Email | Password |
|---|---|---|
| **Admin** | `admin@admin.com` | `password` |
| **Staff** | `staff@example.com` | `password` |

---

## 🛠️ Setup Database & phpMyAdmin

Proyek ini menggunakan **MariaDB** dan dapat dikelola melalui **phpMyAdmin**.

### Langkah Integrasi:
1. **Buka phpMyAdmin**: Akses `http://localhost/phpmyadmin`.
2. **Buat Database**: Buat database baru dengan nama `laravel_inventory`.
3. **Konfigurasi .env**: Pastikan `DB_CONNECTION=mysql` dan `DB_DATABASE=laravel_inventory` sudah sesuai.
4. **Migrasi**: Jalankan `php artisan migrate --seed`.

---

## 🚀 Deployment ke Apache

Aplikasi ini telah dikonfigurasi menggunakan VirtualHost Apache:

- **Site Domain**: `ishikawauta.com`
- **Document Root**: `/home/ishikawauta/laravel-management-inventory/public`
- **VirtualHost Config**: `/etc/apache2/sites-available/laravel-inventory.conf`

---

## ⚠️ Troubleshooting (Izin Folder)

Jika Anda menemui error `tempnam()` atau permissions saat menggunakan Apache di direktori `/home`, ikuti langkah berikut:

1. **Matikan ProtectHome Systemd**:
   Secara default, Apache dilarang menulis ke direktori `/home`. Buat file override:
   ```bash
   sudo mkdir -p /etc/systemd/system/apache2.service.d
   echo -e "[Service]\nProtectHome=false" | sudo tee /etc/systemd/system/apache2.service.d/override.conf
   sudo systemctl daemon-reload
   sudo systemctl restart apache2
   ```

2. **Atur Izin Folder Laravel**:
   ```bash
   sudo chown -R ishikawauta:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache
   ```

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