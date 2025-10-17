<?php
    define('DB_SERVER', 'localhost');
    define('DB_PORT', '5432');
    define('DB_USERNAME', 'postgres');
    define('DB_PASSWORD', 'ns4dpn');
    define('DB_NAME', 'coba_php');

    function getPDO() {
        $db = "pgsql:host=".DB_SERVER.";port=".DB_PORT.";dbname=".DB_NAME;
        try {
            $pdo = new PDO($db, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            return null;
        }
    }

?>