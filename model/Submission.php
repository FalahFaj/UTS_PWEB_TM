<?php
require_once 'koneksi.php';

class Submission {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    public function getSubmissionsByTugasId($tugas_id) {
        $sql = "SELECT 
                    s.id,
                    s.nama_file,
                    s.path_file,
                    s.submitted_at,
                    u.nama as nama_mahasiswa,
                    u.email as email_mahasiswa
                FROM pengumpulan AS s
                JOIN users AS u ON s.mahasiswa_id = u.id
                WHERE s.tugas_id = ?
                ORDER BY s.submitted_at ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tugas_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkExistingSubmission($tugas_id, $mahasiswa_id) {
        $sql = "SELECT COUNT(*) FROM pengumpulan WHERE tugas_id = ? AND mahasiswa_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tugas_id, $mahasiswa_id]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function createSubmission($tugas_id, $mahasiswa_id, $nama_file, $path_file) {
        try {
            $sql = "INSERT INTO pengumpulan (tugas_id, mahasiswa_id, nama_file, path_file)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$tugas_id, $mahasiswa_id, $nama_file, $path_file]);
        } catch (PDOException $e) {

            if ($e->getCode() == '23505') {
                return false; 
            } else {
                die("Error: " . $e->getMessage());
            }
        }
    }

}
?>