<?php
include ("dbh.php");
// to select the best selling products
$sqlToSelectProduct = "SELECT * FROM products WHERE productId = 1 OR productId = 3 OR productId = 4 OR productId = 5 OR productId = 7 OR productId = 8 OR productId = 9 OR productId = 10;";

$result = mysqli_query($conn, $sqlToSelectProduct);

if(!$result){
    die("Fail to retrieve products data: " . mysqli_error($conn));
}

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (count($products) <= 0) {
    die("product is null");
}

mysqli_free_result($result);

mysqli_close($conn);