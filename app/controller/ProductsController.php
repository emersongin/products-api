<?php

include_once '../includes/functions.php';
include_once '../includes/methods.php';
include_once '../models/Product.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = isset($_GET['id']) ? parseInt($_GET['id']) : false;
    $product = new Product(['id' => $id]);

    if($id) {
        $result = $product->findID();
    } else {
        $result = $product->findAll();
    }

    echo ok($result);
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? parseText($_POST['name']) : false;
    $description = isset($_POST['description']) ? parseText($_POST['description']) : false;
    $value = isset($_POST['value']) ? parseNumeric($_POST['value']) : false;

    if(!$name || !$description || !$value) {
        echo fail('invalid params!', 401);
        exit;
    }

    $product = new Product([
        'name' => $name,
        'description' => $description,
        'value' => $value,
    ]);

    $result = $product->save();

    echo ok($result);
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $id = isset($_PUT['id']) ? parseInt($_PUT['id']) : false;
    $name = isset($_PUT['name']) ? parseText($_PUT['name']) : false;
    $description = isset($_PUT['description']) ? parseText($_PUT['description']) : false;
    $value = isset($_PUT['value']) ? parseNumeric($_PUT['value']) : false;

    if(!$id || !$name || !$description || !$value) {
        echo fail("invalid params!", 401);
        exit;
    }

    $product = new Product([
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'value' => $value,
    ]);

    $result = $product->save();

    echo ok($result);
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = isset($_DELETE['id']) ? parseInt($_DELETE['id']) : false;
    $product = new Product(['id' => $id]);

    if(!$id) {
        echo fail('invalid id!', 401);
        exit;
    } else{
        $result = $result = $product->destroy();
    }

    echo ok($result);
    exit;
}

echo fail("metodo {$_SERVER['REQUEST_METHOD']} não disponível.");
exit;
