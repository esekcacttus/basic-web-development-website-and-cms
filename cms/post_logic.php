<?php
session_start();
require_once "util.php";
header('Content-Type: application/json');


    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode([
            'success' => false,
            'message' => 'POST Method HTTP required'
        ]);

    }
    if (!isUserLoggedIn()) {
        echo json_encode([
            'success' => false,
            'message' => 'User must be logged in'
        ]);
        die();
    }

$post = $_POST['category_name'];
$userId = $_SESSION['id'];

$post = [
    'category_name' => $category_name
];

    // echo "<pre>";
    // var_dump($category);
    // die();


addCategory($category);
echo json_encode([]);

?>