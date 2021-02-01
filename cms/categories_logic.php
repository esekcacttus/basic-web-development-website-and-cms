<?php
session_start();
require_once "util.php";

header("Content-Type: application/json");

$response = [
    'success'=> false,
    'message' => 'user.not.authenticated'
];

// if logged in then redirect to timeline.php
if (!isUserLoggedIn()) {
    echo json_encode($response);
    die();
}

$categoryName = $_POST['category_name'];
$categoryCareated = storeCategoryToDB($categoryName);

$response['success'] = $categoryCareated;
$response['message'] = "category".($categoryCareated?"":".not.").".created";
echo json_encode($response);
die();
?>