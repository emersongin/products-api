<?php

require_once '../config/db.php';

class ProductsRepositories {
    public function index($id) {
        try {
            global $connect;
    
            $connect->beginTransaction();
    
            $sql = 
                "SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.value
                FROM
                    products p
                WHERE
                    p.id = :id";
    
            $result = $connect->prepare($sql);
            $result->execute(['id' => $id]);
        
            $product = $result->fetch(PDO::FETCH_ASSOC);
        
            $connect->commit();
    
            return $product;
        
        } catch(PDOException $erro) {
            $connect->rollback();
    
            echo fail($erro, 500);
            exit;
        }
    }

    public function all() {
        try {
            global $connect;
    
            $connect->beginTransaction();
    
            $sql = 
                "SELECT
                    p.id,
                    p.name,
                    p.description,
                    p.value
                FROM
                    products p";
    
            $result = $connect->prepare($sql);
            $result->execute();
        
            $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
            $connect->commit();
    
            return $products;
        
        } catch(PDOException $erro) {
            $connect->rollback();
    
            echo fail($erro, 500);
            exit;
        }
    }

    public function insert($product) {
        try {
            global $connect;
    
            $connect->beginTransaction();
    
            $sql = 
                "INSERT INTO products
                (
                    name,
                    description,
                    value
                ) VALUES 
                (
                    :name, 
                    :description, 
                    :value
                )";
    
            $result = $connect->prepare($sql);
            $result->execute($product);
        
            $id = $connect->lastInsertId();
        
            $connect->commit();
    
            return $id;
        
        } catch(PDOException $erro) {
            $connect->rollback();
    
            echo fail($erro, 500);
            exit;
        }
    }

    public function update($product) {
        try {
            global $connect;
    
            $connect->beginTransaction();
    
            $sql = 
                "UPDATE 
                    products
                SET
                    name = :name,
                    description = :description, 
                    value = :value
                WHERE
                    id = :id";
    
            $result = $connect->prepare($sql);
            $result->execute($product);
        
            $connect->commit();
    
            return true;
        
        } catch(PDOException $erro) {
            $connect->rollback();
    
            echo fail($erro, 500);
            exit;
        }
    }
    
    public function delete($id) {
        try {
            global $connect;
    
            $connect->beginTransaction();
    
            $sql = "DELETE FROM products WHERE id = :id";
    
            $result = $connect->prepare($sql);
            $result->execute(['id' => $id]);
        
            $connect->commit();
    
            return true;
        
        } catch(PDOException $erro) {
            $connect->rollback();
    
            echo fail($erro, 500);
            exit;
        }
    }

}
