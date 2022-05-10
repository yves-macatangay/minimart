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
    <div class="container py-5" style="width:25em">
    <form action="" class="card" method="post">
        <div class="card-header text-primary">
            <h3 class="h3">MiniMart Catalog</h3>
        </div>
        <div class="card-body">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="card-footer border-0 text-center">
            <input type="submit" name="btnLogin" value="Log in" class="form-control btn btn-primary mb-3">
            <a href="signUp.php" class="text-decoration-none text-center">Create account</a>
        </div>
    </form>

    </div>
</body>
</html>

<?php

require "connection.php";

function login($username,$password) {
    $conn= connection();
    $comm="select * from users where username='$username'";
    
    $result=$conn->query($comm);

    if($result->num_rows==1) {
        $user = $result->fetch_assoc();
        if(password_verify($password,$user['password'])){
            session_start();

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] =$user['username'];
            $_SESSION['fullname'] =$user['first_name']." ".$user['last_name'];

            header("location: products.php");
            exit;
        } else {
            echo "<p class='text-danger'>Password incorrect.</p>";
        }
    }else {
        echo "<p class='text-danger'>Username not found.</p>";
    }
}

if(isset($_POST['btnLogin'])) {
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    login($uname,$pword);
}
?>