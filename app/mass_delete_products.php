<?php

use App\Controllers\ProductController;

try {
    $ids = (array) json_decode(file_get_contents("php://input"));
    $data = ProductController::delete($ids);
    echo 'Deleted successfully!';
} catch(PDOException $e) {
    return $e->getMessage();
}