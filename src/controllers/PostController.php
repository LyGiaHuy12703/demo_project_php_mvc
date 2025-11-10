<?php

class PostController {
    private $userModel;

    public function __construct() {
        if(!isset($_SESSION['user'])) {
            header("Location: login");
            exit();
        }
        $this->userModel = new User();
    }
    public function detailPost() {
        if (!isset($_GET['id'])) {
            header("Location: dashboard");
            exit();
        }

        $postId = intval($_GET['id']);
        $postModel = new Post();
        $post = $postModel->findById($postId);

        if (!$post) {
            header("Location: index.php?url=dashboard");
            exit();
        }

        include 'src/views/detailPost.php';
    }
    public function createPost() {
        $this->userModel->getAll();
        include 'src/views/createPost.php';
    }
    public function storePost() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $authorId = $_SESSION['user']['id'];

        if (empty($title) || empty($content)) {
            echo "Vui lòng nhập tiêu đề và nội dung bài viết.";
            return;
        }

        $postModel = new Post();
        $postModel->create($title, $content, $authorId);

        header("Location: dashboard");
        exit();
    }
    public function editPost() {
        if (!isset($_GET['id'])) {
            header("Location: dashboard");
            exit();
        }

        $postId = intval($_GET['id']);
        $postModel = new Post();
        $post = $postModel->findById($postId);

        if (!$post) {
            header("Location: index.php?url=dashboard");
            exit();
        }

        include 'src/views/editPost.php';
    }
    public function updatePost() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
            return false;
        }

        $postId = intval($_POST['id']);
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (empty($title) || empty($content)) {
            echo "Vui lòng nhập tiêu đề và nội dung bài viết.";
            return;
        }

        $postModel = new Post();
        $postModel->update($postId, $title, $content);

        header("Location: index.php?url=dashboard");
        exit();
    }
    public function deletePost() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?url=dashboard");
            exit();
        }

        $postId = intval($_GET['id']);
        $postModel = new Post();
        $postModel->deleteById($postId);
        header("Location: index.php?url=dashboard");
        exit();

    }

}