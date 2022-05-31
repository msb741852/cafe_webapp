<?php
header('Content-Type: text/html; charset=UTF-8');


$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');


$sql = "INSERT INTO noticeboard (noticeTitle, noticeKinds, writeDate) values ('{$_POST['noticeTitle']}','{$_POST['noticeKinds']}', now())";

// echo $sql;

mysqli_query($conn, $sql);



// // var_dump($_FILES);
$idx_sql = "SELECT idx FROM noticeboard where noticeTitle='{$_POST['noticeTitle']}' ORDER BY idx DESC LIMIT 1"; // 가장 최근 idx 조회
$idx_result = mysqli_query($conn, $idx_sql);
// print_r(mysqli_fetch_array($idx_result)) ;

$idx = mysqli_fetch_array($idx_result);

ini_set("upload_max_filesize", "40M");

$uploaddir = 'C:\Bitnami\wampstack-8.0.10-0\apache2\htdocs\capston\noticeBoard\noticeImg\\';
$nameArr = explode(".",  $_FILES['noticeImg']['name']);

if($_FILES['noticeImg']['name'] > 1) {
    $uploadfile = $uploaddir.$idx[0].".".$nameArr[1];
    $imgSrc = $idx[0].".".$nameArr[1];

    if(move_uploaded_file($_FILES['noticeImg']['tmp_name'], $uploadfile)) {
        echo "메뉴 사진 업로드 성공";
        Header("Location:notice_Add.html");
    } else {
        echo "파일 업로드 공격의 가능성이 있음";
    }
    Header("Location:notice_Add.html");
}
Header("Location:notice_Add.html");
?>