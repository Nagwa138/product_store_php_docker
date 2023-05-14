<?php

namespace App\Controllers;

use App\Models\Database;

class Controller {

    protected static function getDB(): Database
    {
        return new Database();
    }
}