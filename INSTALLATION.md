# 🚀 Panduan Lengkap Instalasi & Deployment - Management Inventory System

Dokumen ini berisi langkah-langkah lengkap untuk membangun lingkungan server (Kali Linux/Debian/Ubuntu) dan mendeploy aplikasi Management Inventory System.

---

## 🛠️ Bagian 1: Instalasi Tools Prasyarat

Jalankan perintah berikut untuk menginstal semua tools yang dibutuhkan:

```bash
# Update sistem
sudo apt update && sudo apt upgrade -y

# 1. Instalasi MariaDB (Database)
sudo apt install -y mariadb-server

# 2. Instalasi Apache & phpMyAdmin
# Catatan: Akan muncul prompt interaktif untuk password phpMyAdmin
sudo apt install -y apache2 phpmyadmin

# 3. Instalasi PHP & Ekstensi yang Dibutuhkan
sudo apt install -y php php-mysql php-mbstring php-gd php-xml php-curl php-zip

# 4. Instalasi Tooling (Composer & Node.js)
sudo apt install -y composer nodejs npm
```

---

## 🗄️ Bagian 2: Konfigurasi Database

### 1. Amankan MariaDB & Buat Database
```bash
# Jalankan MariaDB (jika belum running)
sudo systemctl start mariadb

# Buat database untuk project
sudo mariadb -u root -e "CREATE DATABASE laravel_inventory;"
```

---

## 📦 Bagian 3: Setup Project Laravel

```bash
# 1. Clone Project
git clone https://github.com/IshikawaUta/laravel-management-inventory.git
cd laravel-management-inventory

# 2. Install Dependensi
composer install
npm install

# 3. Konfigurasi Environment (.env)
cp .env.example .env
php artisan key:generate

# Edit file .env dan sesuaikan bagian database:
# DB_CONNECTION=mysql
# DB_DATABASE=laravel_inventory
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Migrasi & Seed Data
php artisan migrate --seed

# 5. Build Frontend Assets
npm run build
```

---

## 🌐 Bagian 4: Deployment ke Apache

### 1. Buat VirtualHost
Buat file konfigurasi baru di `/etc/apache2/sites-available/laravel-inventory.conf`:

```apache
<VirtualHost *:80>
    ServerName ishikawauta.com
    ServerAlias www.ishikawauta.com
    DocumentRoot /home/ishikawauta/laravel-management-inventory/public

    <Directory /home/ishikawauta/laravel-management-inventory/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/laravel-error.log
    CustomLog ${APACHE_LOG_DIR}/laravel-access.log combined
</VirtualHost>
```

### 2. Aktifkan Site & Modul
```bash
sudo a2enmod rewrite
sudo a2ensite laravel-inventory.conf
sudo a2dissite 000-default.conf
sudo systemctl restart apache2
```

---

## ⚠️ Bagian 5: Troubleshooting & Izin (PENTING)

### 1. Fix Systemd ProtectHome
Secara default, Apache dilarang menulis ke folder `/home`. Matikan pembatasan ini:
```bash
sudo mkdir -p /etc/systemd/system/apache2.service.d
echo -e "[Service]\nProtectHome=false" | sudo tee /etc/systemd/system/apache2.service.d/override.conf
sudo systemctl daemon-reload
sudo systemctl restart apache2
```

### 2. Atur Izin Folder
```bash
sudo chown -R ishikawauta:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 3. Tambahkan Domain Lokal
Tambahkan baris berikut di file `/etc/hosts`:
```text
127.0.0.1 ishikawauta.com
```

---

## ✅ Bagian 6: Verifikasi & Auto-Start

### 1. Aktifkan Auto-Start
Agar service menyala otomatis saat terminal dibuka:
```bash
sudo systemctl enable apache2 mariadb
```

### 2. Akses Aplikasi
- **Aplikasi**: [http://ishikawauta.com](http://ishikawauta.com)
- **phpMyAdmin**: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

[PHPMyAdmin](public/img/phpmyadmin.png)

[Laravel](public/img/laravel.png)