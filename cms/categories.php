<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>Categories</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Category</button>
    </div>
    <div class="container" id="allCategories">
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="add_task" id="add_task" name="add_category">
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label">Category Name:</label>
                            <input type="text" class="form-control " name="category_name" id="category_name" aria-describedby="titleHelp" />
                            <div id="title_message"></div>
                        </div>
                        <button type="button" class="btn btn-primary" id="save_category">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="container">
        <ul class=" border border-secondary col-10 list-group list-group-horizontal d-flex justify-content-between">
            <li class="list-group-item border-0">Category Name</li>
            <li class="list-group-item border-0 ">Total Posts</li>
            <li class="list-group-item border-0 ">Action</li>
        </ul>
    </div>
    <div class="container mt-2">
        <ul class=" border border-secondary col-10 list-group list-group-horizontal d-flex justify-content-between">
            <li class="list-group-item border-0 ">Lajme</li>
            <li class="list-group-item border-0 ">10</li>
            <li class="list-group-item border-0 ">
                <button type="button" class="btn btn-primary p-1 " id="btnEdit">Edit</button>
                <button type="button" class="btn btn-danger p-1 ms-1" id="btnDelete">Delete</button>
            </li>

        </ul>
    </div>

</body>
<script>

</script>

</html>