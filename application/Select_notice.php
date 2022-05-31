<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");


$result = mysqli_query($con, "SELECT * FROM noticeboard order by idx desc limit 1");


$noticephp = array();
while($row = mysqli_fetch_array($result)){
    array_push($noticephp, array("noticephp"=>$row[0]));
}
echo json_encode($noticephp[0], JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>

