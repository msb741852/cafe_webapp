<?php
    $firstNum = $_GET['firstNum'];
    $secondNum = $_GET['secondNum'];
    $thirdNum = $_GET['thirdNum'];

    $phone = $firstNum."-".$secondNum."-".$thirdNum;

    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql = "SELECT name FROM member where phone='$phone'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if($row === null) {
        echo "등록된 정보가 없습니다.";
    } else {
        echo $row[0]." 님";
    }
?>