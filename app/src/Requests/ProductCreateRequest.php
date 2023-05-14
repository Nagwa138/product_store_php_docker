<?php

namespace App\Requests;

class ProductCreateRequest extends BaseRequest {

    protected function rules(array $product): array
    {
        return [
            [
                'rule' => strlen($product['sku']) < 1,
                'message' => 'Sku is required'
            ],
            [
                'rule' => strlen($product['sku']) > 191,
                'message' => 'sku maximum length is 191 character'
            ],
            [
                'rule' => strlen($product['name']) < 1,
                'message' => 'Name is required'
            ],
            [
                'rule' => strlen($product['name']) > 191,
                'message' => 'Name maximum length is 191 character'
            ],
            [
                'rule' => $product['price'] < 1,
                'message' => 'Price can not equal to Zero'
            ],
            [
                'rule' => ($product['type'] == 'DVD') && ($product['data']->size < 1),
                'message' => 'Size can not equal to Zero'
            ],
            [
                'rule' => ($product['type'] == 'Book') && ($product['data']->weight < 1),
                'message' => 'Weight can not equal to Zero'
            ],
            [
                'rule' => ($product['type'] == 'Furniture') && ($product['data']->height < 1),
                'message' => 'Height can not equal to Zero'
            ],
            [
                'rule' => ($product['type'] == 'Furniture') && ($product['data']->width < 1),
                'message' => 'Width can not equal to Zero'
            ],
            [
                'rule' => ($product['type'] == 'Furniture') && ($product['data']->length < 1),
                'message' => 'Length can not equal to Zero'
            ],
        ];
    }
}