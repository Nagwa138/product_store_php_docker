<?php

namespace App\Models;

use PDO;

class Database {

    public $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=db;dbname=shop", "root", "secret");
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function exists($table, array $attributes): bool
    {
        $attributesName =  array_keys($attributes);
        if(count($attributesName) == 1){
            $attributeName = $attributesName[0];
            $query = "SELECT COUNT(*) as count FROM $table WHERE $attributeName = :$attributeName";
        } else {
            $query = "SELECT COUNT(*) as count FROM $table WHERE ";

            foreach($attributesName as $index => $item)
            {
                $query .= "$item = :$item";
                
                if($index != count($attributesName) -1)
                {
                    $query .= " AND ";
                }
            }
        }

        $result = $this->connection->prepare($query);
        $result->execute($attributes);

        return $result->fetch()['count'] > 0;
    }

    public function create($table, array $data)
    {
        $data['data'] = json_encode($data['data']);

        $attributes = array_keys($data);

        $sql = "INSERT INTO $table (". implode(', ', $attributes) .") VALUES (:". implode(', :', $attributes) .")";

        $result = $this->connection->prepare($sql);

        $result->execute($data);
    }

    public function first($table, $data)
    {
        $attributesName =  array_keys($data);
        if(count($attributesName) == 1){
            $attributeName = $attributesName[0];
            $query = "SELECT * FROM $table WHERE $attributeName = :$attributeName";
        } else {
            $query = "SELECT * FROM $table WHERE ";

            foreach($attributesName as $index => $item)
            {
                $query .= "$item = :$item";
                
                if($index != count($attributesName) -1)
                {
                    $query .= " AND ";
                }
            }
        }

        $query .= ' LIMIT 1';

        $result = $this->connection->prepare($query);
        $result->execute($data);

        return $result;
    }

    public function list($table, $conditions = [])
    {
        $query = "SELECT * FROM $table  ";

        if(count($conditions) != 0)
        {
            $attributesName =  array_keys($conditions);

            if(count($attributesName) == 1){
                $attributeName = $attributesName[0];
                $query = "SELECT * FROM $table WHERE $attributeName = :$attributeName";
            } else {
                $query = "SELECT * FROM $table WHERE ";

                foreach($attributesName as $index => $item)
                {
                    $query .= "$item = :$item";
                    
                    if($index != count($attributesName) -1)
                    {
                        $query .= " AND ";
                    }
                }
            }
        } 

        $query .= " ORDER BY id DESC";
        
        $result = $this->connection->prepare($query);
        $result->execute($conditions);
        return $result->fetchAll();
    }

    public function delete(string $table, array $ids)
    {
        $sql = "DELETE FROM $table WHERE id IN (:ids)";

        $result = $this->connection->prepare($sql);

        $result->execute(['ids' => implode(', ', $ids)]);
    }
}