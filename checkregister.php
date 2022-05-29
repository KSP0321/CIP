<?php  //사용자 회원가입 기능
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$ID = $_POST['id'];
$PW = $_POST['password'];
$NICK = $_POST['nickname'];
$NAME = $_POST['name'];
$EMAIL = $_POST['email'];
$sql="INSERT INTO `USER` ( USER_ID, USER_NAME, USER_EMAIL, USER_PW, USER_NICKNAME) VALUES ('$ID','$NAME','$EMAIL' ,'$PW','$NICK')";


if($con){
echo "회원가입 성공</br>";
echo "<a href=index.html>로그인페이지 이동</a>";
if(!mysqli_query($con,$sql))
    die(mysqli_error());

}
else{
    echo "fail to insert sql";
}
mysql_close($con);

                
?>