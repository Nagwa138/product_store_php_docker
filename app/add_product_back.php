<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\ProductController;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $receivedData = (array) json_decode(file_get_contents("php://input"));

    $data = array_filter($receivedData, function($key){
        return in_array($key, ['sku', 'price', 'name', 'type']);
    }, ARRAY_FILTER_USE_KEY);

    $data['data'] = $receivedData['attributes'];

    try {
        $result = ProductController::add($data);
        echo json_encode($result);
    } catch(PDOException $e) {
        return $e->getMessage();
    }
} else {
    return 'Can not access';
}