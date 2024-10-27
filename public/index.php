<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/helpers/functions.php';

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

if ($isAuthenticated && in_array($parts[0], ['', 'login'])) {
    logDebug("Authenticated user accessing login page, redirecting to dashboard");
    header('Location: /dashboard');
    exit;
}

if (!$isAuthenticated && !in_array($parts[0], ['', 'login'])) {
    logDebug("Unauthenticated user accessing protected page, redirecting to login");
    header('Location: /login');
    exit;
}

$controller = null;
$action = 'index';

switch ($parts[0]) {
    case '':
    case 'login':
        $controller = 'Auth';
        $action = 'login';
        break;
    case 'dashboard':
        $controller = 'Dashboard';
        $action = isset($parts[1]) ? $parts[1] : 'index';
        break;
    case 'logout':
        $controller = 'Auth';
        $action = 'logout';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        exit;
}

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . "/../app/controllers/{$controllerName}.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerInstance = new $controllerName();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        logDebug("Action not found", ['controller' => $controllerName, 'action' => $action]);
        http_response_code(404);
        echo "404 Not Found";
    }
} else {
    logDebug("Controller not found", ['controller' => $controllerName]);
    http_response_code(404);
    echo "404 Not Found";
}