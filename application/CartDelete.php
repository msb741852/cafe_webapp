<?php
header('Content-Type: text/html; charset=UTF-8');
$userPhone = $_POST['userPhone'];
$idx = $_POST['idx'];

$conn = mysqli_connect("localhost","capston","20184163", "capston_opete");
$sql_del = "DELETE FROM cart where cart_owner = '$userPhone'";
mysqli_query($conn, $sql_del);

if($idx !== "null") {
    $sql_coupon = "UPDATE usercoupon SET used = '사용완료' WHERE idx = '$idx'";
    mysqli_query($conn, $sql_coupon);
}


?>