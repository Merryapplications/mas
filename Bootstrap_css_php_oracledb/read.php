<?php
session_start();
extract($_GET);

//제목을 말하는 겁니다.
//$id=$_GET["id"];
//글의 번호를 말하는 겁니다.
if(isset($_GET["no"])){
    $no=$_GET["no"];
}else{
    $no=0;
}

?>

<html>
<head>
    <meta charset="UTF-8">
<title>영화 게시판</title>
<style>

<!--
td {font-size : 9pt;}
A:link {font : 9pt; color : black; text-decoration : none;
font-family : 굴림; font-size : 9pt;}
A:visited {text-decoration : none; color : black; font-size : 9pt;}
A:hover {text-decoration : underline; color : black; 
font-size : 9pt;}
-->
</style>
</head>

<body topmargin=0 leftmargin=0 text=#464646>
<center>
<BR>



<?php
    //데이터 베이스 연결하기
    include "db_info.php";

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
    echo "read.php has No Coonncetion".oci_error();
    $_SESSION['error']= "No Connection".oci_error();
    echo("  
            연결 불가
            <script>
              window.alert('read.php 오류');
            </script>
          ");
  exit;
} else {
    //동작이 잘 되고 있습니다.
}

$query = "SELECT * FROM BOARD b, MOVIE m where b.BOARD_NUM=:v_no AND m.MOV_NUM = b.MOVIE_NUM ORDER BY BOARD_NUM DESC";
$result = oci_parse($conn, $query);

oci_bind_by_name($result, ":v_no", $no);
oci_execute($result);
$row=oci_fetch_assoc($result);
?>
<table width=580 border=0 cellpadding=2 cellspacing=1
bgcolor=#777777>
<tr>
    <td height=20 colspan=4 align=center bgcolor=#999999>
        <font color=white><B><?=$row["TITLE"]?></B></font>
    </td>
</tr>
<tr>
    <td width=50 height=20 align=center bgcolor=#EEEEEE>글쓴이</td>
    <td width=240 bgcolor=white><?=$row["CUS_ID"]?></td>
    <td width=50 height=20 align=center bgcolor=#EEEEEE>별점</td>
    <td width=240 bgcolor=white><?=$row["RATING"]?></td>
</tr>
<tr>
    <td width=50 height=20 align=center bgcolor=#EEEEEE>
    날&nbsp;&nbsp;&nbsp;짜</td><td width=240
    bgcolor=white><?=$row["WRITE_DATE"]?></td>
    <td width=50 height=20 align=center bgcolor=#EEEEEE>영화</td>
    <td width=240 bgcolor=white><?=$row["MOV_NAME"]?></td>
</tr>
<tr>
    <td bgcolor=white colspan=4>
    <font color=black>
    <pre><?=$row["CONTENT"]?></pre>
    </font>
    </td>
</tr>
<!-- 기타 버튼 들 -->
<tr>
    <td colspan=4 bgcolor=#999999>
    <table width=100%>
        <tr>
            <td width=200 align=left height=20>
                <a href=list.php?no=<?=$no?>><font color=white>
                [목록보기]</font></a>
                <a href=write.php><font color=white>
                [글쓰기]</font></a>

                <?php
                if($_SESSION["islogon"]=="ok"){
                
                echo("<a href=del.php?no=$no>
                <font color=white>[삭제]</font></a>
                ");

                }
                ?>


            </td>
            <!-- 기타 버튼 끝 -->
            <!-- 이전 다음 표시 -->
            <td align=right>

            </td>
        </tr>
    </table>
    </b></font>
    </td>
</tr>
</table>
</center>
</body>
</html>

<?
   
        // 오라클 접속 닫기 
oci_free_statement($result);
// 오라클에서 로그아웃 
oci_close($conn); 

?>

