<?php
session_start();
//데이터 베이스 연결하기
include "db_info.php";
$cusid=$_SESSION["CUS_ID"];
$no = $_GET["no"];

//작성자의 id는 글 제목이다. 글 제목의 작성자가 지금의 세션아이디와 같으면 삭제시킨다.

echo("<html><head><meta charset='UTF-8'></head></html>");


$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
    echo "del.php has No Coonncetion".oci_error();
    $_SESSION['error']= "No Connection".oci_error();
    echo("  
            연결 불가
            <script>
              window.alert('del.php 연결 오류');
            </script>
          ");
  exit;
} else {
    //동작이 잘 되고 있습니다.
}


$query = "SELECT * FROM BOARD where BOARD_NUM =:v_num ORDER BY BOARD_NUM DESC";
$result = oci_parse($conn, $query);
oci_bind_by_name($result, ":v_num", $no);
oci_execute($result);

$row=oci_fetch_array($result);


if ($cusid==$row["CUS_ID"] )//사용자 맞는지 확인함.
{
    $query = "DELETE FROM board WHERE BOARD_NUM=:v_num"; //데이터 삭제하는 쿼리문
    $result=oci_parse($conn, $query);
    oci_bind_by_name($result, ":v_num", $no);
    oci_execute($result);
}
else
{
    echo ("
    <script>
    alert('작성자가 아닙니다.');
    history.go(-1);
    </script>
    ");
    exit;
}
?>
<center>
<meta http-equiv='Refresh' content='1; URL=list.php'>
<FONT size=2 >삭제되었습니다.</font>
