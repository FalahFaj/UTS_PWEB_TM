<?php
class DosenController {
    
    public function dashboard() {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'dosen') {
            header('Location: index.php?action=login');
            exit();
        }

        $nama_dosen = $_SESSION['user_nama'];
        
        // Muat halaman view dashboard dosen
        require 'view/dosen/dashboard.php';
    }
}
?>