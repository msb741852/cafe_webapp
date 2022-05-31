<?php
header('Content-Type: text/html; charset=UTF-8');
$con = mysqli_connect("localhost","capston","20184163", "capston_opete");

$userPhone= $_POST['userPhone'];
// $userPhone = '010-1234-1234';
$result = mysqli_query($con, "SELECT orderNum, orderTime, list_Menu FROM ordercheck WHERE phone = '$userPhone' GROUP BY orderNum");
$result_count = mysqli_query($con, "SELECT orderNum ,COUNT(list_Menu) FROM ordercheck WHERE phone = '$userPhone' GROUP BY orderNum");


$count = '';
$arr = array();
$arr_count = array();

while($row = mysqli_fetch_array($result_count)) {
    array_push($arr_count,array($row[0], $row[1]));
}


$i=0; $j= 1;
while($row = mysqli_fetch_array($result)) {
    $i =0;
    for($i = 0; $i < count($arr_count); $i++) {
        if($arr_count[$i][0] === $row['orderNum']) {
            $count = $arr_count[$i][1] -1 ;
            break;
        }
    }

    array_push($arr, array("orderNum"=> $row[0], "orderTime"=>$row[1], "list_Menu"=>$row[2], "count"=>$count));
    $j++;
}
// print_r($arr);
echo json_encode(array("response"=>$arr), JSON_UNESCAPED_UNICODE);
mysqli_close($con);






















?>



