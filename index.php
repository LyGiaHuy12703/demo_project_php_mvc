<?php
session_start();
require_once 'src/core/Database.php';
require_once 'src/model/User.php';
require_once 'src/model/Post.php';
require_once 'src/controllers/AuthenticationController.php';
require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/PostController.php';

$user = new User();
$post = new Post();

$controller = new AuthenticationController();
$url = $_GET['url'] ?? '';

switch ($url) {
    case 'login':
        $controller->login();
        break;
    case 'storeLogin':
        $controller->storeLogin();
        break;
    case 'register':
        $controller->register();
        break;
    case 'storeRegister':
        $controller->storeRegister();
        break;
    case 'dashboard':
        $dashboard = new DashboardController();
        $dashboard->index();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'createPost':
        $post = new PostController();
        $post->createPost();
        break;
    case 'storePost':
        $post = new PostController();
        $post->storePost();
        break;
    case 'editPost':
        $post = new PostController();
        $post->editPost();
        break;
    case 'updatePost':
        $post = new PostController();
        $post->updatePost();
        break;
    case 'viewPost':
        $post = new PostController();
        $post->detailPost();
        break;
    case 'deletePost':
        $post = new PostController();
        $post->deletePost();
        break;
    default:
        include 'src/views/home.php';
        break;
}
