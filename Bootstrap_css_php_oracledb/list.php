<?php
//데이터 베이스 연결하기
extract($_GET);
# LIST 설정
# 1. 한 페이지에 보여질 게시물의 수
$page_size=10;

# 2. 페이지 나누기에 표시될 페이지의 수
// $no는 페이지가 시작되는 첫 글의 순번이다.
$page_list_size = 10;
if(isset($_GET["no"]))
    {
    $no = $_GET["no"];
}else{
    $no =0;
}
//아 여기서 초기화를 시키는구나
if (!$no || $no <0) $no=0;


$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
    echo "xlogintext.php has No Coonncetion".oci_error();
    $_SESSION['error']= "No Connection".oci_error();
    echo("  
            연결 불가
            <script>
              window.alert('list.php 오류');
            </script>
          ");
  exit;
} else {
    //동작이 잘 되고 있습니다.
}



// 데이터베이스에서 페이지의 첫번째 글($no)부터 
// $page_size 만큼의 글을 가져온다.



//본래 list.php 오더바이 ID였는데 order by board_num으로 교체
$query = "SELECT * FROM BOARD ORDER BY BOARD_NUM DESC";
$result = oci_parse($conn, $query);
oci_execute($result);

// 총 게시물 수 를 구한다. // 다시해 볼것
$aquery="SELECT count(*) ct FROM board"; 
$result_count=oci_parse($conn,$aquery);
oci_execute($result_count);
$result_row=oci_fetch_array($result_count);
$total_row = $result_row[0];
//결과의 첫번째 열이 count(*) 의 결과다.
//mysql_fetch_row 쓰면 $result_row[0] 처럼 숫자를 써서 접근을 해야한다. 

# 총 페이지 계산
# ceil는 올림이다. 
if ($total_row <= 0) $total_row = 0;
$total_page = ceil($total_row / $page_size);//1개면

# 현재 페이지 계산
# no 변수는 0부터 시작해서 +1을 해줌.
$current_page = ceil(($no+1)/$page_size);

?>


<html>
<head>
    <meta charset="UTF-8">
<title>영화 게시판 </title>
<style>
<!--
td {font-size : 9pt;}
A:link {font : 9pt;color : black;text-decoration : none; fontfamily
: 굴림;font-size : 9pt;}
A:visited {text-decoration : none; color : black; font-size : 9pt;}
A:hover {text-decoration : underline; color : black; font-size : 9pt;}
-->
</style>
</head>
<body topmargin=0 leftmargin=0 text=#464646>
<center>
<BR>
<!-- 게시판 타이틀 -->
<font size=2>영화 게시판</a>
<BR>
<BR>
<!-- 게시물 리스트를 보이기 위한 테이블 -->
<table width=580 border=0 cellpadding=2 cellspacing=1
bgcolor=#777777>
<!-- 리스트 타이틀 부분 -->
<tr height=20 bgcolor=#999999>
    <td width=30 align=center>
        <font color=white>번호</font>
    </td>
    <td width=370 align=center>
        <font color=white>제 목</font>
    </td>
    <td width=50 align=center>
        <font color=white>글쓴이</font>
    </td>
    <td width=60 align=center>
        <font color=white>날 짜</font>
    </td>
    <td width=40 align=center>
        <font color=white>평점</font>
    </td>
</tr>
<!-- 리스트 타이틀 끝 -->
<!-- 리스트 부분 시작 -->


<?php
while($row=oci_fetch_assoc($result))
{

echo("
<tr>
    <td height=20 bgcolor=white align=center>
        <a href=read.php?no=".$row['BOARD_NUM'].">".$row["BOARD_NUM"]."</a>
    </td>
");
 echo("
    <td height=20 bgcolor=white>&nbsp;
        <a href=read.php?no=".$row['BOARD_NUM'].">".$row['TITLE']."</a>
    </td>");

echo("
    <td align=center height=20 bgcolor=white>
        <font color=black>
        ".$row['CUS_ID']."
        </font>
    </td>");
echo("
    <td align=center height=20 bgcolor=white>
        <font color=black>".$row['WRITE_DATE']."</font>
    </td>");
echo("  
    <td align=center height=20 bgcolor=white>
        <font color=black>".$row['RATING']."</font>
    </td>
</tr>");

} // end While
//데이터베이스와의 연결을 끝는다.

// 오라클 접속 닫기 
oci_free_statement($result);
// 오라클에서 로그아웃 
oci_close($conn); 


?>

</table>
<!-- 게시물 리스트를 보이기 위한 테이블 끝-->
<!-- 페이지를 표시하기 위한 테이블 -->
<table border=0>
<tr>
    <td width=600 height=20 align=center rowspan=4>
    <font color=gray>
    &nbsp;


<?php
$start_page = floor(($current_page - 1) / $page_list_size) * $page_list_size + 1;
// floor 함수는 소수점 이하는 버림

// 페이지 리스트의 마지막 페이지가 몇 번째 페이지인지 구하는 부분이다.
$end_page = $start_page + $page_list_size - 1;

if ($total_page <$end_page) $end_page = $total_page;

if ($start_page >= $page_list_size) {
    // 이전 페이지 리스트값은 첫 번째 페이지에서 한 페이지 감소하면 된다.
    // $page_size 를 곱해주는 이유는 글번호로 표시하기 위해서이다.

    $prev_list = ($start_page - 2)*$page_size;
    echo "<a href="."list.php?no=".$prev_list.">◀</a> ";
}

// 페이지 리스트를 출력
for ($i=$start_page;$i <= $end_page;$i++) {
    $page= ($i-1) * $page_size;// 페이지값을 no 값으로 변환.
    if ($no!=$page){ //현재 페이지가 아닐 경우만 링크를 표시
        echo "<a href=list.php?no=".$page.">";
    }
    
    echo " $i "; //페이지를 표시
    
    if ($no!=$page){ //현재 페이지가 아닐 경우만 링크를 표시하기 위해서
        echo "</a>";
    }
}

// 다음 페이지 리스트가 필요할때는 총 페이지가 마지막 리스트보다 클 때이다.
// 리스트를 다 뿌리고도 더 뿌려줄 페이지가 남았을때 다음 버튼이 필요할 것이다.
if($total_page >$end_page)
{
    $next_list = $end_page * $page_size;
    echo "<a href=$PHP_SELF?no=$next_list>▶</a><p>";
}
?>
    </font>
    </td>
</tr>
</table>
<a href=write.php>글쓰기</a>
</center>
</body>
</html>