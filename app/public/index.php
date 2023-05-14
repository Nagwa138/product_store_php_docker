<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/' :
        require __DIR__ . '/../home.php';
        break;
    case '/add_product' :
        require __DIR__ . '/../add_product.php';
        break;
    default:
    http_response_code(404);
    require __DIR__ . '/../404.php';
    break;
}



