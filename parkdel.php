<?php   //주차장 삭제
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$idx=$_GET["PARKING_ID"];
$sql="DELETE FROM PARKING WHERE PARKING_ID = '$idx' ";

if($con){
mysqli_query($con,$sql);

}
else{
    echo "fail to sql";
}
           
?>
<script>
    location.href="manage_park.php"
</script>
