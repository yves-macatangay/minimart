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
            <div class="card-header text-success">
                <p class="h3">Create your account</p>
            </div>
            <div class="card-body">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control">
                
                <label for="username" class="form-label fw-bold">Username</label>
                <input type="text" name="username" id="username" class="form-control">
                
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <label for="password_c" class="form-label">Confirm Password</label>
                <input type="password" name="password_c" id="password_c" class="form-control">
            </div>
            <div class="card-footer border-0 bg-light">
                <input type="submit" value="Sign up" name="btnSignup" class="form-control bg-success text-light">
                <p class="fs-6 text-center">Already have an account? <a href="login.php">Log in</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>

<?php
require "connection.php";

function createUser($firstname,$lastname,$username,$password) {
    $conn=connection();

    $password=password_hash($password,PASSWORD_DEFAULT);
    $comm = "insert into users(first_name,last_name,username,password)
         values('$firstname','$lastname','$username','$password')";

    if($conn->query($comm)) {
        header("location: login.php");
        exit;
        //echo "ok";
    }else {
        die("Error adding new user: ".$conn->error);
    }
}

if(isset($_POST['btnSignup'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $confirm = $_POST['password_c'];

    if($pword==$confirm) {
        createUser($fname,$lname,$uname,$pword);
    }else{
        echo "<p class='text-danger'>Passwords do not match</p>";
    }
}

?>