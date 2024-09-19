<?php 
include ("backend/dbh.php");
// to assign variable with userid session if the userid session is not null, assign it with an empty string if the userid session is null
$userId = isset($_SESSION['userid'])?$_SESSION['userid']:"";

$result = mysqli_query($conn, "SELECT * FROM users WHERE usersId = '$userId';");
if(!$result){
    die("Fail to retrieve users data:" . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0){
    $user = mysqli_fetch_assoc($result);
}

mysqli_close($conn);
mysqli_free_result($result);