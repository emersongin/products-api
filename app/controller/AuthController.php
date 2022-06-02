<?php 

include_once '../includes/cors.php';
include_once '../includes/functions.php';
include_once '../includes/methods.php';
require_once '../includes/token.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? parseText($_POST['username']) : false;
    $password = isset($_POST['password']) ? parseText($_POST['password']) : false;

    if(!$username || !$password) {
        echo fail('invalid params!', 401);
        exit;
    }

    $login = [
        'username' => 'admin',
        'password' => 'admin',
    ];

    if($username == $login['username'] && $password == $login['password'] ) {
        echo ok(['token' => $_ENV['secret_token']]);
    } else {
        echo fail(false);
    }

    exit;
}

echo fail("metodo {$_SERVER['REQUEST_METHOD']} não disponível.");
exit;
