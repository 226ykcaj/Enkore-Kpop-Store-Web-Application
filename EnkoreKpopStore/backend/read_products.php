<?php
// to connect to db
include ("backend/dbh.php");
// to reassign category Id to access the page after popping up msg
if(isset($_GET['categoryId'])){
    $categoryId = $_GET['categoryId'];
    $_SESSION['categoryId'] = $categoryId;
}else if(!isset($_GET['categoryId'])){
    $categoryId = $_SESSION['categoryId'];
}

$sqlToSelectProduct = "SELECT * FROM products WHERE categoryId = '$categoryId'";

$result = mysqli_query($conn, $sqlToSelectProduct);

if(!$result){
    die("Fail to retrieve products data: " . mysqli_error($conn));
}

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(count($products)<=0){
    die("Fail to retrieve products using category ID:".mysqli_error($conn));
}

mysqli_free_result($result);