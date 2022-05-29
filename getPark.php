<?php
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$list=$con->get(`PARKING`,3);
if($con){
    
 print_r();
}
?>