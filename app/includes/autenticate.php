<?php

require_once '../includes/token.php';

session_start();

$auth_token = (
    isset($_SESSION['token']) ? $_SESSION['token'] : (
    isset($_GET['token']) ? $_GET['token'] : (
    isset($_POST['token']) ? $_POST['token'] : (
    isset($_PUT['token']) ? $_PUT['token'] : (
    isset($_DELETE['token']) ? $_DELETE['token'] : '')))));


if($auth_token !== $_ENV['secret_token']) {
    echo 'invalid token!';
    exit;
} 
