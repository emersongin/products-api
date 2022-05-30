<?php

require_once '../includes/token.php';

session_start();

$auth_token = (
    isset($headers['Authorization']) ? $headers['Authorization'] : (
    isset($_SESSION['token']) ? $_SESSION['token'] : (
    isset($_POST['token']) ? $_POST['token'] : (
    isset($_GET['token']) ? $_GET['token'] : ''))));


if($auth_token !== $_ENV['secret_token']) {
    echo 'invalid token!';
    exit;
} 
