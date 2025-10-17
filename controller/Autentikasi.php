<?php
    require_once 'model/User.php';
    class Authcontroller {
        public function tampilkanLogin() {
            require 'view/auth/login.php';
        }

        public function login() {
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
                if ($nim === '') $fieldErrors['nim'] = true;
                if ($password === '') $fieldErrors['password'] = true;
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

        public function logout() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            session_destroy();
            header('Location: index.php?action=login');
            exit();
        }
    }
?>