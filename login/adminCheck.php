<?php
    header("Content-Type:text/html;charset=utf-8");
    $id = $_POST['id'];
    $password = $_POST['pw'];

    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql = "SELECT phone, password FROM member where admin='1'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);



    if($row[0] === $id && $row[1] === $password){
        echo "로그인 성공!";
    } else if ($row[0] !== $id) {
        echo "관리자용 ID가 아닙니다.";
    } else if ($row[1] !== $password) {
        echo "비밀번호가 일치하지 않습니다.";
    }
?>