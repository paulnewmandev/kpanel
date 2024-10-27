<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_type'] = $user['type'];
                header('Location: /dashboard');
                exit;
            } else {
                $error = "Credenciales inválidas o usuario inactivo";
            }
        }
        
        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}