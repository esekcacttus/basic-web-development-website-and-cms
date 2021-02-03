<?php

    require_once 'db.php';

    function getAllCategories() {
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `category`";
        $statement = $dbConnection->prepare($sqlQuery);
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
    }

    function getPostsByCategoryId($categoryId){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `posts` WHERE category_id=:categoryId";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":categoryId", $categoryId);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    function getPostById($postId){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `posts` WHERE id=:id";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":id", $postId);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }


?>