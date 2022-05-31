<?php

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
mysqli_query($conn, 'SET name utf8');

$userPhone = $_POST['userPhone'];
$userPassword = $_POST['userPassword'];

// test용
// $userPhone = '010-1234-1234';
// $userPassword = '123';

$statement = mysqli_prepare($conn, "SELECT * FROM member WHERE phone=? AND password=?");
mysqli_stmt_bind_param($statement, "ss", $userPhone, $userPassword); // 두 번째 인자는 string string 즉, 인자값의 타입을 지정
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $phone, $password, $name, $stamps, $joinDate, $admin); // 쿼리문으로 불러올 값들을 모두 변수처리해야함

$response = array();
$response["success"]= false;

while(mysqli_stmt_fetch($statement)) { 
    $response["success"]= true;
    $response["phone"]= $phone;
    $response["password"]= $password;
    $response["name"]= $name;
    $response["stamps"]= $stamps;
}

echo json_encode($response);
?>