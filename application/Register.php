<?php

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
mysqli_query($conn, 'SET NAMES utf8');

$userPhone = $_POST["userPhone"];
$userPassword = $_POST["userPassword"];
$userName = $_POST["userName"];
$userStamps = 0;
$isAdmin = 0;


$statement = mysqli_prepare($conn, "INSERT INTO member VALUES (?, ?, ?, ?, now(), ?)");
mysqli_stmt_bind_param($statement, "sssii", $userPhone, $userPassword, $userName, $userStamps, $isAdmin );
mysqli_stmt_execute($statement);

$response = array();
$response["success"] = true;

echo json_encode($response);

?>