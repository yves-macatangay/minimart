<?php
session_start();
    require('connection.php');
    function getProducts(){
        $conn = connection();

        $query = "select p.id, p.title, p.description, p.price, s.title as section
                from products p inner join sections s on s.id=p.section_id
                order by p.id ";

            if ($result=$conn->query($query)) 
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include('mainMenu.php'); ?>
<div class="container py-5">
    <a href="sections.php" class="btn btn-outline-info float-end"><i class="fa-solid fa-circle-plus"></i>Add New Section</a>
    <a href="addProduct.php" class="btn btn-success float-end"><i class="fa-solid fa-circle-plus"></i>Add New Product</a>
    
    <p class="h3">Product List</p>

    <table class="table table-bordered">
        <thead class="table-secondary">
            <th>#</th>
            <th>TITLE</th>
            <th>DESCRIPTION</th>
            <th>PRICE</th>
            <th>SECTION</th>
            <th style="width:6em;">&nbsp;</th>
        </thead>
        <tbody>
            <?php
                $prods = getProducts();
                while($prod = $prods->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$prod['id']."</td>";
                    echo "<td>".$prod['title']."</td>";
                    echo "<td>".$prod['description']."</td>";
                    echo "<td>".$prod['price']."</td>";
                    echo "<td>".$prod['section']."</td>";
                    echo "<td><a href='editProduct.php?id=".$prod['id']."' class='btn btn-outline-secondary btn-sm'><i class='fa-solid fa-pen'></i></a>";
                    echo "<a href='removeProduct.php?id=".$prod['id']."' class='btn btn-outline-danger btn-sm ms-1'><i class='fa-solid fa-trash'></i></a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>
</body>
</html>