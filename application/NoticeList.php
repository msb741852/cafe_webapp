<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$result = mysqli_query($con, "SELECT * FROM noticeboard ORDER BY idx DESC;");
$response = array();
while($row = mysqli_fetch_array($result)){
    array_push($response, array("idx"=>$row[0],"noticeTitle"=>$row[1], "noticeKinds"=>$row[2],"writeDate"=>$row[3]));
}
echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>