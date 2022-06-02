<?php // 링크를 통한 상세조회
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$idx = $_GET['COMMENTS_ID'];
$sql="select * from COMMENTS where COMMENTS_ID= $idx";

if($con){

$result = mysqli_query($con,$sql);
$data = $result->fetch_assoc();
?>
<form action="manage_community.php" method="post">
    <table width=800 border ="1" cellpadding=5>
    <tr>
        <th> No </th>
        <td> <?php echo $data["COMMENTS_ID"];?> </td>
    </tr>
    <tr>
        <th> 제목 </th>
        <td> <?php echo $data["COMMENTS_TITLE"];?> </td>
    </tr>
    <tr>
        <th> 내용 </th>
        <td>
            <textarea name="memo" style="width:100%; height:300px;"> 
            <?php echo ($data["COMMENTS"]);?>
            </textarea> 
        </td>
    </tr>
    <tr>
        <th> 작성일자 </th>
        <td> <?php echo $data["CREATED"];?> </td>
    </tr>
    
        <tr>
                <td colspan="2">
                <div style="float:right;">
                        <a href="commentsdel.php?COMMENTS_ID=<?php echo $idx?>" onclick="return confirm('정말 삭제할까요?');">삭제</a>
                        
                </div>

                 <a href="manage_community.php">목록</a>
                </td>
        </tr>
    </table>
    <?php }?>
</form>


