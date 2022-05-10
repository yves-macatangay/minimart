<?php
require "connection.php";

function deleteProduct($id) {
    $conn=connection();
    $comm="delete from products where id=$id";

    if($conn->query($comm)) {
        header("location: products.php");
        exit;
    } else {
        die("Error deleting the product: ".$conn->error);
    }
}

deleteProduct($_GET['id']);
?>