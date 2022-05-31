<?php

header('Content-Type: text/html; charset=UTF-8');
$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
$sql = "SELECT DATE_FORMAT(ordercheck.orderTime,'%Y-%m') 월별, sum(menuNum*price) 합계 FROM ordercheck, menulist where ordercheck.list_Menu = menulist.menuName group by 월별 order by 월별";
$result = mysqli_query($conn, $sql);

$data = array();
$row2 = array('월별', '매출액'); 
array_push($data, $row2);
  
while($row = mysqli_fetch_row($result)) {
    $arr = array();
    array_push($arr, $row[0], (int)$row[1]);

    array_push($data, $arr);
    // var_dump($data);
    // echo "<br>";
}
// var_dump($data);


$options = array(
    'title' => '월별 매출액',
    'width' => 400, 'height' =>500
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://kit.fontawesome.com/57b67e461c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Sans+KR&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <script src="//www.google.com/jsapi"></script>
    <script>
        // https://zetawiki.com/wiki/%EA%B5%AC%EA%B8%80%EC%B0%A8%ED%8A%B8_PHP_%EC%97%B0%EB%8F%99 구글 차트 api
        var data= <?= json_encode($data) ?>;
        var options = <?= json_encode($options) ?>;
        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(function() {
        var chart = new google.visualization.ColumnChart(document.querySelector('#chart_div'));
        chart.draw(google.visualization.arrayToDataTable(data), options);
        });
    </script>
<body>
    <nav class="navbar">
        <span class="navbar_logo">O'fete</span>
        <ul class="navbar_menu">
            <li id="menuManage">메뉴관리
                <ul id="menuManage_sub">
                    <li><a href="../menu/menu_Add.html">추가</a></li>
                    <li><a href="../menu/menu_Change.php">변경</a></li>
                    <li><a href="../menu/menu_Status.php">메뉴 상태 변경</a></li>
                    <li><a href="../menu/menu_Delete.php">삭제</a></li>
                </ul>
            </li>
            <li><a href="../pos/pos.php">POS</a></li>
            <li><a href="../orderlist/order_list.php">주문목록</a></li>
            <li id="notice">공지사항 관리
                <ul id="notice_sub">
                    <li><a href="../noticeBoard/notice_Add.html">추가</a></li>
                    <li><a href="../noticeBoard/notice_Delete.php">삭제</a></li>
                </ul>
            </li>
            <li><a href="../chart/chart.php">판매현황</a></li>
        </ul>
        <a href="https://blog.naver.com/ofete1588/220842438016" class="navbar_blog"><i class="fas fa-blog"></i></a>
    </nav>

<h1 class="pageName">판매현황</h1>
<div id="chart_div"></div>
</body>
</html>