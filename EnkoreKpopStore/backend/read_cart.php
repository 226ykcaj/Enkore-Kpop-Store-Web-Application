<?php
include ("dbh.php");
// to check if userid exists, if no assign empty string
$userId = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$payment_status = "Unpaid";
$result = mysqli_query($conn, "SELECT * FROM cart WHERE usersId = '$userId' AND payment_status = '$payment_status';");

if(!$result){
    die("Fail to retreive cart products:" . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0){
    $cart = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

mysqli_close($conn);