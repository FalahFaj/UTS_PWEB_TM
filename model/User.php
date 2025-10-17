<?php
    require_once 'koneksi.php';

    class User {
        private $pdo;

        public function __construct() {
            $this->pdo = getPDO();
        }

        public function cariUserbyNIM($nim) {
            if (!$this->pdo) return false;
            $data_akun = $this->pdo->prepare("SELECT * FROM users WHERE nim = ?");
            $data_akun->execute([$nim]);
            return $data_akun->fetch(PDO::FETCH_ASSOC);
        }
    }
?>