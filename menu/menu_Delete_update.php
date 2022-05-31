<?php

header('Content-Type: text/html; charset=UTF-8');

$string = $_POST['menuName'];
$delete_file_jpg = @unlink("menuImage/".$string.".jpg");
$delete_file_png = @unlink("menuImage/".$string.".png");

// 파일 삭제
if($delete_file_jpg) {
  echo "파일 삭제 성공";
} else if($delete_file_png){
  echo "파일 삭제 성공";
} else {
  echo "파일이 없는 것 같습니다.";
}

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
$sql = "DELETE FROM menulist WHERE menuName='{$_POST['menuName']}'";


$result = mysqli_query($conn, $sql);

if($result === false){
  echo '변경하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  Header("Location:menu_Status.php");
}
?>