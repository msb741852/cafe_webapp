<?php

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
$sql = "UPDATE menulist set price='{$_POST['price']}' WHERE menuName='{$_POST['menuName']}'";

echo $sql;

$result = mysqli_query($conn, $sql);
if($result === false){
  echo '변경하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  Header("Location:menu_Change.php");
}
?>