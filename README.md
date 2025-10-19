# TuGasin - Sistem Manajemen Tugas Online

untuk login sebagai admin, masukkan
nim = 242410103052
pass = ikanhiu123oke

**TuGasin** adalah aplikasi web sederhana yang dirancang untuk memfasilitasi manajemen tugas antara admin dan mahasiswa. Aplikasi ini dibangun menggunakan PHP native dengan menerapkan konsep MVC.

## ✨ Fitur Utama

Aplikasi ini memiliki dua peran pengguna utama: **Admin** dan **Mahasiswa**.

### 👨‍🏫 Fitur Admin

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
- **Server:**
  - Apache / Nginx 
- **Database:**
  - Postgresql cloud menggunakan supabase

## 🛠️ Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/FalahFaj/UTS_PWEB_TM
    cd UTS_PWEB_TM
    ```

2.  **Setup Database**
    - coba jalankan file koneksi.php secara independent, jika database tidak terkoneksi, lakukan 

3.  **Konfigurasi Koneksi**
    - Cari file konfigurasi database (misalnya `koneksi.php` atau di dalam file model) dan sesuaikan dengan pengaturan database lokal Anda (nama host, nama database, user, password).

4.  **Install Dependencies**
    - Proyek ini menggunakan Composer untuk beberapa polyfill. Jalankan perintah berikut:
    ```bash
    composer require vlucas/phpdotenv
    ```

5.  **Jalankan Server**
    - Buka file index.php
    - Klik kanan terus pilih php serve project
