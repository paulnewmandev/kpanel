<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

function logDebug($message, $context = []) {
    $logFile = __DIR__ . '/../logs/debug.log';
    $timestamp = date('[Y-m-d H:i:s]');
    $contextString = !empty($context) ? json_encode($context, JSON_PRETTY_PRINT) : '';
    $logMessage = "$timestamp $message\n$contextString\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function checkFileExists($path) {
    $fullPath = realpath(__DIR__ . '/..' . $path);
    $exists = file_exists($fullPath);
    logDebug("Checking file existence", [
        'path' => $path,
        'fullPath' => $fullPath,
        'exists' => $exists
    ]);
    return $exists;
}

try {
    $request = $_SERVER['REQUEST_URI'];
    $base_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base_path = rtrim(dirname($base_path), '/');
    $request = str_replace($base_path, '', $request);
    $request = rtrim($request, '/');
    if (empty($request)) {
        $request = '/';
    }

    $parts = explode('/', $request);

    $isAuthenticated = isset($_SESSION['user_id']);

    logDebug("Request received", [
        'uri' => $request,
        'method' => $_SERVER['REQUEST_METHOD'],
        'authenticated' => $isAuthenticated,
        'session' => $_SESSION,
        'parts' => $parts
    ]);

    if ($isAuthenticated && ($parts[0] === '' || $parts[0] === 'login')) {
        logDebug("Authenticated user accessing login page, redirecting to dashboard");
        header('Location: /dashboard');
        exit;
    }

    if (!$isAuthenticated && !in_array($parts[0], ['', 'login'])) {
        logDebug("Unauthenticated user accessing protected page, redirecting to login");
        header('Location: /login');
        exit;
    }

    switch ($parts[0]) {
        case '':
        case 'login':
            logDebug("Handling login request");
            require __DIR__ . '/../app/controllers/AuthController.php';
            $controller = new AuthController();
            $controller->login();
            break;
        case 'dashboard':
            logDebug("Handling dashboard request");
            if (!$isAuthenticated) {
                logDebug("Unauthenticated user accessing dashboard, redirecting to login");
                header('Location: /login');
                exit;
            }
            require __DIR__ . '/../app/controllers/DashboardController.php';
            $controller = new DashboardController();
            $controller->index(isset($parts[1]) ? $parts[1] : 'home');
            break;
        case 'logout':
            logDebug("Handling logout request");
            require __DIR__ . '/../app/controllers/AuthController.php';
            $controller = new AuthController();
            $controller->logout();
            break;
        default:
            logDebug("404 Not Found", ['request' => $request]);
            http_response_code(404);
            echo "404 Not Found";
            break;
    }
} catch (Exception $e) {
    logDebug('Uncaught exception', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
    http_response_code(500);
    echo "Internal Server Error";
}