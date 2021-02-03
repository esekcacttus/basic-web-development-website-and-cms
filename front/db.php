<?php
// define connectoin variables
$host   = "localhost"; // 127.0.0.1
$user       = "root";
$password   = "";
$dbName     = "portali";
$port = 3308;

// create connection
$dbConnection = null;
try {
    $dbConnection = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbName, $user, $password);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    exit();
}
if (!$dbConnection) {
    echo "No database connection!";
    die();
}
?>