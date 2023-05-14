<?php

namespace App\Requests;

use App\Models\Database;

abstract class BaseRequest {
    
    abstract protected function rules(array $data);

    public function validate(array $data)
    {
        foreach($this->rules($data) as $item){
            $result = $this->validateInput($item);
            if(!$result['success']) return $result;
        }
    }

    protected function validateInput($item)
    {
        return [
            'success' => !$item['rule'],
            'message' => $item['rule']? $item['message'] : ''
        ];
    }

    protected function getDB()
    {
        return new Database();
    }
}