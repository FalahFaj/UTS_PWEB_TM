<?php

require_once __DIR__ . '/../model/Tugas.php';
class MahasiswaController {

    public function dashboard() {

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'mahasiswa') {
            header('Location: index.php?action=login');
            exit();
        }
        
        $user = [
            'nama' => $_SESSION['user_nama'],
            'nim' => $_SESSION['user_nim'] ?? 'N/A', // Gunakan NIM dari session
            'foto_path' => $_SESSION['user_foto'] ?? null
        ];

        $daftar_matakuliah = [
            [
                'id' => 1,
                'nama_matkul' => 'Operating System',
                'deskripsi' => 'Learn the basic operating system abstractions, mechanisms, and their implementations.',
                'nama_dosen' => 'Mark Lee',
                'bg_color' => 'bg-violet-100', // Warna background kartu
                'icon_color' => 'text-violet-500' 
            ],
            [
                'id' => 2,
                'nama_matkul' => 'Artificial Intelligence',
                'deskripsi' => 'Intelligence demonstrated by machines, unlike the natural intelligence displayed by humans and animals.',
                'nama_dosen' => 'Jung Jaehyun',
                'bg_color' => 'bg-pink-50',
                'icon_color' => 'text-pink-500'
            ],
            [
                'id' => 3,
                'nama_matkul' => 'Software Engineering',
                'deskripsi' => 'Learn detailed of engineering to the design, development and maintenance of software.',
                'nama_dosen' => 'Kim Taeyeong',
                'bg_color' => 'bg-rose-50',
                'icon_color' => 'text-rose-500'
            ]
        ];

        // Data dummy untuk "Online Users"
        
        // Muat halaman view dan kirim data yang dibutuhkan
        require 'view/mahasiswa/dashboard.php';
    }
    public function showTugasList() {
        // session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'mahasiswa') {
            header('Location: index.php?action=login');
            exit();
        }
        
        $tugasModel = new Tugas();
        if (!$tugasModel || $tugasModel == null) {
            header('Location: index.php?action=login');
            exit();
        }
        $daftar_tugas = $tugasModel->getAllTugas();

        require 'view/mahasiswa/lihat_tugas.php';
    }
}
?>