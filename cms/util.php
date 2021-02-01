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

    function addNewTask(array $task, $userId){
        global $dbConnection;
        $sqlQuery = "INSERT INTO `tasks` (`title`,`description`,`status`, `id_user`)
        VALUES (:title, :description, :status, :userId); ";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":title", $task['title']);
        $statement->bindParam(":description", $task['description']);
        $statement->bindParam(":status", $task['status']);
        $statement->bindParam(":userId", $userId);

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