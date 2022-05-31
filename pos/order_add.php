<?php
header("Content-Type:text/html;charset=utf-8");
$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');

$orderNum_sql = "SELECT orderNum FROM ordercheck ORDER BY orderTime DESC";
$orderNum_query = mysqli_query($conn, $orderNum_sql);
$orderNum_result = mysqli_fetch_array($orderNum_query)['orderNum'];
$orderNum = '';


$phoneNum = $_POST['phone'];
$stamp = $_POST['stamp'];
$paymentMethod = $_POST['paymentMethod'];
$password = $_POST['password'];

$stamp_sql = "SELECT stamps FROM member WHERE phone='{$phoneNum}'";
$stamp_query = mysqli_query($conn, $stamp_sql);
$stamp_num_row = mysqli_num_rows($stamp_query);   // 회원인지 확인하기 위해

if($stamp_num_row === 0 && $phoneNum !== NULL && $phoneNum !== '') {
    $new_member_sql = "INSERT INTO member (phone, password, stamps) VALUES ('{$phoneNum}', '{$password}', '{$stamp}')";  // 회원 추가
    $new_member_query = mysqli_query($conn, $new_member_sql);
    echo ("됨");
} 

if ($stamp_num_row !== 0 && $phoneNum !== NULL && $phoneNum !== '') {
    $stamp_query = mysqli_query($conn, $stamp_sql);
    $stamp_result = mysqli_fetch_array($stamp_query)['stamps'];
    $insert_stamp = $stamp_result + $stamp;
    $stamp_insert_sql= "UPDATE member SET stamps='{$insert_stamp}' where phone='{$phoneNum}'";
    mysqli_query($conn, $stamp_insert_sql);
}
    


$menuName = $_POST['menuName'];
$menuNum = $_POST['number'];
$cnt = 0;

if($orderNum_query === false) {
    echo "실패";
} else {
    if($orderNum_result === NULL) {
        $orderNum = 1;
    } else {
        $orderNum = $orderNum_result + 1;
    }

}

for ($cnt; $cnt < count($menuName); $cnt++){
    if($phoneNum) {
        $sql = " INSERT INTO ordercheck (orderNum, list_Menu, menuNum, orderTime, paymentMethod, phone) VALUES ('{$orderNum}','{$menuName[$cnt]}','{$menuNum[$cnt]}', now(), '{$paymentMethod}', '{$phoneNum}')";
    } else {
        $sql = " INSERT INTO ordercheck (orderNum, list_Menu, menuNum, orderTime, paymentMethod) VALUES ('{$orderNum}','{$menuName[$cnt]}','{$menuNum[$cnt]}', now(), '{$paymentMethod}')";
    }

    $result = mysqli_query($conn, $sql);
    // echo $sql;

    if($result === false) {
        echo '실패';
    } else {
        echo '<script type="text/javascript">';
        echo "alert(\"대기번호 : \"+ '{$orderNum}');";
        echo 'window.location.href="pos.php";';
        echo '</script>';
        
        // Header("Location:pos.php");
    }
}
?>