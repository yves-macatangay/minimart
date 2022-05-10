<?php
session_start();

require "connection.php";

function getUser($id) {
    $conn=connection();
    $comm="select * from users where id=$id";

    if($result=$conn->query($comm)){
        return $result->fetch_assoc();
    }else {
        die("Error retrieving user: ".$conn->error);
    }
}

$user = getUser($_SESSION['user_id']);

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
    <?php
        include("mainMenu.php");
    ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="img/<?= $user['photo'] ?>" alt="<?= $_SESSION['fullname'] ?>">
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="custom-file mb-2">
                        <label for="image" class="custom-file-label">Choose Photo</label>
                        <input type="file" name="image" id="image" class="custom-file-input form-control" required>
                    </div>
                    
                    <input type="submit" name="btnUpdatePhoto" value="Update" class="form-control btn btn-outline-secondary">
                </form>
            </div>
            <div class="card-footer border-0 pt-4 fs-4">
                <p class="fw-bold"><?= $user['username'] ?></p>
                <p><?= $_SESSION['fullname'] ?></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dbc5b98639.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
function updatePhoto($id,$image_name,$image_tmp) {
    $conn=connection();
    $comm="update users set photo='$image_name' where id=$id";

    if($conn->query($comm)) {
        $destination = "img/".basename($image_name);
        if(move_uploaded_file($image_tmp,$destination)) {
            header("refresh: 0");

        }else{
            die("Error moving photo: ");

        }
    }else{
        die("Error uploading photo: ".$conn->error);
    }
}

if (isset($_POST['btnUpdatePhoto'])) {
    $id=$_SESSION['user_id'];
    $img_name = $_FILES['image']['name'];
    $img_tmp = $_FILES['image']['tmp_name'];

    updatePhoto($id,$img_name,$img_tmp);
}
?>