<?php

require_once __DIR__ . '/../model/Tugas.php';
require_once __DIR__ . '/../model/Submission.php';
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

    public function showKumpulTugasForm() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'mahasiswa') {
            header('Location: index.php?action=login');
            exit();
        }

        $tugas_id = isset($_GET['tugas_id']) ? (int)$_GET['tugas_id'] : 0;
        $mahasiswa_id = $_SESSION['user_id'];

        $tugasModel = new Tugas();
        $tugas = $tugasModel->getTugasById($tugas_id);

        if (!$tugas) {
            header('Location: index.php?action=lihatTugas'); // Tugas tidak ditemukan
            exit();
        }

        $submissionModel = new Submission();
        $sudah_mengumpulkan = $submissionModel->checkExistingSubmission($tugas_id, $mahasiswa_id);

        // Kirim data ke view
        require 'view/mahasiswa/kumpul_tugas.php';
    }

    public function doKumpulTugas() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'mahasiswa') {
            header('Location: index.php?action=login');
            exit();
        }

        $tugas_id = isset($_POST['tugas_id']) ? (int)$_POST['tugas_id'] : 0;
        $mahasiswa_id = $_SESSION['user_id'];

        $submissionModel = new Submission();
        if ($submissionModel->checkExistingSubmission($tugas_id, $mahasiswa_id)) {
            $error = "Anda sudah pernah mengumpulkan tugas ini!";
            $tugasModel = new Tugas();
            $tugas = $tugasModel->getTugasById($tugas_id);
            $sudah_mengumpulkan = true;
            require 'view/mahasiswa/kumpul_tugas.php';
            return;
        }

        if (isset($_FILES['file_kumpulan']) && $_FILES['file_kumpulan']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['file_kumpulan'];
            $file_name = $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_size = $file['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            $allowed_ext = ['pdf', 'doc', 'docx', 'zip', 'rar', 'jpg', 'png'];

            if (in_array($file_ext, $allowed_ext)) {
                if ($file_size < 5000000) { // Maks 5MB
                    
                    // Buat nama file unik: kumpulan_[user_id]_[tugas_id]_[random].ext
                    $new_file_name = "kumpulan_" . $mahasiswa_id . "_" . $tugas_id . "_" . uniqid('', true) . "." . $file_ext;
                    $target_dir = "assets/uploads/tugas_mahasiswa/";
                    $target_path = $target_dir . $new_file_name;

                    if (move_uploaded_file($file_tmp_name, $target_path)) {
                        // 3. Simpan ke database
                        $success = $submissionModel->createSubmission($tugas_id, $mahasiswa_id, $file_name, $target_path);

                        if ($success) {
                            $_SESSION['success_message'] = "Tugas berhasil dikumpulkan!";
                            header('Location: index.php?action=lihatTugas');
                            exit();
                        } else {
                            $error = "Gagal menyimpan data ke database. Mungkin Anda sudah submit?";
                        }
                    } else {
                        $error = "Gagal memindahkan file yang di-upload.";
                    }
                } else {
                    $error = "Ukuran file terlalu besar. Maksimal 5MB.";
                }
            } else {
                $error = "Tipe file tidak diizinkan.";
            }
        } else {
            $error = "Tidak ada file yang di-upload atau terjadi error.";
        }

        $tugasModel = new Tugas();
        $tugas = $tugasModel->getTugasById($tugas_id);
        $sudah_mengumpulkan = false;
        require 'view/mahasiswa/kumpul_tugas.php';
    }
}
?>