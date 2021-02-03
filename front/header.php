<?php 
    require_once "util.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Rilindja</title>
</head>
<nav>
    <div>
        <img class="logo_img" src="images/rilindjaLogo.svg" />
    </div>
    <ul class="nav-links">
    <?php 
        $categories = getAllCategories();
        foreach ($categories as $category) {
            echo '<li>
                    <a href="categorypage.php?id='.$category['id'].'">'.$category['category_name'].'</a>
                 </li>';
        }
    ?>
    </ul>
</nav>

<body>