<?php
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$sql = "select * from PARKING "; 
$result = mysqli_query($con,$sql);
mysqli_set_charset($con,'utf8');
$total = mysqli_num_row($result);
$i = 1;
print_r($result);


?>