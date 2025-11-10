<?php

class Database {
    private $host = "localhost";
    private $db_name = "demo_db";
    private $username = "root";
    private $password = "";
    private $charset = "utf8mb4";
    private $conn;

    public function getConnection() {
        try {
            $tempConn = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $tempConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $tempConn->exec("CREATE DATABASE IF NOT EXISTS `{$this->db_name}` CHARACTER SET {$this->charset} COLLATE {$this->charset}_unicode_ci");

            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "❌ Database connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
}
