<?php

    function getPDO() {
        $databaseUrl = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? getenv('DATABASE_URL');

        if (!$databaseUrl) {
            die("Error: DATABASE_URL tidak ditemukan. Pastikan file .env sudah ada dan benar.");
        }

        $parts = parse_url($databaseUrl);
        $dsn = sprintf(
            "pgsql:host=%s;port=%s;dbname=%s;sslmode=require",
            $parts['host'], $parts['port'], ltrim($parts['path'], '/')
        );

        try {
            $pdo = new PDO($dsn, $parts['user'], $parts['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            return null;
        }
    }

?>