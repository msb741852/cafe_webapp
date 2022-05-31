<?php
$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');

// sql문
$sql_coffee = "SELECT * FROM menulist where menuKinds='커피'";
$sql_latte = "SELECT * FROM menulist where menuKinds='라떼'";
$sql_frappe = "SELECT * FROM menulist where menuKinds='프라페'";
$sql_yogurt = "SELECT * FROM menulist where menuKinds='요거트'";
$sql_ade = "SELECT * FROM menulist where menuKinds='에이드'";
$sql_tea = "SELECT * FROM menulist where menuKinds='차'";
$sql_dessert = "SELECT * FROM menulist where menuKinds='디저트'";

$result_coffee = mysqli_query($conn, $sql_coffee);
$result_latte = mysqli_query($conn, $sql_latte);
$result_frappe = mysqli_query($conn, $sql_frappe);
$result_yogurt = mysqli_query($conn, $sql_yogurt);
$result_ade = mysqli_query($conn, $sql_ade);
$result_tea = mysqli_query($conn, $sql_tea);
$result_dessert = mysqli_query($conn, $sql_dessert);

// div 태그 초기화
    $div_coffee = '';
    $div_latte = '';
    $div_frappe = '';
    $div_yogurt = '';
    $div_ade = '';
    $div_tea = '';
    $div_dessert = '';

    while($row_coffee = mysqli_fetch_array($result_coffee)) {
        $div_coffee = $div_coffee."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_coffee['imageName']}.jpg'><div class='div_column'><div>{$row_coffee['menuName']}</div><div>{$row_coffee['price']}</div></div></div>";
    }
    while($row_latte = mysqli_fetch_array($result_latte)) {
        $div_latte = $div_latte."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_latte['imageName']}.jpg'><div class='div_column'><div>{$row_latte['menuName']}</div><div>{$row_latte['price']}</div></div></div>";
    }
    while($row_frappe = mysqli_fetch_array($result_frappe)) {
        $div_frappe = $div_frappe."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_frappe['imageName']}.jpg'><div class='div_column'><div>{$row_frappe['menuName']}</div><div>{$row_frappe['price']}</div></div></div>";
    }
    while($row_yogurt = mysqli_fetch_array($result_yogurt)) {
        $div_yogurt = $div_yogurt."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_yogurt['imageName']}.jpg'><div class='div_column'><div>{$row_yogurt['menuName']}</div><div>{$row_yogurt['price']}</div></div></div>";
    }
    while($row_ade = mysqli_fetch_array($result_ade)) {
        $div_ade = $div_ade."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_ade['imageName']}.jpg'><div class='div_column'><div>{$row_ade['menuName']}</div><div>{$row_ade['price']}</div></div></div>";
    }
    while($row_tea = mysqli_fetch_array($result_tea)) {
        $div_tea = $div_tea."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_tea['imageName']}.jpg'><div class='div_column'><div>{$row_tea['menuName']}</div><div>{$row_tea['price']}</div></div></div>";
    }
    while($row_dessert = mysqli_fetch_array($result_dessert)) {
        $div_dessert = $div_dessert."<div class='menu_item'><img src='http://localhost:8000/capston/menu/menuImage/{$row_dessert['imageName']}.jpg'><div class='div_column'><div>{$row_dessert['menuName']}</div><div>{$row_dessert['price']}</div></div></div>";
    }

?>


<!DOCTYPE html>
<html lang="en">
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


    <section class='section_button_menu'>
        <button class='button_menu coffee'>커피</button>
        <button class='button_menu latte'>라떼</button>
        <button class='button_menu frappe'>프라페</button>
        <button class='button_menu yogurt'>요거트</button>
        <button class='button_menu ade'>에이드</button>
        <button class='button_menu tea'>차</button>
        <button class='button_menu dessert'>디저트</button>
    </section>

    <section class='section_div_menu'>
        <div id='coffee' class='div_menu coffee no_active'>
            <?= $div_coffee?>
        </div>

        <div class='div_menu latte no_active'>
            <?= $div_latte?>
        </div>

        <div class='div_menu frappe no_active'>
            <?= $div_frappe?>
        </div>

        <div id='yogurt' class='div_menu yogurt no_active'>
            <?= $div_yogurt?>
        </div>

        <div id='ade' class='div_menu ade no_active'>
            <?= $div_ade?>
        </div>

        <div id='tea' class='div_menu tea no_active'>
            <?= $div_tea?>
        </div>

        <div id='dessert' class='div_menu dessert no_active'>
            <?= $div_dessert?>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>

<script>
    $('.button_menu').click(function() {
        let a = $(this).attr("class");
        let arr = a.split(" ");
        a = arr[1];
        $('.div_menu').removeClass('active');
        $('.div_menu.' + a).addClass('active');
    });
</script>
</html>