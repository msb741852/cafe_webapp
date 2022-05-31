<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$userPhone= $_POST['userPhone'];
$result = mysqli_query($con, "SELECT stamps FROM member where phone = '$userPhone'");


$stampsphp = array();
while($row = mysqli_fetch_array($result)){
    array_push($stampsphp, array("stamps"=>$row[0]));
}
echo json_encode($stampsphp[0], JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>

