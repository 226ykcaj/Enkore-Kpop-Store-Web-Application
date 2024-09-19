<?php
include ("dbh.php");

$sqlToSelectProduct = "SELECT * FROM products WHERE productId = '$productId'";

$result = mysqli_query($conn, $sqlToSelectProduct);

if(!$result){
    die("Fail to retrieve product data: " . mysqli_error($conn));
}
if(mysqli_num_rows($result)){
    $product = mysqli_fetch_assoc($result);
}

mysqli_free_result($result);

mysqli_close($conn);