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

    public function getAllTugas() {
        // Kita juga tambahkan 'mk.nama_matkul' jika Anda sudah mengimplementasikannya
        // Untuk sekarang, kita join dengan users
        $sql = "SELECT 
                    t.id, 
                    t.judul, 
                    t.deskripsi, 
                    t.deadline, 
                    t.nama_file, 
                    t.path_file,
                    u.nama as nama_admin
                FROM tugas AS t
                JOIN users AS u ON t.admin_id = u.id
                ORDER BY t.deadline ASC";
                
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>