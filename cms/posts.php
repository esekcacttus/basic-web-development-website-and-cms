<?php
    session_start();
    require_once "util.php";
    // if not logged in then redirect to login.php
    if (!isUserLoggedIn()) {
        header("Location: /basic-web-development-website-and-cms/cms/index.php");
        die();
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
    <title>Categories</title>
</head>
<body>
<?php 
    include 'navigation.php';
?>
    <div class="container pt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Post</button>
    </div>
    <div class="container" id="allCategories">
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  onkeyup="validateInputs();" class="add_task" id="add_task" name="add_category">
            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label">Title</label>
                <input type="text" class="form-control " name="title"  id="title" aria-describedby="titleHelp">
                <div id="title_message"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputDescription" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content"  col=4></textarea>
                <div id="content_message"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label">Image Link</label>
                <input type="text" class="form-control " name="image"  id="image" aria-describedby="imageHelp">
                <div id="image_message"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputOption" class="form-label">Category</label>
                <select class="form-select" name="category" id="category" aria-label="Default select example">
                <?php  
                    $categories = getAllCategories();
                ?>
                <?php 
                    foreach($categories as $category){
                        ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="save_category" onclick="storePost();">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <br/>
<div class="container">
    <ul class=" border border-secondary col-10 list-group list-group-horizontal d-flex justify-content-between">
    <li class="list-group-item border-0">Title</li>
    <li class="list-group-item border-0 ">Action</li>
    </ul>
</div>
<div class="container mt-2">
    <ul class=" border border-secondary col-10 list-group list-group-horizontal d-flex justify-content-between">
    <li class="list-group-item border-0 ">Lajme</li>
    <li class="list-group-item border-0 ">
        <button type="button" class="btn btn-primary p-1 " id="btnEdit">Edit</button>
        <button type="button" class="btn btn-danger p-1 ms-1" id="btnDelete">Delete</button>      
    </li>
    
    </ul>
</div>

</body>
    <script src="index.js"></script>
</html>