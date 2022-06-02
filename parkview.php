<?php // 링크를 통한 상세조회
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$idx = $_GET['PARKING_ID'];
$sql="select * from PARKING where PARKING_ID= $idx";

if($con){

$result = mysqli_query($con,$sql);
$data = $result->fetch_assoc();
?>
<form action="manage_park.php" method="post">
    <table width=800 border ="1" cellpadding=5>
    <tr>
        <th> 주차장이름 </th>
        <td> <?php echo $data["PARKING_NAME"];?> </td>
    </tr>
    <tr>
        <th> 운영시간 </th>
        <td> <?php echo $data["PARKING_RUNTIME"];?> </td>
    </tr>
    <tr>
        <th> 주차장주소 </th>
        <td> <?php echo $data["PARKING_ADDRESS"];?> </td>
    </tr>
    <tr>
        <th> 주차장 전화번호 </th>
        <td> <?php echo $data["PARKING_PHONE"];?> </td>
    </tr>
    <tr>
        <th> 주차가능 공간 개수 </th>
        <td> <?php echo $data["PARKING_SPACE"];?> </td>
    </tr>
    <tr>
        <th> 공석 개수 </th>
        <td> <?php echo $data["PARKING_NUMBER"];?> </td>
    </tr>
    <tr>
        <th> 주차장 위도 </th>
        <td> <?php echo $data["PARKING_LAT"];?> </td>
    </tr>
    <tr>
        <th> 주차장 경도 </th>
        <td> <?php echo $data["PARKING_LNG"];?> </td>
    </tr>
        <tr>
                <td colspan="2">
                <div style="float:right;">
                        <a href="parkdel.php?PARKING_ID=<?php echo $idx?>" onclick="return confirm('정말 삭제할까요?');">삭제</a>
                        <a href="parkfix.php?PARKING_ID=<?php echo $idx?>">수정</a>
                </div>

                 <a href="manage_park.php">목록</a>
                </td>
        </tr>
    </table>
    <?php }?>
</form>


