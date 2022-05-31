<?php
$conn = mysqli_connect('localhost', 'capston', '20184163', 'capston_opete');

$phone=$_GET['id'];
$password=$_GET['pwd'];

$qry="select * from member where phone='$phone' and password='$password'";

$raw=mysqli_query($conn,$qry);

$count=mysqli_num_rows($raw);

if($count>0){
    echo "found";
} else{
    echo "not found";
}
?>