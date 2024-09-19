<?php

if(isset($_POST["submit"])){
    $email=$_POST["email"];
    $pwd=$_POST["pwd"];
    // to connect to db
    require_once "dbh.php";
    // to access user-defined functions
    require_once "functions.php";
    // to check if the input is empty
    if(emptyInput($email, $pwd)!==false){
        header("location:../account.php?error=Fill in all fields");
        exit();
    }   
    // to login the user
    loginUser($conn, $email, $pwd);
    
}else{
    // prompt user back to account page to login in a proper way
    header("location:../account.php");
}