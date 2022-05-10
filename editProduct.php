<?php
require "connection.php";

function getProduct($id) {
    $conn=connection();
    $sql = "select * from products where id=$id";

    if($result=$conn->query($sql)) {
        return $result->fetch_assoc();
    }else{
        die("Error retrieving product: ".$conn->error);
    }
}

function getSections(){
    $conn = connection();
    $sql = "SELECT * FROM sections";

    if ($result=$conn->query($sql)) 
        return $result;
    else
        die("Error retrieving sections: ".$conn->error);
}

$prod = getProduct($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="py-5">
        <form action="" method="post" class="card mx-auto mb-5" style="width:25em">
            <div class="card-header bg-secondary text-light">
                <p class="h2">Edit Product Details</p>
            </div>
            <div class="card-body">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $prod['title'] ?>" required>
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control" required ><?= $prod['description'] ?></textarea>
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="price" id="price" class="form-control" required value="<?= $prod['price'] ?>">
                </div>
                <label for="section" class="form-label">Section</label>
                <select name="section_id" id="section" class="form-control">
                <?php
                    $sections = getSections();
                    while($row = $sections->fetch_assoc()) {
                        if($row['id']==$prod['id'])
                            echo "<option value='".$row['id']."' selected>".$row['title']."</option>";
                        else
                            echo "<option value='".$row['id']."'>".$row['title']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="card-footer border-0">
                <a href="" class="btn btn-outline-secondary">Cancel</a>
                <input type="submit" value="Save" name="btnSave" class="btn btn-secondary px-5">
            </div>
        </form>
    </div>

<script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
    function updateProduct($id,$title,$desc,$price,$section_id){
        $conn=connection();
        $comm = "update products set title='$title',
            description='$desc',
            price=$price,
            section_id=$section_id
            where id=$id";

        if($conn->query($comm)) {
            header("location: products.php");
            exit;
            //echo "ok";
        }else {
            die("Error updating product: ".$conn->error);
        }
    }

    if(isset($_POST['btnSave'])) {
        updateProduct($_GET['id'],$_POST['title'],
        $_POST['description'],$_POST['price'],$_POST['section_id']);
    }
?>