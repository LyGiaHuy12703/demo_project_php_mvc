<?php
require_once 'src/model/User.php';
require_once 'src/model/Post.php'; // Thêm nếu quản lý bài viết

class DashboardController {
    private $userModel;
    private $postModel;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?url=login");
            exit();
        }
        $this->userModel = new User();
        $this->postModel = new Post(); // Nếu có quản lý bài viết
    }

    public function index() {
        // LẤY DỮ LIỆU TỪ MODEL
        $users = $this->userModel->getAll(); // Lưu vào biến
        $posts = $this->postModel->getAll(); // Nếu có

        // CÁCH 1: Dùng extract (đơn giản)
        extract([
            'users' => $users,
            'posts' => $posts
        ]);

        // CÁCH 2: Dùng mảng data (chuyên nghiệp hơn)
        // $data = ['users' => $users, 'posts' => $posts];
        // include 'src/views/dashboard.php';

        include 'src/views/dashboard.php';
    }
}