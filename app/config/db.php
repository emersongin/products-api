<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "products_api";

try {
    $GLOBALS['connect'] = new PDO("mysql:host={$servername};dbname={$database}", $username, $password);
    $GLOBALS['connect']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();

}
