<?php

require_once 'model/Tugas.php';
require_once 'model/User.php';
require_once 'model/Submission.php';
class AdminController {
    
    public function dashboard() {
        // session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        $nama_admin = $_SESSION['user_nama'];

        $statistik_admin = [
            'total_materi' => 52, // Contoh: Total materi yang sudah diunggah
            'total_tugas' => 35,  // Contoh: Total tugas yang sudah dibuat
            'total_admin' => 3,   // Contoh: Total admin (dosen)
            'total_mahasiswa' => 248 // Contoh: Total mahasiswa terdaftar
        ];

        $daftar_matakuliah_admin = [
            [
                'id' => 1,
                'judul' => 'Pemrograman Berbasis Web',
                'deskripsi' => 'Materi dan Tugas terkait pengembangan aplikasi web dengan PHP & JavaScript.',
                'dosen' => 'Dr. Budi Raharjo',
            ],
            [
                'id' => 2,
                'judul' => 'Jaringan Komputer',
                'deskripsi' => 'Pengenalan konsep dasar jaringan, protokol, dan konfigurasi perangkat.',
                'dosen' => 'Prof. Onno W. Purbo',
            ],
            [
                'id' => 3,
                'judul' => 'Struktur Data & Algoritma',
                'deskripsi' => 'Studi tentang cara menyimpan dan mengolah data secara efisien.',
                'dosen' => 'Ani Wijaya, M.T.',
            ],
            [
                'id' => 4,
                'judul' => 'Kecerdasan Buatan',
                'deskripsi' => 'Pengantar konsep AI, Machine Learning, dan Deep Learning.',
                'dosen' => 'Citra Lestari, Ph.D.',
            ]
        ];

        // Muat halaman view dashboard admin
        require 'view/admin/dashboard.php';
    }

    public function showUploadTugasForm() {
        // session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }
        
        // Tampilkan view
        require 'view/admin/upload_tugas.php';
    }

    public function uploadTugas() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $deadline = $_POST['deadline'];
        $admin_id = $_SESSION['user_id']; 
        
        $nama_file_db = null;
        $path_file_db = null;

        if (isset($_FILES['file_tugas']) && $_FILES['file_tugas']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['file_tugas'];
            $file_name = $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_size = $file['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            $allowed_ext = ['pdf', 'doc', 'docx', 'zip', 'rar'];

            if (in_array($file_ext, $allowed_ext)) {
                if ($file_size < 5000000) { // Maks 5MB
                    $new_file_name = "tugas_" . uniqid('', true) . "." . $file_ext;
                    $target_dir = "assets/tugas/";
                    $target_path = $target_dir . $new_file_name;

                    if (move_uploaded_file($file_tmp_name, $target_path)) {
                        $nama_file_db = $file_name; // Simpan nama asli
                        $path_file_db = $target_path; // Simpan path baru
                    } else {
                        $error = "Gagal memindahkan file.";
                        require 'view/admin/upload_tugas.php'; return;
                    }
                } else {
                    $error = "Ukuran file terlalu besar. Maksimal 5MB.";
                    require 'view/admin/upload_tugas.php'; return;
                }
            } else {
                $error = "Tipe file tidak diizinkan. Gunakan PDF, DOC, DOCX, ZIP, atau RAR.";
                require 'view/admin/upload_tugas.php'; return;
            }
        }

        $tugasModel = new Tugas();
        $success = $tugasModel->create($judul, $deskripsi, $deadline, $admin_id, $nama_file_db, $path_file_db);

        if ($success) {
            $success_message = "Tugas berhasil di-upload!";
            $success = $success_message;
            require 'view/admin/upload_tugas.php';
        } else {
            $error = "Gagal menyimpan tugas ke database.";
            require 'view/admin/upload_tugas.php';
        }
    }

    public function showTugasListAdmin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        $tugasModel = new Tugas();
        $daftar_tugas = $tugasModel->getAllTugasForAdmin();

        require 'view/admin/lihat_tugas_admin.php';
    }

    public function showSubmissionsForTugas() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit();
        }

        $tugas_id = isset($_GET['tugas_id']) ? (int)$_GET['tugas_id'] : 0;

        if ($tugas_id === 0) {
            header('Location: index.php?action=listTugasAdmin');
            exit();
        }

        $tugasModel = new Tugas();
        $submissionModel = new Submission();

        $tugas = $tugasModel->getTugasById($tugas_id); 
        $daftar_submissions = $submissionModel->getSubmissionsByTugasId($tugas_id); 

        if (!$tugas) {
             header('Location: index.php?action=listTugasAdmin');
            exit();
        }
        
        require 'view/admin/lihat_submissions.php';
    }
}
?>