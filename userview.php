<?php // 테이블에서 사용자ID 링크를 통해서 상세조회
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$idx = $_GET['USER_ID'];
$sql="select * from USER where USER_ID= '$idx' ";

if($con){

$result = mysqli_query($con,$sql);
$data = $result->fetch_assoc();
?>
<form action="manage_user.php" method="post">
    <table width=800 border ="1" cellpadding=5>
    <tr>
        <th> 사용자ID </th>
        <td> <?php echo $data["USER_ID"];?> </td>
    </tr>
    <tr>
        <th> 사용자이름 </th>
        <td> <?php echo $data["NAME"];?> </td>
    </tr>
    <tr>
        <th> 사용자이메일 </th>
        <td> <?php echo $data["USER_EMAIL"];?> </td>
    </tr>
    <tr>
        <th> 사용자 별명 </th>
        <td> <?php echo $data["USER_NICKNAME"];?> </td>
    </tr>
    
    
        <tr>
                <td colspan="2">
                <div style="float:right;">
                        <a href="userdel.php?USER_ID=<?php echo $idx?>" onclick="return confirm('정말 삭제할까요?');">삭제</a>
                </div>

                 <a href="manage_user.php">목록</a>
                </td>
        </tr>
    </table>
    <?php }?>
</form>


