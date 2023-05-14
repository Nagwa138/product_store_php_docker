<?php

require_once __DIR__ . "/../vendor/autoload.php";

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/' :
        require __DIR__ . '/../home.php';
        break;
    case '/add_product' :
        require __DIR__ . '/../add_product.php';
        break;
    case '/list_products' :
        require __DIR__ . '/../list_products.php';
        break;
    case '/mass_delete' :
        require __DIR__ . '/../mass_delete_products.php';
        break;
    case '/add_product_back' :
        require __DIR__ . '/../add_product_back.php';
        break;
    default:
    http_response_code(404);
    require __DIR__ . '/../404.php';
    break;
}



