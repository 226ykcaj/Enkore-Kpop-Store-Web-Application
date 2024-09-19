<?php
include("dbh.php");
$payment_status = "Paid";
// to assign variable with userid session if the userid session is not null, assign it with an empty string if the userid session is null
$userId = isset($_SESSION['userid'])?$_SESSION['userid']:"";
// select the paid products from the cart
$result = $conn->query("SELECT * FROM cart WHERE payment_status = '$payment_status' AND usersId = '$userId';");

if(!$result){
    die("Fail to retrieve purchase history: " . $conn->error);
}else{
    $history = $result->fetch_all(MYSQLI_ASSOC);
}

$result->free();
$conn->close();