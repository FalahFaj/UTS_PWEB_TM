<?php
// require_once 'koneksi.php';

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cariUserbyNIM($nim)
    {
        if (!$this->pdo)
            return false;
        $data_akun = $this->pdo->prepare("SELECT * FROM users WHERE nim = ?");
        $data_akun->execute([$nim]);
        return $data_akun->fetch(PDO::FETCH_ASSOC);
    }
    public function create($nama, $email, $password, $role, $nim, $foto_path)
    {

        try {
            $sql = "INSERT INTO users (nama, email, password, role, nim, foto_path) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nama, $email, $password, $role, $nim, $foto_path]);

        } catch (PDOException $e) {
            // ... (error handling) ...
        }
    }
}
?>