# Kelas Online - Website Lembaga Pelatihan Teknologi

Aplikasi web sederhana yang dibangun untuk memenuhi **Technical Test Magang Pembuatan Website**. Aplikasi ini terdiri dari Landing Page untuk pengunjung dan Dashboard Admin untuk mengelola kelas serta data pendaftar.

---

##  Daftar Isi
1. [Spesifikasi Teknis](#-spesifikasi-teknis)
2. [Fitur Aplikasi](#-fitur-aplikasi)
3. [Cara Instalasi (Local)](#-cara-instalasi-local)
4. [Akun Admin](#-akun-admin)
5. [Template & Aset Pihak Ketiga](#-template--aset-pihak-ketiga)
6. [Struktur Database](#-struktur-database)

---

##  Spesifikasi Teknis
Aplikasi ini dibangun menggunakan *environment* berikut:
- **Framework Utama:** Laravel v13.39.0
- **Bahasa Pemrograman:** PHP v8.3.35
- **Database:** MySQL (diuji menggunakan Laragon)
- **Manajemen Dependensi:** Composer v2.9.5
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5 (via CDN)
- **Web Server:** Laravel Development Server (`php artisan serve`)

---

##  Fitur Aplikasi

### A. Landing Page (Pengunjung)
- **Hero Section:** Menampilkan banner utama dan Call-to-Action.
- **Daftar Kelas:** Menampilkan kelas berstatus *Published* lengkap dengan pagination.
- **Pencarian & Filter:** Fitur pencarian berdasarkan judul kelas dan filter berdasarkan kategori.
- **Detail Kelas:** Halaman informasi lengkap mengenai kelas (deskripsi, instruktur, harga).
- **Formulir Pendaftaran:** Form pendaftaran (Nama, Email, Nomor Telepon) dengan validasi unik (satu email tidak bisa mendaftar dua kali di kelas yang sama).
- **Responsif:** Tampilan telah dioptimalkan untuk perangkat mobile (HP) dan desktop.

### B. Dashboard Admin (Pengelola)
- **Autentikasi:** Fitur Login dan Logout untuk mengamankan area admin.
- **Ringkasan Dashboard:** Menampilkan total kelas, total pendaftar, dan tabel 5 pendaftar terbaru.
- **Kelola Kategori (CRUD):** Tambah, lihat, ubah, hapus, dan cari data kategori.
- **Kelola Kelas (CRUD):** Tambah, lihat, ubah, hapus, dan cari kelas. Termasuk fitur unggah gambar (disimpan di Storage) dan pengaturan status (*Draft/Published*).
- **Kelola Pendaftar:** Melihat daftar pendaftar dan mengubah status kelulusan (*Pending, Diterima, Ditolak*).

### C. Fitur Bonus
- **Ekspor Data:** Fitur untuk mengekspor seluruh data pendaftar ke dalam format file `.csv` (Excel).

---

##  Cara Instalasi (Local)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer Anda:

**1. Prasyarat**
Pastikan komputer Anda sudah terinstal: PHP >= 8.3, Composer, MySQL (Laragon/XAMPP), dan Git.

**2. Clone Repositori**
```bash
git clone https://github.com/utaminadira76-hash/kelas-online.git
cd kelas-online

**3. Instal Dependensi**
composer install
**4. Konfigurasi Environment**
Copy file .env.example menjadi .env : (cp .env.example .env)
Generate application key: (php artisan key:generate)
**5.Setup Database**
Buka phpMyAdmin (atau tool database favorit Anda).
Buat database baru dengan nama kelas_online.
Buka file .env dan sesuaikan bagian berikut:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kelas_online
DB_USERNAME=root
DB_PASSWORD=
FILESYSTEM_DISK=public

**6.  Migrasi dan Seeder**
Jalankan perintah ini untuk membuat tabel dan mengisi data dummy (termasuk akun admin):
(php artisan migrate --seed)

**7. Symlink Storage**
Agar gambar kelas bisa diakses publik, jalankan: (php artisan storage:link)
**8. Jalankan Aplikasi**
php artisan serve
Aplikasi dapat diakses di http://localhost:8000.

