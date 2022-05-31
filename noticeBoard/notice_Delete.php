<?php
    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql = "SELECT * FROM noticeboard";
    $result = mysqli_query($conn, $sql);

    $list = '';
    while($row = mysqli_fetch_array($result)) {
        $list = $list."<li><a href=\"notice_Delete.php?idx={$row['idx']}\">{$row['noticeTitle']}</a></li>";
    }
    
    $article = array(
        'noticeTitle'=>'',
        'idx'=>'',
    );

    if(isset($_GET['idx'])){
        $sql = "SELECT * FROM noticeboard where idx='{$_GET['idx']}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $article = array(
            'noticeTitle'=>$row['noticeTitle'],
            'idx'=>$row['idx']
        );
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="notice_Delete_Style.css?after">
    <script src="https://kit.fontawesome.com/57b67e461c.js" crossorigin="anonymous"></script>
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
    
    
    <h3 id="textCenter">삭제하실 공지사항을 선택해주세요</h3>
    <section class="menuDelete">
        <div class="menuDelete_list">
            <span>공지사항 선택</span>
            <ol id="menuList">
                <?=$list?>
            </ol>
        </div>
        
        <div class="menuDelete_active">
            <span id="menuTitle" name='menuName'>선택하신 공지사항 : <?=$article['noticeTitle']?></span>
            <form action="notice_Delete_update.php" method="POST">
                <input type="text" name='menuName' value='<?=$article['noticeTitle']?>' hidden>
                <input type="text" name='idx' value='<?=$article['idx']?>' hidden>
                <span  style="display: <?php if($article['noticeTitle'] == ""){echo "none";}else{echo "block";}?>">정말로 삭제하시겠습니까?</span>
                <input style="display: <?php if($article['noticeTitle'] == ""){echo "none";}else{echo "inline";}?>" id="secondinput" type="submit" value='삭제'>
            </form>
        </div>
    </section>
</body>
</html>