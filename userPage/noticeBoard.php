<?php
$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');

// 페이징 처리
$sql_count = "SELECT COUNT(*) FROM noticeboard";
$result_count = mysqli_query($conn, $sql_count);
$count = mysqli_fetch_array($result_count);
$total_page = ceil($count[0] / 10); 

// SELECT * FROM noticeboard order by idx desc limit 2

$page ='';
$cur_Page = '';

for($i =1; $i <= $total_page; $i++) {
    $page = $page."<a class='pageBtn' href='noticeBoard.php?page=$i'>$i</a>";
}



if(isset($_GET['page'])) {
    if($_GET['page'] === '1') {
        $cur_Page = 1;
        $startNum = 0;

        $sql = "SELECT * FROM noticeboard order by idx desc limit $startNum, 10";
        $result = mysqli_query($conn, $sql);
    } else {
        $cur_Page = $_GET['page'];
        $startNum = 10*($cur_Page-1);

        $sql = "SELECT * FROM noticeboard order by idx desc limit $startNum, 10";
        $result = mysqli_query($conn, $sql);
    }
} else {
    $sql = "SELECT * FROM noticeboard order by idx desc limit 10";
    $result = mysqli_query($conn, $sql);
}

$htmlTag = '';

while($row = mysqli_fetch_array($result)) {
    $idx = "<td class='idx'>{$row['idx']}</td>";
    $noticeKinds = "<td class='noticeKinds'>{$row['noticeKinds']}</td>";
    $noticeTitle = "<td class='noticeTitle'><a href='noticeBoard_process.php?id={$row['idx']}'>{$row['noticeTitle']}</a></td>";
    $date = "<td class='date'>{$row['writeDate']}</td>";
    $htmlTag = $htmlTag."<tr>$idx$noticeKinds$noticeTitle$date</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe O'fete</title>
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
        <form action="noticeBoard_process.php" method="get"></form>
        <table class="noticeTable">
            <thead class="table_Head">
                <th>id</th>
                <th>분류</th>
                <th>제목</th>
                <th>작성일자</th>
            </thead>
            <?=$htmlTag?>    
        </table>
    </div>
    <div class="page_box">
        <?=$page?> 
    </div>
</body>
<script>
</script>
</html>