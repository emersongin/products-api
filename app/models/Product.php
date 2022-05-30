<?php

require_once '../repositories/ProductsRepositories.php';

class Product {
    private $id = 0;
    private $name = '';
    private $description = '';
    private $value = 0.0;

    function __construct($product) {
        $this->repository = new ProductsRepositories();

        $this->id    = isset($product['id']) ? $product['id'] : null;
        $this->name  = isset($product['name']) ? $product['name'] : null;
        $this->description = isset($product['description']) ? $product['description'] : null;
        $this->value = isset($product['value']) ? $product['value'] : null;

    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function findID($id = null) {
        $id = $id ? $id : $this->getID();

        if($id) {
            $product = $this->repository->index($id);

            if(!$product) return false;

            return $product;
        } else {
            return false;
        }
    }

    public function findAll() {
        $products = $this->repository->all();

        if(is_array($products) && count($products)) {

            return array_map(function($product) { 
                return $product; 
            }, $products);
        } else {
            return [];
        }
    }

    public function save() {
        if($this->findID($this->getID())) {
            $product = [
                'id' => $this->getID(),
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'value' => $this->getValue(),
            ];

            return $this->repository->update($product);
        } else {
            $product = [
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'value' => $this->getValue(),
            ];

            return $this->repository->insert($product);
        }
    }

    public function destroy($id = null) {
        $id = $id ? $id : $this->getID();

        if($id) {
            return $this->repository->delete($id);
        } else {
            return false;
        }
    }
}
