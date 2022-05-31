<?php

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
mysqli_query($conn, 'SET name utf8');

$userStamps = $_POST['userStamps'];
$userPhone = $_POST['userPhone'];

if($userStamps >= 8) {
    $sql = "UPDATE member SET stamps=stamps-8 WHERE phone='{$userPhone}'";
    mysqli_query($conn, $sql);
    mysqli_query($conn , "INSERT  into usercoupon(userPhone , userCouponId) values ('$userPhone' , '1')");

    $statement = mysqli_prepare($conn, "SELECT stamps FROM member WHERE phone=?");

    mysqli_stmt_bind_param($statement, "s", $userPhone); // 두 번째 인자는 string string 즉, 인자값의 타입을 지정
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $stamps); // 쿼리문으로 불러올 값들을 모두 변수처리해야함

    $response = array();
    $response["success"]= false;

    while(mysqli_stmt_fetch($statement)) { 
        $response["success"]= true;
        $response["stamps"]= $stamps;
    }
}  else {
    $response = array();
    $response["success"]= false;
}


echo json_encode($response);
?>