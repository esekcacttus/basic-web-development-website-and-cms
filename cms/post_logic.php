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

$title = $_POST['title'];
$description = $_POST['description'];
$image = $_POST['img_link'];
$category = $_POST['category_id'];
$userId = $_SESSION['id'];

$post = [
    'title' => $title,
    'description' => $description,
    'img_link' => $image,
    'category_id' => $category,
    'user_id' => $userId
];
// $test = postsOfCategory(1);
//     echo "<pre>";
//     var_dump(postsOfCategory(1));
//     die();

addPost($post);

echo json_encode([]);

?>