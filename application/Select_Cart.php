<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$userPhone= $_POST['userPhone'];
// $userPhone = '010-1234-1234';
$result = mysqli_query($con, "SELECT * FROM cart where cart_owner = '$userPhone'");


$count = '';
$arr = array();

while($row = mysqli_fetch_array($result)) {
    $result_price = mysqli_query($con, "select price from menulist where menuName='$row[1]'");
    $price = mysqli_fetch_array($result_price)[0];
    
    array_push($arr, array("menuName"=>$row[1], "price"=>$price, "num"=>$row[2]));
}

echo json_encode(array("response"=>$arr), JSON_UNESCAPED_UNICODE);
mysqli_close($con);


?>



