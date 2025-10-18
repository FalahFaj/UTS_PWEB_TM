<?php
require_once 'koneksi.php';

class Tugas {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    public function create($judul, $deskripsi, $deadline, $admin_id, $nama_file, $path_file) {
        try {
            $sql = "INSERT INTO tugas (judul, deskripsi, deadline, admin_id, nama_file, path_file) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);
            
            return $stmt->execute([
                $judul, 
                $deskripsi, 
                $deadline, 
                $admin_id, 
                $nama_file, 
                $path_file
            ]);

        } catch (PDOException $e) {
            die("Error saat membuat tugas: " . $e->getMessage());
        }
    }
}
?>