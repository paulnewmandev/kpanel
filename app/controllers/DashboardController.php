
<?php
class DashboardController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $pageTitle = 'Dashboard';
        $content = view('dashboard/home');
        echo view('dashboard/layout', ['pageTitle' => $pageTitle, 'content' => $content]);
    }

    public function users() {
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $pageTitle = 'Gestionar Usuarios';
        $content = view('dashboard/users');
        echo view('dashboard/layout', ['pageTitle' => $pageTitle, 'content' => $content]);
    }

    public function services() {
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $pageTitle = 'Gestionar Servicios';
        $content = view('dashboard/services');
        echo view('dashboard/layout', ['pageTitle' => $pageTitle, 'content' => $content]);
    }
}
