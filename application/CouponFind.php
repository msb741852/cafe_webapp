<?php 

header('Content-Type: text/html; charset=UTF-8');
$userPhone = $_POST['userPhone'];
// $userPhone = '010-1234-1234';

$conn = mysqli_connect("localhost","capston","20184163", "capston_opete");
$sql = "SELECT usercouponId, salePrice, idx  FROM usercoupon,coupons where coupons.couponId = usercoupon.userCouponId AND userPhone = '$userPhone' and used = '미사용'";
$result=mysqli_query($conn, $sql);

$arr= array();

while($row = mysqli_fetch_array($result)) {    
    array_push($arr, array("couponId"=>$row[0], "salePrice"=>$row[1], "idx"=>$row[2]));
}


echo json_encode(array("response"=>$arr), JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>