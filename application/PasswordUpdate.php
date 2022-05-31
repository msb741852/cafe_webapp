<?php

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
mysqli_query($conn, 'SET NAMES utf8');

$userPhone = $_POST["userPhone"];
$userName = $_POST['userName'];
$userPassword = $_POST["userPassword"];

// $userPhone = '010-1234-1234';
// $userName = '문숩';
// $userPassword = 123;


$statement = mysqli_prepare($conn, "UPDATE member SET password= ?,name=? where phone='{$userPhone}'");
mysqli_stmt_bind_param($statement, 'ss', $userPassword, $userName);
mysqli_stmt_execute($statement);

$response = array();
$response["success"] = true;

echo json_encode($response);

?>