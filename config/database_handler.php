<?php

// PHP SETTINGS
$host = "localhost";
$user = "root";
$pass = "";
$db = "ecommerce";

// MAKE CONNECTION
try {
    $dsn = "mysql:host=$host;dbname=$db;";
    $databaseHandler = new PDO($dsn, $user, $pass);

} catch(PDOException $e) {
    // ON ERROR
    echo "Error! ". $e->getMessage() ."<br />";
    die;
}