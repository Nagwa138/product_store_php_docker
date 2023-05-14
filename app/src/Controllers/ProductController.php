<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Product;
use App\Requests\ProductCreateRequest;

class ProductController extends Controller {

    const TABLE = 'products';

    public static function add(array $product): array
    {
        $validationResult = (new ProductCreateRequest())->validate($product);

        if( isset($validationResult['success']) && !$validationResult['success']) return $validationResult;

        unset($product['type']);

        if (self::getDB()->exists(self::TABLE, ['sku' => $product['sku']]))
        {
            return [
                'success' => false,
                'message' => 'Sku already exists, choose another one!'
            ];
        }

        self::getDB()->create(self::TABLE, $product);

        return [
            'success' => true,
            'message' => 'Product added successfully!'
        ];
    }

    public static function list()
    {
        return self::getDB()->list(self::TABLE);
    }

    public static function delete(array $ids)
    {
        self::getDB()->delete(self::TABLE, $ids);
    }

    protected static function getDB(): Database
    {
        return new Product();
    }
}