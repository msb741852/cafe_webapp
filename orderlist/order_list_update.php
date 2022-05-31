<?php

header("Content-Type:text/html;charset=utf-8");
    $orderNum = $_POST['orderNum'];
    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql = "UPDATE ordercheck SET orderStatus='준비완료' where orderNum='$orderNum'";   
    mysqli_query($conn, $sql);

    if($orderNum != '') {
        echo '<script type="text/javascript">';
        echo "alert('완성되었습니다.');";
        echo 'window.location.href="order_list.php";';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="order_list.php";';
        echo '</script>';
    }
?>
