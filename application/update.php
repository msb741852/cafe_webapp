<?php

require "connect.php";

$phone=$_POST['phone'];
$password=$_POST['password'];
$name=$_POST['name'];

$sql="update member set password='$password',name='$name' where phone='$phone'";

if(mysqli_query($con,$sql)){
    echo "Successfully update";
} else{
    echo "Try again later".mysqli_error($con);
}

?>