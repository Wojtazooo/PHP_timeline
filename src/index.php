<?php

$request = rtrim($_SERVER['REQUEST_URI'], '/');
$viewDir = '/views/';

switch ($request) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/categories':
        require __DIR__ . $viewDir . 'categories.php';
        break;

    case '/login':
        require __DIR__ . $viewDir . 'login.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}