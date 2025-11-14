# 🌽 Peta Jagung - Sistem Informasi Geografis Lahan Jagung Kabupaten Merauke

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Filament](https://img.shields.io/badge/Filament-3.2-purple.svg)](https://filamentphp.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Sistem Informasi Geografis (SIG) berbasis web untuk mengelola dan menampilkan data lahan jagung di Kabupaten Merauke. Aplikasi ini menyediakan platform digital yang memudahkan Dinas Tanaman Pangan, Hortikultura dan Perkebunan Kabupaten Merauke dalam memberikan informasi mengenai lahan jagung kepada investor dan masyarakat.

## 📋 Daftar Isi

-   [Fitur Utama](#-fitur-utama)
-   [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
-   [Persyaratan Sistem](#-persyaratan-sistem)
-   [Instalasi](#-instalasi)
-   [Konfigurasi](#-konfigurasi)
-   [Penggunaan](#-penggunaan)
-   [Struktur Proyek](#-struktur-proyek)
-   [Kontribusi](#-kontribusi)
-   [Lisensi](#-lisensi)

## ✨ Fitur Utama

### Frontend (Public)

-   🏠 **Halaman Beranda** - Dashboard dengan statistik lahan jagung
-   📊 **Halaman Data** - Tampilan data lahan dengan fitur:
    -   Pencarian lahan
    -   Filter berdasarkan distrik
    -   Toggle view (Card/Table)
    -   Pagination
-   🗺️ **Halaman Peta** - Visualisasi peta interaktif dengan Google Maps:
    -   Marker untuk setiap lahan
    -   Filter berdasarkan distrik
    -   Info window dengan detail lahan
-   📄 **Halaman Detail** - Informasi lengkap lahan:
    -   Peta lokasi
    -   Informasi petani dan lahan
    -   Data produksi (dengan filter tahun)
    -   Galeri foto dengan lightbox
    -   Rekomendasi lahan lainnya
-   🎨 **UI/UX Modern** - Desain responsif dengan:
    -   Scroll animations
    -   Modern card design
    -   Responsive layout untuk semua perangkat

### Backend (Admin Panel - Filament)

-   👥 **Manajemen User** - CRUD pengguna dengan role & permission
-   🏘️ **Manajemen Distrik** - Kelola data distrik
-   🌾 **Manajemen Lahan** - Kelola data lahan jagung:
    -   Upload thumbnail
    -   Input koordinat (latitude/longitude)
    -   Data petani dan lahan
-   📸 **Manajemen Galeri** - Upload dan kelola foto lahan
-   📈 **Manajemen Produksi** - Input data produksi per periode
-   🔐 **Role & Permission** - Sistem akses berbasis role menggunakan Spatie Permission
-   📤 **Export Data** - Export data ke Excel

## 🛠️ Teknologi yang Digunakan

### Backend

-   **Laravel 11.x** - PHP Framework
-   **Filament 3.2** - Admin Panel Builder
-   **MySQL** - Database
-   **Spatie Laravel Permission** - Role & Permission Management
-   **Filament Excel Export** - Export functionality

### Frontend

-   **Blade Templates** - Laravel templating engine
-   **HTML5 & CSS3** - Modern styling
-   **JavaScript (Vanilla)** - Interactivity
-   **Feather Icons** - Icon library
-   **Google Maps API** - Peta interaktif
-   **Intersection Observer API** - Scroll animations

### Development Tools

-   **Laragon** - Local development environment
-   **Composer** - PHP dependency manager
-   **NPM** - Node package manager
-   **Vite** - Build tool

## 📦 Persyaratan Sistem

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL >= 5.7 atau MariaDB >= 10.3
-   Web Server (Apache/Nginx) atau PHP Built-in Server
-   Google Maps API Key (untuk fitur peta)

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/appPemetaanLahanJagung.git
cd appPemetaanLahanJagung
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### 5. Jalankan Migration & Seeder

```bash
# Jalankan migration
php artisan migrate

# Jalankan seeder (untuk role & permission)
php artisan db:seed --class=RolePermissionSeeder
```

### 6. Buat Storage Link

```bash
php artisan storage:link
```

### 7. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

### 8. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Jalankan Server

```bash
# Development server
php artisan serve

# Atau dengan queue (jika diperlukan)
composer run dev
```

Aplikasi akan tersedia di `http://localhost:8000`

## ⚙️ Konfigurasi

### Google Maps API

1. Dapatkan API Key dari [Google Cloud Console](https://console.cloud.google.com/)
2. Aktifkan **Maps JavaScript API**
3. Tambahkan API Key ke file `.env`:

```env
GOOGLE_MAPS_API_KEY=your_api_key_here
```

### Konfigurasi Tambahan

Pastikan extension PHP berikut aktif:

-   `zip` - Untuk export Excel
-   `gd` atau `imagick` - Untuk image processing
-   `mbstring` - Untuk string handling
-   `openssl` - Untuk encryption

## 📖 Penggunaan

### Akses Frontend

-   **Home**: `http://localhost:8000/`
-   **Data Lahan**: `http://localhost:8000/data`
-   **Peta**: `http://localhost:8000/peta`
-   **Detail Lahan**: `http://localhost:8000/data/detail-lahan/{slug}`

### Akses Admin Panel

-   **Login**: `http://localhost:8000/admin/login`
-   Default user dapat dibuat melalui seeder atau registrasi manual

### Fitur Admin Panel

1. **Dashboard** - Overview statistik
2. **Distrik** - Kelola data distrik
3. **Lahan** - Kelola data lahan jagung
4. **Galeri** - Upload dan kelola foto
5. **Produksi** - Input data produksi
6. **Users** - Manajemen pengguna
7. **Roles & Permissions** - Kelola akses

## 📁 Struktur Proyek

```
appPemetaanLahanJagung/
├── app/
│   ├── Filament/          # Filament admin panel resources
│   ├── Http/
│   │   ├── Controllers/   # Application controllers
│   │   └── Requests/     # Form requests
│   ├── Models/           # Eloquent models
│   └── Providers/        # Service providers
├── database/
│   ├── migrations/       # Database migrations
│   └── seeders/          # Database seeders
├── public/
│   ├── css/              # Compiled CSS
│   ├── js/               # Compiled JavaScript
│   └── img/              # Public images
├── resources/
│   ├── views/
│   │   ├── front/        # Frontend views
│   │   ├── components/   # Blade components
│   │   └── layouts/      # Layout templates
│   ├── css/              # Source CSS
│   └── js/               # Source JavaScript
├── routes/
│   ├── web.php           # Web routes
│   └── auth.php          # Authentication routes
├── storage/              # Storage files
└── config/               # Configuration files
```

## 🔧 Troubleshooting

### Masalah Umum

**1. Storage link tidak berfungsi**

```bash
php artisan storage:link
```

**2. Permission denied pada storage**

```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache

# Windows - Pastikan folder storage writable
```

**3. Cache tidak ter-update**

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear
```

**4. Google Maps tidak muncul**

-   Pastikan API Key sudah di-set di `.env`
-   Pastikan Maps JavaScript API sudah diaktifkan
-   Cek console browser untuk error

**5. Extension PHP tidak aktif**
Edit `php.ini` dan uncomment extension yang diperlukan:

```ini
extension=zip
extension=gd
extension=mbstring
extension=openssl
```

## 🤝 Kontribusi

Kontribusi sangat diterima! Untuk berkontribusi:

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

### Standar Kode

-   Ikuti [PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/)
-   Gunakan meaningful commit messages
-   Update dokumentasi jika diperlukan

## 📝 Changelog

### v1.0.0

-   ✅ Implementasi frontend dengan desain modern
-   ✅ Admin panel dengan Filament
-   ✅ Integrasi Google Maps
-   ✅ Sistem role & permission
-   ✅ Export data ke Excel
-   ✅ Scroll animations
-   ✅ Responsive design

## 👥 Tim Pengembang

Dikembangkan untuk Dinas Tanaman Pangan, Hortikultura dan Perkebunan Kabupaten Merauke.

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT License](LICENSE).

## 🙏 Terima Kasih

Terima kasih telah menggunakan aplikasi Peta Jagung. Jika ada pertanyaan atau saran, silakan buat issue di repository ini.

---

**Dibuat dengan ❤️ menggunakan Laravel & Filament**
