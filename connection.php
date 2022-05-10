<?php
function connection(){
    $server_name="localhost";
    $username="root";
    $password="";
    $db_name="minimart_catalog";

    //create a connection
    $conn = new mysqli($server_name, $username, $password, $db_name);

    //check connection
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }else {
        return $conn;
    }
    }

?>