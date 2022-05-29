<?php //오류 해결이 필요
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$idx = $_GET['PARKING_ID'];
$sql="select * from PARKING where PARKING_ID= $idx";

if($con){

$result = mysqli_query($con,$sql);
$data = $result->fetch_assoc();
?>
<form action="parkdb.php" method="post">
    <input type="hidden" name="fix_id" value="<?php echo $idx?>">
    <table width=800 border ="1" cellpadding=5>
    <tr>
        <th> 주차장이름 </th>
        <td> <input type="text" name="parking_name" value="<?php echo $data["PARKING_NAME"];?>"> </td>
    </tr>
    <tr>
        <th> 운영시간 </th>
        <td> <input type="text" name="parking_runtime" value="<?php echo $data["PARKING_RUNTIME"];?>"> </td>
    </tr>
    <tr>
        <th> 주차장주소 </th>
        <td> <input type="text" name="parking_address" value="<?php echo $data["PARKING_ADDRESS"];?>"> </td>
    </tr>
    <tr>
        <th> 주차장 전화번호 </th>
        <td> <input type="text" name="parking_phone" value="<?php echo $data["PARKING_PHONE"];?>"> </td>
    </tr>
    <tr>
        <th> 주차가능 공간 개수 </th>
        <td> <input type="text" name="parking_space" value="<?php echo $data["PARKING_SPACE"];?>"> </td>
    </tr>
    <tr>
        <th> 공석 개수 </th>
        <td> <input type="text" name="parking_number" value="<?php echo $data["PARKING_NUMBER"];?>"> </td>
    </tr>
    <tr>
        <th> 주차장 위도 </th>
        <td> <input type="text" name="parking_lat" value="<?php echo $data["PARKING_LAT"];?>"> </td>
    </tr>
    <tr>
        <th> 주차장 경도 </th>
        <td> <input type="text" name="parking_lng" value="<?php echo $data["PARKING_LNG"];?>"> </td>
    </tr>
    
        <tr>
                <td colspan="2">
                <div style="text-align:center;">
                       <input type="submit" value="저장">
                </div>

                </td>
        </tr>
    </table>
    <?php }?>
</form>


