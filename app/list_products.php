<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\ProductController;

try {
        $result = ProductController::list();
        echo json_encode($result);
    } catch(PDOException $e) {
        return $e->getMessage();
}