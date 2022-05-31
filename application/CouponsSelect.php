<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$userPhone= $_POST['userPhone'];

$result = mysqli_query($con, "SELECT * FROM usercoupon where userPhone = '$userPhone' and used = '미사용'");

$couponsphp = array();
while($row = mysqli_fetch_array($result)){
    array_push($couponsphp, array("couponId"=>$row[2]));
}

echo json_encode(
    array("couponId"=>$couponsphp, JSON_UNESCAPED_UNICODE)
);
mysqli_close($con);

?>

