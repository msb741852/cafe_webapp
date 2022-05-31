<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$result = mysqli_query($con, "SELECT menuName, price, imageName FROM menulist ");

$menucoffee = array();
while($row = mysqli_fetch_array($result)){
    array_push($menucoffee, array("menuName"=>$row[0], "price"=>$row[1],"imageName"=>$row[2]));
}
echo json_encode(array("response"=>$menucoffee), JSON_UNESCAPED_UNICODE);
mysqli_close($con);

?>