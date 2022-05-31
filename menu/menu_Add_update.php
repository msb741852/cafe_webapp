<?php
header('Content-Type: text/html; charset=UTF-8');


$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');


if($_FILES['menuImg']['name'] > 1) {
    $sql = "INSERT INTO menulist (menuName, menuKinds, price, imageName) values ('{$_POST['menuName']}','{$_POST['menuKinds']}', '{$_POST['price']}', '{$_POST['menuName']}') ";
} else {
    $sql = "INSERT INTO menulist (menuName, menuKinds, price, imageName) values ('{$_POST['menuName']}','{$_POST['menuKinds']}', '{$_POST['price']}', '준비중') ";
}
// echo $sql;

mysqli_query($conn, $sql);

// var_dump($_FILES['menuImg']['error']) ;
ini_set("upload_max_filesize", "40M");


// var_dump($_FILES);
$menuName = $_POST['menuName'];


$uploaddir = 'C:\Bitnami\wampstack-8.0.10-0\apache2\htdocs\capston\menu\menuImage\\';
$nameArr = explode(".",  $_FILES['menuImg']['name']);

if($_FILES['menuImg']['name'] > 1) {
    $uploadfile = $uploaddir.$menuName.".".$nameArr[1];
    $imgSrc = $menuName.".".$nameArr[1];

    if(move_uploaded_file($_FILES['menuImg']['tmp_name'], $uploadfile)) {
        echo "메뉴 사진 업로드 성공";
        Header("Location:menu_Add.html");
    } else {
        echo "파일 업로드 공격의 가능성이 있음";
    }
    Header("Location:menu_Add.html");
}
Header("Location:menu_Add.html");
?>