
<?php
// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include necessary controller files
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/DashboardController.php';

// Add routing logic here to handle requests appropriately
$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestUri) {
    case '/login':
        (new AuthController())->login();
        break;
    case '/logout':
        (new AuthController())->logout();
        break;
    case '/dashboard':
        (new DashboardController())->index();
        break;
    case '/dashboard/users':
        (new DashboardController())->users();
        break;
    case '/dashboard/services':
        (new DashboardController())->services();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>
