<?php
// test_db.php - Enhanced DB connectivity test for the project

echo "Memulai tes koneksi database...\n\n";

// --- Langkah 1: Periksa keberadaan file .env ---
$envFile = __DIR__ . '/.env';
if (!file_exists($envFile)) {
    echo "[GAGAL] File .env tidak ditemukan.\n";
    echo "       Pastikan file .env sudah ada di direktori: " . __DIR__ . "\n";
    exit(1); // Keluar dengan kode error
}
echo "[OK]    File .env ditemukan.\n";

// --- Langkah 2: Muat Composer dan phpdotenv ---
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
    if (class_exists('Dotenv\Dotenv')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load(); // Gunakan load() untuk memastikan file diproses
        echo "[OK]    Pustaka phpdotenv berhasil dimuat.\n";
    } else {
        echo "[GAGAL] Class 'Dotenv\Dotenv' tidak ditemukan. Jalankan 'composer install'.\n";
        exit(1);
    }
} else {
    echo "[GAGAL] File 'vendor/autoload.php' tidak ditemukan. Jalankan 'composer install'.\n";
    exit(1);
}

// --- Langkah 3: Periksa apakah DATABASE_URL sudah di-set ---
// Coba ambil dari $_ENV, $_SERVER, lalu getenv(). Ini lebih andal.
$databaseUrl = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? getenv('DATABASE_URL');

if (empty($databaseUrl)) {
    echo "[GAGAL] Variabel DATABASE_URL tidak ditemukan di dalam file .env atau kosong.\n";
    echo "       Pastikan baris DATABASE_URL=\"...\" ada di dalam file .env Anda.\n";
    echo "\n--- DEBUG INFO ---\n";
    echo "Isi dari \$_ENV:\n";
    print_r($_ENV);
    echo "------------------\n";
    exit(1);
}
echo "[OK]    Variabel DATABASE_URL ditemukan.\n\n";

// --- Langkah 4: Coba koneksi ke database ---
echo "Mencoba terhubung ke Supabase...\n";
require_once __DIR__ . '/koneksi.php';

$pdo = getPDO();
if ($pdo) {
    echo "[SUKSES] Koneksi ke database berhasil!\n";
} else {
    echo "[GAGAL]  Koneksi ke database gagal. Periksa kembali password atau URL di dalam DATABASE_URL Anda.\n";
}
