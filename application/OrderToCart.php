<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');
mysqli_query($conn, 'SET name utf8');

$menuName = $_POST['menuName'];
$userPhone = $_POST['userPhone'];


$menu_Name ='';

$sql = "select cart_menu from cart where cart_owner = '$userPhone'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    if($menuName === $row[0]) {
        $menu_Name = $row[0];
    }
}
// DB에 이미 있을 때
echo($menu_Name);
if($menu_Name !== '' ) {
    mysqli_query($conn, "Update cart SET cart_menuNum = cart_menuNum + 1 WHERE cart_menu = '$menu_Name' AND cart_owner = '$userPhone'");
} else if ($menu_Name === ''){
    mysqli_query($conn, "INSERT INTO cart (cart_menu, cart_owner, cart_menuNum)  VALUES ('$menuName', '$userPhone', 1)");
}





echo json_encode($response);
?>