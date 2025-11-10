<?php

require_once 'src/model/User.php';

class AuthenticationController {
    public function login() {
        if(isset($_SESSION['user'])) {
            header("Location: dashboard");
            exit();
        }
        include 'src/views/login.php';
    }

    public function storeLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }

        $user = new User();
        $email = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            echo "Vui lòng nhập email và mật khẩu.";
            return;
        }

        $existingUser = $user->findByEmail($email);
        if ($existingUser && password_verify($password, $existingUser['password'])) {
            // ✅ Lưu user vào session
            $_SESSION['user'] = [
                'id' => $existingUser['id'],
                'name' => $existingUser['name'],
                'email' => $existingUser['email']
            ];

            header("Location: index.php?url=dashboard");
            exit();
        } else {
            echo "Sai email hoặc mật khẩu.";
        }
    }


    public function register() {
        if(isset($_SESSION['user'])) {
            header("Location: dashboard");
            exit();
        }
        include 'src/views/register.php';
    }

    public function storeRegister() {
        if(!$_SERVER['REQUEST_METHOD'] === 'POST') {
            return false;
        }else{
            $user = new User();
            $username = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            // validate
            if(empty($username) || empty($email) || empty($password)) {
                return false;
            }
            if($user->findByEmail($email)) {
                echo "Email đã tồn tại";
                return;
            }
            $success = $user->create($username, $email, $password);
            echo $success;
            if($success) {
                header("Location: login");
                exit();
            } else {
                echo "Đăng ký thất bại";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: home");
        exit();
    }
}