<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$userPhone=$_POST['userPhone'];

$result = mysqli_query($con, "SELECT name FROM member where phone = '{$userPhone}'");

$nameArr = array();
while($row = mysqli_fetch_array($result)){
    array_push($nameArr, array("name"=>$row[0]));
}
echo json_encode($nameArr[0], JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>

