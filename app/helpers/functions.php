<?php

function logDebug($message, $context = []) {
    $logFile = __DIR__ . '/../../logs/debug.log';
    $timestamp = date('[Y-m-d H:i:s]');
    $contextString = !empty($context) ? json_encode($context, JSON_PRETTY_PRINT) : '';
    $logMessage = "$timestamp $message\n$contextString\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function view($name, $data = []) {
    extract($data);
    $file = __DIR__ . "/../views/{$name}.php";
    if (file_exists($file)) {
        ob_start();
        require $file;
        return ob_get_clean();
    } else {
        logDebug("View file not found", ['file' => $file]);
        throw new Exception("View file not found: {$file}");
    }
}