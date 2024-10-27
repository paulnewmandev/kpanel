<?php
class DashboardController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $pageTitle = 'Dashboard';
        $content = view('dashboard/home');
        echo view('dashboard/layout', ['pageTitle' => $pageTitle, 'content' => $content]);
    }

    public function users() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $pageTitle = 'Gestionar Usuarios';
        $content = view('dashboard/users');
        echo view('dashboard/layout', ['pageTitle' => $pageTitle, 'content' => $content]);
    }

    public function services() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $pageTitle = 'Gestionar Servicios';
        $content = view('dashboard/services');
        echo view('dashboard/layout', ['pageTitle' => $pageTitle, 'content' => $content]);
    }
}