<?php

    require_once 'db.php';

    function isUserLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    function doesUserExistByEmail($email){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `users` WHERE email = :email";
        
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":email", $email);
    
        if($statement->execute()){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user !== false){
            return true;
            }
        }else{
            return false;
        }
    
    }

    function findUserByEmailAndPassword($email, $password){
        global $dbConnection;
    
        $sqlQuery = "SELECT * FROM users WHERE email = :email AND password = :password";
        
        $encryptedPassword = md5($password);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $encryptedPassword);

        if($statement->execute()){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user != false){
                return $user;
            }
        }
        return null;
    }
     
    function addUser(array $user){
       global $dbConnection;
        $sqlQuery = " INSERT INTO `users` (`full_name`, `email`, `password`)
        VALUES (:fullName, :email, :password); ";

        $encryptedPassword = md5($user['password']);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":fullName", $user['full_name']);
        $statement->bindParam(":email", $user['email']);
        $statement->bindParam(":password", $encryptedPassword);
        
        if($statement->execute()){
            return true;
        }else{
            echo "Wrong!"; 
            die();
            return false;
        }
    }

    function signOut(){
        session_start();
        session_destroy();
    }

    function addCategory(array $category){
        global $dbConnection;
        $sqlQuery = "INSERT INTO `category` (`category_name`)
        VALUES (:category_name); ";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":category_name", $category['category_name']);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    //add post function
    function addPost(array $post){
        global $dbConnection;
        $sqlQuery = "INSERT INTO `posts` (`title`, `description`, `user_id`, `img_link`, `category_id`)
        VALUES(:title, :description, :user_id, :img_link, :category_id);";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":title", $post['title']);
        $statement->bindParam(":description", $post['description']);
        $statement->bindParam(":user_id", $post['user_id']);
        $statement->bindParam(":img_link", $post['img_link']);
        $statement->bindParam(":category_id", $post['category_id']);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function getUserTasks($userId) {
        global $dbConnection;

        $sqlQuery = "SELECT `tasks`.*, `users`.full_name FROM `tasks` JOIN `users` ON `tasks`.`id_user`=`users`.id_user WHERE `users`.id_user = :userId ORDER BY created_at DESC";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":userId", $userId);
        
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
        
    }

    function getAllCategories() {
        global $dbConnection;
        $sqlQuery = "SELECT *, (SELECT COUNT(*) FROM posts WHERE category_id=`category`.id) as total_posts FROM `category`";
        $statement = $dbConnection->prepare($sqlQuery);
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
        
    }

    function loadCategoryPosts($category_id){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `posts` WHERE category_id =:category_id";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":category_id", $category_id);
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
        
    }

    function getAllPosts(){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `posts`;";
        $statement = $dbConnection->prepare($sqlQuery);
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
        
    }

    function deleteTaskById($id_task, $id_user){
        global $dbConnection;

        $sqlQuery = "DELETE FROM `tasks` WHERE `id_task`=:id_task and `id_user`=:id_user;";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":id_task", $id_task);
        $statement->bindParam(":id_user", $id_user);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }

    }

    function updateTask($status, $id_task, $id_user){
        global $dbConnection;
        $sqlQuery = "UPDATE `tasks` SET `status`=:status WHERE `id_task`=:id_task AND `id_user`=:id_user;";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":status", $status);
        $statement->bindParam(":id_task", $id_task);
        $statement->bindParam(":id_user", $id_user);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function postsOfCategory($id_category){
        global $dbConnection;
        $totalPosts = 0;
        $sqlQuery = "SELECT COUNT(category_id) FROM posts WHERE category_id=:category_id;";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":category_id", $id_category);
        if($statement->execute()){
            $totalPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $totalPosts[0];
        }else{
            return false;
        }
    }


    function checkPassword($password) { 
        $passwordTemplate = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/';
        if($password.preg_match($passwordTemplate, $passwordTemplate)) { 
            return true;
        }
        else{ 
            return false;
        }
    }



?>