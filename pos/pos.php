<?php
    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql_d = "SELECT * FROM menulist WHERE menuKinds='디저트'";
    $sql_c = "SELECT * FROM menulist WHERE menuKinds='커피'";
    $sql_yp = "SELECT * FROM menulist WHERE menuKinds in ('요거트', '프라페')";
    $sql_at = "SELECT * FROM menulist WHERE menuKinds in('에이드','차')";
    $sql_l = "SELECT * FROM menulist WHERE menuKinds='라떼'";

    $result_d = mysqli_query($conn, $sql_d);
    $result_c = mysqli_query($conn, $sql_c);
    $result_yp = mysqli_query($conn, $sql_yp);
    $result_at = mysqli_query($conn, $sql_at);
    $result_l = mysqli_query($conn, $sql_l);

    $menuBtn_d = '';
    $menuBtn_c = '';
    $menuBtn_yp = '';
    $menuBtn_at = '';
    $menuBtn_l = '';

    while($menuList = mysqli_fetch_array($result_d)) {
        $menuBtn_d = $menuBtn_d."<button class='menuBtn' onclick=\"menuAdd('{$menuList['menuName']}',{$menuList['price']});\">{$menuList['menuName']}</button>";
    };
    while($menuList = mysqli_fetch_array($result_c)) {
        $menuBtn_c = $menuBtn_c."<button class='menuBtn' onclick=\"menuAdd('{$menuList['menuName']}',{$menuList['price']});\">{$menuList['menuName']}</button>";
    };
    while($menuList = mysqli_fetch_array($result_yp)) {
        $menuBtn_yp = $menuBtn_yp."<button class='menuBtn' onclick=\"menuAdd('{$menuList['menuName']}',{$menuList['price']});\">{$menuList['menuName']}</button>";
    };
    while($menuList = mysqli_fetch_array($result_at)) {
        $menuBtn_at = $menuBtn_at."<button class='menuBtn' onclick=\"menuAdd('{$menuList['menuName']}',{$menuList['price']});\">{$menuList['menuName']}</button>";
    };
    while($menuList = mysqli_fetch_array($result_l)) {
        $menuBtn_l = $menuBtn_l."<button class='menuBtn' onclick=\"menuAdd('{$menuList['menuName']}',{$menuList['price']});\">{$menuList['menuName']}</button>";
    };
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe O'fete</title>
    <link rel="stylesheet" href="style.css?alter">
    <script src="https://kit.fontawesome.com/57b67e461c.js" crossorigin="anonymous"></script>
    <script src='main.js' defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Sans+KR&display=swap" rel="stylesheet">
</head>
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

    <h1 class="pageName">POS</h1>
    <div class="container">
        <div class="choicedMenu">
            <form action="order_add.php" method="POST" name="menuForm">
                <table>
                    <thead>
                        <tr>
                            <th>idx</th>
                            <th>메뉴</th> 
                            <th>갯수</th>
                            <th>가격</th>
                            <th>조정</th>
                        </tr>
                    </thead>
                    <tbody id="menuChoice"></tbody>
                </table>
                <div class="phoneNumber">
                    
                <p id="inputNum"></p>
                    적립하실 번호 :
                    <input id="firstNum" class="phoneNum" type="tel" value="010">
                    - <input id="secondNum" class="phoneNum" maxlength="4" type="tel">
                    - <input id="thirdNum" class="phoneNum"  name="password"maxlength="4" type="tel">
                    <input type="text" id="phoneNum" name="phone" hidden>
                    <button type="button" onclick="nameCheck()">확인</button>
                </div>
                </div>
                    <div class="payInfo">
                        <input type="number" name="stamp" id="drink_sum" value="0" hidden>
                        <select name="paymentMethod">
                            <option value="카드결제">카드결제</option>
                            <option value="현금결제">현금결제</option>
                        </select>
                        <span id='sum_all'>결제금액 : 0원</span>
                        <input id="payBtn" type="button" onclick="menuCheck();" value="결제">
                    </div>
            </form>

        
        <div class="tabMenu">
            <ul class="tabNav">
                <li><button class="tabBtn clicked" id="btn1" onclick="menuChoice(1)">커피</button></li>
                <li><button class="tabBtn" id="btn2" onclick="menuChoice(2)">요거트 / 프라페</button></li>
                <li><button class="tabBtn" id="btn3" onclick="menuChoice(3)">에이드 / 차</button></li>
                <li><button class="tabBtn" id="btn4" onclick="menuChoice(4)">라떼</button></li>
                <li><button class="tabBtn" id="btn5" onclick="menuChoice(5)">디저트</button></li>
            </ul>
            <div class="tabContent">
                <div class="content" id="tab01" style= "display: flex"><?=$menuBtn_c?></div>
                <div class="content" id="tab02"><?=$menuBtn_yp?></div>
                <div class="content" id="tab03"><?=$menuBtn_at?></div>
                <div class="content" id="tab04"><?=$menuBtn_l?></div>
                <div class="content" id="tab05"><?=$menuBtn_d?></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>
</html>