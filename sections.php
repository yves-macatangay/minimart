<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
        session_start();
        include('mainMenu.php');
    ?>
    <div class="py-5">
    <form action="" method="post" class="card mx-auto mb-5" style="width:25em">
        <div class="card-header bg-info text-light">
            <p class="h2">Add New Section</p>
        </div>
        <div class="card-body">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="card-footer border-0">
            <div class="container p-0">
                <div class="row">
                    <div class="col-3">
                        <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                    <div class="col-4">
                        <input type="submit" value="Add" name="btnAdd" class="form-control bg-info text-light">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
    require "connection.php";

    if(isset($_POST['btnAdd'])) {
        $title = $_POST['title'];
        createSection($title);
    }

    

    function createSection($title) {
        $conn = connection();

        $sql= "INSERT INTO `sections` (`title`) VALUE ('$title')";

        if ($conn->query($sql)) {
            header("refresh: 0");
        } else {
            die("Error adding new product section: ".$conn->error);
        }
    }
?>