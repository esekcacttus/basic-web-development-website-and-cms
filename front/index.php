<?php include 'header.php';?>

<?php
    foreach($categories as $category){
        
        $categoryPosts = getPostsByCategoryId($category['id']);
        if(empty($categoryPosts)){
            continue;
        }
?>
    <h1 class="category_title"><?php echo $category['category_name'] ?></h1>

    <div class="container">
    <?php
        foreach($categoryPosts as $post){
    ?>
        <div class="article">
            <img class="card_image" src="<?php echo $post['img_link'] ?>"></img>
            <h3><?php echo $post['title'] ?></h3>
            <p><?php echo $post['description'] ?> </p>
            <a href="single_page.php?id=<?php echo $post['category_id']?>">Read more...</a>
        </div>
        
    <?php } ?>
    </div>
<?php
}
include "footer.php"
?>