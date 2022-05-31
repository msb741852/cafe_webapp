<?php
    header('Content-Type: text/html; charset=UTF-8');
    $conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
    $sql = "SELECT * FROM orderCheck WHERE orderStatus='준비 중'";
    $sql_price = "SELECT orderNum ,sum(price*menuNum) FROM menulist, ordercheck where ordercheck.list_Menu = menulist.menuName group by orderNum";
    $sql_coupon = "SELECT orderNum, salePrice FROM coupons, ordercheck WHERE coupons.couponId = ordercheck.couponIdx";

    $result = mysqli_query($conn, $sql);
    $result_price = mysqli_query($conn, $sql_price);
    $result_coupon = mysqli_query($conn, $sql_coupon);



    $htmlTag = '';
    $price = '';
    $couponSale = '';
    $orderNum = '';
    $price_arr = array();
    $coupon_arr = array();
    

    // 총합을 배열로 넣음
    while($row= mysqli_fetch_array($result_price)) {
        array_push($price_arr, array($row[0], $row[1]));
    }
    
    while($row= mysqli_fetch_array($result_coupon)) {
        array_push($coupon_arr, array($row[0], $row[1]));
    }

    
    while($row = mysqli_fetch_array($result)) {
        $i =0;
        $couponSale=0;
        for($i = 0; $i < count($price_arr); $i++) {
            if($price_arr[$i][0] === $row['orderNum']) {
                $price = $price_arr[$i][1];
                break;
            }
        }

        $j = 0;
        for($j = 0; $j < count($coupon_arr); $j++) {
            if($coupon_arr[$j][0]==$row['orderNum']) {
                $couponSale = $coupon_arr[$j][1];
            }
        }

        $idx = "<td class='idx idx{$row['orderNum']}'>{$row['orderNum']}</td>";
        $menuAndNum = "<td>{$row['list_Menu']} / {$row['menuNum']} </td>";
        $orderTime = "<td class='time idx{$row['orderNum']}'>{$row['orderTime']}</td>";
        $payment = "<td class='payment idx{$row['orderNum']}'>{$row['paymentMethod']}</td>";
        $status = "<td class='status idx{$row['orderNum']}'><input type='text' value='{$row['orderNum']}' hidden><input type='text' value='{$price}' hidden><input type='text' value='{$couponSale}' hidden ><input type='submit'value='준비완료' class='submitBtn' id='{$row['orderNum']}'></td>";
        $htmlTag = $htmlTag."<tr>$idx$menuAndNum$orderTime$payment$status</tr>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/57b67e461c.js" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="oList_style.css?after">
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

    <div class="order_list">
    <form action="order_list_update.php" method="POST">
        <table >
            <thead>
                <tr>
                    <th>번호</th>
                    <th>메뉴이름 / 주문수량</th>
                    <th>주문시간</th>
                    <th>결제방법</th>
                    <th>주문상태</th>
                </tr>
            </thead>
            <?=$htmlTag?>
        </table>
        </form>
    </div>

        <script type="text/javascript">

		$(function(e){
			genRowspan("idx");
		});

		function genRowspan(className){
			$("." + className).each(function() {
                    let rows = $(".idx."+className+$(this).text());
				if (rows.length > 1) {
					rows.attr("rowspan", rows.length);    // 번호
					rows.not(":eq(0)").attr('style', "display: none ;");
                    rows.parent().children(":eq(2)").attr('rowspan', rows.length); 
                    rows.parent().children(":eq(2)").attr('class', 'first_time');
                    rows.parent().children(":eq(3)").attr('rowspan', rows.length); // 결제방법
                    rows.parent().children(":eq(3)").attr('class', 'first_payment');
                    rows.parent().children(":eq(4)").attr('rowspan', rows.length);  // 주문상태
                    rows.parent().children(":eq(4)").attr('class', 'first_status');
                    rows.eq(rows.length-1).parent().css('border-bottom', '2px solid #946d60');
				} else {
                    rows.eq(0).parent().css('border-bottom', '2px solid #946d60');
                    rows.parent().children(":eq(2)").attr('class', 'first_time one');
                    rows.parent().children(":eq(3)").attr('class', 'first_payment one');
                    rows.parent().children(":eq(4)").attr('class', 'first_status one');
                    $('.one').parent().children().css('padding', '30px');
                }
			});
		}

        $(function(){
            $('.submitBtn').click(function(){
                if($(this).parent().parent().children(":eq(3)").text() == '현장결제'){
                    let sum_price = $(this).parent().children(":eq(1)").attr('value');
                    let sale_price = $(this).prev().attr('value');
                    let price = sum_price - sale_price;

                    if(confirm($(this).parent().children().attr('value')+"번 결제하시겠습니까? \n 총합 : "+ $(this).parent().children(":eq(1)").attr('value') +"\n 할인 : " + $(this).prev().attr('value') +  "\n 받을 돈 : " + price) == true) {
                        $(this).parent().children(":eq(0)").attr('name', 'orderNum');
                    }
                    return;
                } else {
                    if(confirm($(this).parent().children().attr('value')+"번이 준비완료되었습니까?") == true) {
                        $(this).parent().children(":eq(0)").attr('name', 'orderNum');
                    }
                }
                return ;
            });
        });
	</script>
</body>
</html>