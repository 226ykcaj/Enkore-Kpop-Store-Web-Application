<?php

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    // to connect to database
    require_once 'dbh.php';
    // access user-defined functions
    require_once 'functions.php';
    // check if the input is empty
    if(emptyInput($email, $pwd) !== false){
        header("location:../account.php?error=Fill in all fields");
        exit();
    }
    // check if the email already exists
    if(emailExists($conn, $email) !== false){
        header("location:../account.php?error=This email is taken");
        exit();
    }
    // create the user
    createUser($conn, $email, $pwd);
}else{
    // prompt user back to account page to register in a proper way
    header("location:../account.php");
}