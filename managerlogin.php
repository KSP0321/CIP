<?php   //admin 로그인
$con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
$m_id = $_POST["m_id"];
$m_pw = $_POST["m_pw"];

/* 쿼리 작성 */
$sql = "select ADMIN_ID, ADMIN_PW from ADMIN where ADMIN_ID ='$m_id' ";
// echo $sql;

/* 쿼리 전송(연결 객체) */
$result = mysqli_query($con, $sql);

/* DB에서 결과값 가져오기 */
// mysqli_fetch_row // 필드 순서
// mysqli_fetch_array // 필드명
// mysqli_num_rows // 결과행의 개수
$num = mysqli_num_rows($result);
// echo

/* 조건 처리 */
if($con){
    if(!$num){ // 아이디가 존재하지 않으면
    // 메세지 출력 후 이전 페이지로 이동
        echo "
            <script type=\"text/javascript\">
            alert(\"일치하는 아이디가 없습니다.\");
            history.back();
        </script>
            ";
    exit;
    }       
    else{ // 아이디가 존재하면

    // DB에서 사용자 정보 가져오기
    $array = mysqli_fetch_array($result);
    // $g_idx = $array["idx"];
    // $g_u_name = $array["u_name"];
    // $g_u_id = $array["u_id"];
    $db_pw = $array["ADMIN_PW"];

    // 사용자가 입력한 비밀번호와 DB에 저장된 비밀번호가 일치하지 않는다면
    if($m_pw != $db_pw){
        echo "
            <script type=\"text/javascript\">
                alert(\"비밀번호가 일치하지 않습니다.\");
                history.back();
            </script>
        ";
    exit;
    } else{ // 비밀번호가 일치한다면
        
        echo "
            <script type=\"text/javascript\">
                location.href = \"manage_index.html\";
            </script>
            ";
        };
    };
}
?>