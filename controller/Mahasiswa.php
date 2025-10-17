<?php
class MahasiswaController {

    public function dashboard() {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'mahasiswa') {
            header('Location: index.php?action=login');
            exit();
        }
        
        $user = [
            'nama' => $_SESSION['user_nama'],
            'nim' => '242410103052'
        ];

        // Data untuk daftar mata kuliah
        $daftar_matakuliah = [
            [
                'id' => 1,
                'nama_matkul' => 'Operating System',
                'deskripsi' => 'Learn the basic operating system abstractions, mechanisms, and their implementations.',
                'nama_dosen' => 'Mark Lee',
                'bg_color' => 'bg-violet-100', // Warna background kartu
                'icon_color' => 'text-violet-500' // Warna ikon
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
        $online_users = [
            ['nama' => 'Maren Maureen', 'nim' => '1094882001'],
            ['nama' => 'Jenniffer Jane', 'nim' => '1094672000'],
            ['nama' => 'Ryan Herwinds', 'nim' => '1094342003']
        ];
        
        // Muat halaman view dan kirim data yang dibutuhkan
        require 'view/mahasiswa/dashboard.php';
    }
}
?>