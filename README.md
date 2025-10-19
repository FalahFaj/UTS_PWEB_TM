# TuGasin - Sistem Manajemen Tugas Online

<img width="1189" height="414" alt="image" src="https://github.com/user-attachments/assets/dcd0ae49-7bb9-4aaf-abc9-f5c1243ff303" />

**TuGasin** adalah aplikasi web sederhana yang dirancang untuk memfasilitasi manajemen tugas antara dosen dan mahasiswa. Aplikasi ini dibangun menggunakan PHP native dengan antarmuka yang modern menggunakan Tailwind CSS.

## ✨ Fitur Utama

Aplikasi ini memiliki dua peran pengguna utama: **Admin (Dosen)** dan **Mahasiswa**.

### 👨‍🏫 Fitur Admin (Dosen)

- **Dashboard Admin:** Menampilkan ringkasan statistik seperti total tugas, total mahasiswa, dll.
- **Upload Tugas:** Membuat dan mempublikasikan tugas baru lengkap dengan judul, deskripsi, tenggat waktu, dan file lampiran.
- **Kelola Tugas:** Melihat daftar semua tugas yang telah dibuat.
- **Lihat Pengumpulan:** Memantau siapa saja mahasiswa yang sudah mengumpulkan tugas tertentu.
- **Download Submission:** Mengunduh file tugas yang dikumpulkan oleh mahasiswa.

### 🎓 Fitur Mahasiswa

- **Dashboard Mahasiswa:** Halaman utama yang menampilkan ringkasan mata kuliah.
- **Daftar Tugas:** Melihat semua tugas yang tersedia dari berbagai mata kuliah.
- **Detail Tugas:** Melihat detail tugas, termasuk deskripsi dan tenggat waktu.
- **Download Lampiran:** Mengunduh file lampiran yang disertakan oleh dosen pada tugas.
- **Kumpul Tugas:** Mengunggah dan mengirimkan file jawaban tugas. Sistem akan memberikan notifikasi jika tugas sudah pernah dikumpulkan.

## 🚀 Teknologi yang Digunakan

- **Backend:**
  - PHP 7.4+
- **Frontend:**
  - HTML5
  - [Tailwind CSS](https://tailwindcss.com/)
  - JavaScript (untuk interaktivitas UI seperti sidebar)
- **Server:**
  - Apache / Nginx (disarankan menggunakan XAMPP, WAMP, atau sejenisnya)
- **Database:**
  - MySQL / MariaDB

## 🛠️ Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/nama-repo.git
    cd nama-repo
    ```

2.  **Setup Database**
    - Buat database baru di phpMyAdmin (misalnya, `db_tugas_online`).
    - Impor file `database.sql` (Anda perlu membuatnya terlebih dahulu dari struktur database Anda) ke dalam database yang baru dibuat.

3.  **Konfigurasi Koneksi**
    - Cari file konfigurasi database (misalnya `config/database.php` atau di dalam file model) dan sesuaikan dengan pengaturan database lokal Anda (nama host, nama database, user, password).

4.  **Install Dependencies**
    - Proyek ini menggunakan Composer untuk beberapa polyfill. Jalankan perintah berikut:
    ```bash
    composer install
    ```

5.  **Jalankan Server**
    - Pindahkan folder proyek ke dalam direktori `htdocs` (untuk XAMPP) atau `www` (untuk WAMP).
    - Buka web server Anda (misalnya XAMPP Control Panel) dan jalankan Apache dan MySQL.
    - Akses proyek melalui browser Anda, misalnya: `http://localhost/nama-folder-proyek/`

## 📂 Struktur Folder

```
/
├── assets/         # File CSS, JS, dan gambar
├── controller/     # Logika bisnis dan kontrol alur aplikasi
├── model/          # Interaksi dengan database
├── view/           # File-file antarmuka (HTML/PHP)
├── vendor/         # Dependensi dari Composer
└── index.php       # Front Controller (titik masuk utama)
```
