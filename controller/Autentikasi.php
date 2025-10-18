<?php
require_once 'model/User.php';
class Authcontroller
{
    public function tampilkanLogin()
    {
        require 'view/auth/login.php';
    }
    public function tampilkanRegisterForm() {
        require 'view/auth/register.php';
    }
    public function register()
    {
        // 1. Ambil data POST seperti biasa
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = $_POST['role'];

        // 2. Variabel untuk menyimpan path foto
        $foto_path_to_db = null; // Default-nya NULL (jika tidak upload)

        // ... (Validasi password & email seperti sebelumnya) ...
        if ($password !== $confirm_password) { /* ... error ... */
        }
        $userModel = new User();
        if ($userModel->cariUserbyNIM($nim)) { /* ... error ... */
        }


        // 3. PROSES UPLOAD FOTO (BAGIAN BARU)
        // Cek apakah ada file yang di-upload dan tidak ada error
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {

            $file = $_FILES['foto'];
            $file_name = $file['name'];
            $file_tmp_name = $file['tmp_name']; // Lokasi file sementara
            $file_size = $file['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Tentukan ekstensi yang diizinkan
            $allowed_ext = ['jpg', 'jpeg', 'png'];

            if (in_array($file_ext, $allowed_ext)) {
                // Cek ukuran file (misal: maks 5MB)
                if ($file_size < 5000000) { // 5 juta byte = 5MB

                    // Buat nama file unik agar tidak bentrok
                    $new_file_name = "user_" . uniqid('', true) . "." . $file_ext;

                    // Tentukan path tujuan
                    $target_dir = "assets/img/uploads/";
                    $target_path = $target_dir . $new_file_name;

                    // Pindahkan file dari lokasi sementara ke folder tujuan
                    if (move_uploaded_file($file_tmp_name, $target_path)) {
                        // Jika berhasil, simpan path ini ke database
                        $foto_path_to_db = $target_path;
                    } else {
                        $error = "Gagal memindahkan file. Pastikan folder 'assets' writable.";
                        require 'view/auth/register.php';
                        return;
                    }

                } else {
                    $error = "Ukuran file terlalu besar. Maksimal 5MB.";
                    require 'view/auth/register.php';
                    return;
                }
            } else {
                $error = "Tipe file tidak diizinkan. Gunakan JPG, JPEG, atau PNG.";
                require 'view/auth/register.php';
                return;
            }
        }

        // 4. Kirim data ke Model (TERMASUK path foto baru)
        $success = $userModel->create($nama, $email, $password, $role, $nim, $foto_path_to_db);

        if ($success) {
            // ... (redirect ke login) ...
        } else {
            // ... (error) ...
        }
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=login');
            exit();
        }

        $nim = isset($_POST['nim']) ? trim($_POST['nim']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $fieldErrors = [
            'nim' => false,
            'password' => false,
        ];
        $shake = false;

        if ($nim === '' || $password === '') {
            if ($nim === '')
                $fieldErrors['nim'] = true;
            if ($password === '')
                $fieldErrors['password'] = true;
            $error = "NIM dan password harus diisi";
            $shake = true;

            $_SESSION['login_feedback'] = [
                'error' => $error,
                'fieldErrors' => $fieldErrors,
                'old' => ['nim' => $nim],
                'shake' => $shake,
            ];
            header('Location: index.php?action=login');
            exit();
        }

        $userModel = new User();
        $user = $userModel->cariUserbyNIM($nim);
        $passwordOk = false;
        if ($user && isset($user['password'])) {
            $passwordOk = ($password === trim($user['password']));
        }

        if ($user && $passwordOk) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nama'] = $user['nama'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] === 'dosen') {
                header('Location: index.php?action=dosenDashboard');
            } else {
                header('Location: index.php?action=mahasiswaDashboard');
            }
            exit();
        } else {
            $error = "Nim atau password salah";
            $fieldErrors['nim'] = true;
            $fieldErrors['password'] = true;
            $shake = true;
            $_SESSION['login_feedback'] = [
                'error' => $error,
                'fieldErrors' => $fieldErrors,
                'old' => ['nim' => $nim],
                'shake' => $shake,
            ];
            header('Location: index.php?action=login');
            exit();
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}
?>