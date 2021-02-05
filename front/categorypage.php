<?php include_once "header.php"; ?>
<?php include_once "util.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../front/style.css">
</head>
<body>
<?php 

$categoryId = $_GET["id"];

$category = getCategoryById($categoryId);

$posts = getPostsByCategoryId($categoryId);


?>
    <div class="container-fluid">
        <h3 class="text-left category_name"><?php echo $category["category_name"]?></h3>
    <div class="news_photos_title">
    <?php
        foreach($posts as $post){
    ?>
    <div>
        <img src="<?php echo $post["img_link"]  ?>" alt="foto vaksina" width="200px" height="150px" class="img-fluid" >
        <h4 class="text-center" ><?php echo $post["title"]  ?></h4>
    </div>
    <?php 
        }
    ?>

    </div>



    <div class="other_news">
    <?php
        foreach($posts as $post){
    ?>

        <img src="<?php echo $post["img_link"]  ?>" alt="foto vaksina" width="100px" height="100px">
        <h2><?php echo $post["title"]  ?></h2>
    </div>
    <?php 
        }
    ?> 
  

    
    
</body>


</html>