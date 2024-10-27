<?php
class DashboardController {
    public function index($page = 'home') {
        logDebug("DashboardController::index called", [
            'page' => $page,
            'session' => $_SESSION
        ]);
        
        if (!isset($_SESSION['user_id'])) {
            logDebug("Unauthenticated user in dashboard, redirecting to login");
            header('Location: /login');
            exit;
        }

        $allowedPages = ['home', 'users', 'services'];
        $page = in_array($page, $allowedPages) ? $page : 'home';
        
        $pageTitle = ucfirst($page);
        $contentFile = __DIR__ . "/../views/dashboard/{$page}.php";
        
        if (!file_exists($contentFile)) {
            logDebug("Dashboard page not found, defaulting to home", ['page' => $page]);
            $contentFile = __DIR__ . "/../views/dashboard/home.php";
        }
        
        logDebug("Rendering dashboard", [
            'page' => $page,
            'contentFile' => $contentFile
        ]);
        
        require __DIR__ . '/../views/dashboard/layout.php';
    }
}