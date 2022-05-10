<?php
session_start();

require "connection.php";

function getSections(){
    $conn = connection();
    $sql = "SELECT * FROM sections";

    if ($result=$conn->query($sql)) 
        return $result;
    else
        die("Error retrieving sections: ".$conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
        include('mainMenu.php');
    ?>
    <div class="py-5">
        <form action="" method="post" class="card mx-auto mb-5" style="width:25em">
            <div class="card-header bg-success text-light">
                <p class="h2">Add New Product</p>
            </div>
            <div class="card-body">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="price" id="price" class="form-control">
                </div>
                <label for="section" class="form-label">Section</label>
                <select name="section_id" id="section" class="form-control">
                <?php
                    $sections = getSections();
                    while($row = $sections->fetch_assoc()) 
                        echo "<option value='".$row['id']."'>".$row['title']."</option>";
                ?>
                </select>
            </div>
            <div class="card-footer border-0">
                <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                <input type="submit" value="Add" name="btnAdd" class="btn bg-success px-5">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
    function createProduct($title,$desc,$price,$section_id){
        $conn = connection();
        $sql = "insert into products(`title`,`description`,`price`,`section_id`)
            values('$title','$desc',$price,$section_id)";
    
        if($conn->query($sql)) {
            header("location: products.php");
            exit;
            //echo "ok";
        } else {
            die("Error adding new product: ".$conn->error);
        }
    }

    if(isset($_POST['btnAdd'])) {
        
        createProduct($_POST['title'],$_POST['description'],
            $_POST['price'],$_POST['section_id']);
    }
?>