<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$result = mysqli_query($con, "SELECT menuName, menuKinds, price, imageName FROM menulist where menukinds = '디저트'");

$menudesert = array();
while($row = mysqli_fetch_array($result)){
    array_push($menudesert, array("menuName"=>$row[0],"menuKinds"=>$row[1], "price"=>$row[2],"imageName"=>$row[3]));
}
echo json_encode(array("menudesert"=>$menudesert), JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>