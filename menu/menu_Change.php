<?php
    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql = "SELECT * FROM menulist";
    $result = mysqli_query($conn, $sql);

    $list = '';
    while($row = mysqli_fetch_array($result)) {
        $list = $list."<li><a href=\"menu_Change.php?id={$row['menuName']}\">{$row['menuName']}</a></li>";
    }
    
    $article = array(
        'menuName'=>'',
        'price'=>'',
    );

    if(isset($_GET['id'])){
        $sql = "SELECT * FROM menulist where menuName='{$_GET['id']}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $article = array(
            'menuName'=>$row['menuName'],
            'menukinds'=>$row['menuKinds'],
            'price'=>$row['price']
        );
    }
    
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe O'fete</title>
    <script src="https://kit.fontawesome.com/57b67e461c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="menu_style.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
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
    
    
    <h3 id="textCenter">어서오세요 ! 변경하실 메뉴를 선택해주세요</h3>
    <section class="menuChange">
        <div class="menuChange_list">
            <span><a href="menu.php">메뉴선택</a></span>
            <ol id="menuList">
                <?=$list?>
            </ol>
        </div>
        
        <div class="menuChange_active">
            <span id="menuTitle" name='menuName'>변경하실 메뉴 : <?=$article['menuName'] ?></span>
            <form action="menu_Change_update.php" method="POST">
                <input type="text" name='menuName' value='<?=$article['menuName'] ?>' hidden>
                <input style="display: <?php if($article['menuName'] == ""){echo "none";}else{echo "block";}?>" id="firstinput" type="text" name='price' value=<?=$article['price']?>>
                <input style="display: <?php if($article['menuName'] == ""){echo "none";}else{echo "block";}?>" id="secondinput" type="submit" value='변경'>
            </form>
        </div>
    </section>
</body>
</html>

