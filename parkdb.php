<?php  //주차장 db insert 기능
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$idx = $_POST['fix_id'];
$NAME = $_POST['parking_name'];
$RUNTIME = $_POST['parking_runtime'];
$ADDRESS = $_POST['parking_address'];
$PHONE = $_POST['parking_phone'];
$SPACE = $_POST['parking_space'];
//$NUMBER = $_POST['parking_number'];
$LAT = $_POST['parking_lat'];
$LNG = $_POST['parking_lng'];
$sql="INSERT INTO `parking`(`PARKING_NAME`, `PARKING_RUNTIME`, `PARKING_ADDRESS`, `PARKING_PHONE`, `PARKING_SPACE` ,`PARKING_LAT`,`PARKING_LNG`) 
VALUES ('$NAME','$RUNTIME','$ADDRESS','$PHONE','$SPACE','$LAT','$LNG')";
$query="UPDATE `parking` 
SET 
`PARKING_NAME`='$NAME',
`PARKING_RUNTIME`='$RUNTIME',
`PARKING_ADDRESS`='$ADDRESS',
`PARKING_PHONE`='$PHONE',
`PARKING_SPACE`='$SPACE', 
`PARKING_LAT`='$LAT',
`PARKING_LNG`='$LNG' WHERE PARKING_ID='$idx'";

if($con){
    if($idx){//수정

        mysqli_query($con,$query);
    }
    else{

        mysqli_query($con,$sql);
    }

    echo "success!!</br>";
    echo "<a href=manage_park.php>기존페이지로 이동</a>";

}
                
?>

