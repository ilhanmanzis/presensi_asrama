# 🕌 Sistem Presensi Asrama MA Nurul Ummah

Aplikasi berbasis web untuk mengelola dan mencatat kehadiran santri di lingkungan asrama **MA Nurul Ummah**. Sistem ini mendukung dua jenis pengguna: **Admin** dan **Pembina**, dengan fitur yang disesuaikan untuk mendukung kebutuhan pengelolaan presensi harian hingga kegiatan pembelajaran agama.

---

## ✨ Fitur Utama

### 👤 Admin

-   Manajemen Data:
    -   Asrama
    -   Kelas
    -   Santri & Santriwati
    -   Kelompok Sorogan Al-Qur’an
    -   Kelompok Sorogan Kitab
-   Manajemen Pengguna Pembina
-   Presensi:
    -   Monitoring aktivitas presensi
-   Laporan:
    -   Export laporan ke **PDF** dan **Excel**
    -   Import data santri & santriwati dari file **Excel**
-   Pengaturan sistem (Settings)

### 📋 Pembina

-   Presensi:
    -   **Presensi Jamaah** (sholat wajib)
    -   **Kajian Bandongan**
    -   **Kelompok Sorogan Al-Qur’an**
    -   **Kelompok Sorogan Kitab**
    -   **Ekstrakurikuler**

---

## ⚙️ Cara Install & Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone https://github.com/ilhanmanzis/presensi_asrama.git
cd presensi_asrama

```

### 2. Install Dependency

```
composer install
npm install
```

### 3. Konfigurasi Environment

```
cp .env.example .env
```

Edit file .env, contoh:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asrama
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key

```
php artisan key:generate
```

### 5. Migrasi Database dan Seeder

```
php artisan migrate --seed
```

### 6. Jalankan Aplikasi

```
php artisan serve
```

### 7. link storage

```
php artisan storage:link
```

##

### Develpoment

```
npm run dev
```

### Build Vite

```
npm run build
```

## Login Admin

-   username : admin
-   password : admin

## Noted

jika terjadi eror saat "composer install", hapus file <strong>composer.lock</strong>


