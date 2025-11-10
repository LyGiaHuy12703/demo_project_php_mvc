<?php

class Post extends Database {
    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
        $this->createTableIfNotExists();
    }

    private function createTableIfNotExists() {
        $sql = "
            CREATE TABLE IF NOT EXISTS posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
                    ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        $this->conn->exec($sql);
    }
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT
                p.id,
                p.title,
                p.content,
                p.created_at,
                u.name AS author_name FROM posts p LEFT JOIN users u ON p.user_id = u.id WHERE p.id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $userId = null) {
        if ($userId === null) {
            if (!isset($_SESSION['user']['id'])) {
                throw new Exception("Không tìm thấy người dùng đang đăng nhập.");
            }
            $userId = $_SESSION['user']['id'];
        }

        $stmt = $this->conn->prepare("
            INSERT INTO posts (user_id, title, content)
            VALUES (:user_id, :title, :content)
        ");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function getAll() {
        $query = "
            SELECT 
                p.id, 
                p.title, 
                p.created_at,
                u.name AS author_name
            FROM posts p
            LEFT JOIN users u ON p.user_id = u.id
            ORDER BY p.created_at DESC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByUserId($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id, $title, $content) {
        $stmt = $this->conn->prepare("
            UPDATE posts
            SET title = :title, content = :content
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function deleteById($id) {
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}