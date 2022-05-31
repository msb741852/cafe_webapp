<?php

$idx = $_GET['id'];

$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
$sql = "SELECT * FROM noticeboard where idx = $idx";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

$notice_title = "<td class='td_title' colspan='3'>{$row['noticeTitle']}</td>";
$notice_date = "<td>{$row['writeDate']}</td>";
$notice_noticeKinds = "<td>{$row['noticeKinds']}</td>";

$idx_jpg = $idx.".jpg";
$img = "<td colspan='4'><img class='cur_img' src='http://175.121.166.150:8000/capston/noticeBoard/noticeImage/$idx_jpg'></td>";

?>

<!DOCTYPE html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">                
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/57b67e461c.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar">    
        <span class="navbar_logo">O'fete</span>
        <ul class="navbar_menu">
            <li><a href="home.html">홈</a></li>
            <li><a href="noticeBoard.php">공지사항</a></li>
            <li><a href="menu_Introduce.php">메뉴판</a></li>
            <li><a href="map.html">오시는 길</a></li>
        </ul>
        <a href="https://blog.naver.com/ofete1588/220842438016" class="navbar_blog"><i class="fas fa-blog"></i></a>
    </nav>
    <div class="table_div">
        <table class='table_active'>
            <tr>
                <th>제목</th>
                <?=$notice_title?>
            </tr>
            <tr>
                <th>분류</th>
                <?=$notice_noticeKinds?>
                <th>작성일자</th>
                <?=$notice_date?>
            </tr>
            <tr>
                <th colspan='4'>내용</th>
            </tr>
            <?=$img?>
        </table>
    </div>
</body>
</html>