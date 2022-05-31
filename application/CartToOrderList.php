<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = mysqli_connect("localhost","capston","20184163", "capston_opete");

$userPhone = $_POST['userPhone'];
$menuName = $_POST['menuName'];
$menuNum = $_POST['menuNum'];
$couponId = $_POST['couponId'];





// 오더리스트 오더넘 가져오기
$sql = "SELECT orderNum,orderTime FROM ordercheck ORDER BY orderNum DESC limit 1"; 
$sql_time = "SELECT NOW()";

$result = mysqli_query($conn, $sql);
$result_time = mysqli_query($conn, $sql_time);

$new_time = mysqli_fetch_array($result_time)[0];
while($row = mysqli_fetch_array($result)){
    $time = $row[1];
    $orderNum = $row[0];
};

if ($time !== $new_time) {
    $orderNum = $orderNum +1;
} 

// 카트에서 오더리스트로 추가하기

if($couponId !== "null") {
    $sql_toOrder = "INSERT INTO ordercheck (orderNum, list_Menu, menuNum, paymentMethod, phone, couponIdx)  VALUES ('$orderNum', '$menuName', '$menuNum', '현장결제', '$userPhone', '$couponId')";
    
} else {
    $sql_toOrder = "INSERT INTO ordercheck (orderNum, list_Menu, menuNum, paymentMethod, phone)  VALUES ('$orderNum', '$menuName', '$menuNum', '현장결제', '$userPhone')";
}
$sql_stamp = "UPDATE member SET stamps = stamps + '$menuNum' WHERE phone = '$userPhone'";
mysqli_query($conn, $sql_stamp);

mysqli_query($conn, $sql_toOrder);


?>