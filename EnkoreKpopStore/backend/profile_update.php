<?php
// connect to db
include ("dbh.php");
// start session
include("session_config.php");
$userid = $_SESSION['userid'];
// get the details posted
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$pwd = $_POST['pwd'];
$phone = $_POST['phone'];

$stmt = mysqli_prepare($conn, 'UPDATE users SET usersname = ?, usersEmail = ?, address = ?, usersPhone = ?, usersPassword = ? WHERE usersId = ?');
// to hash the pwd
$hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $address, $phone, $hashedpwd, $userid);
if(!mysqli_stmt_execute($stmt)){
    die("Fail to update user info:" . mysqli_error($conn));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
// prompt user to index page after successfully updating details
header("Location:../index.php");
exit();