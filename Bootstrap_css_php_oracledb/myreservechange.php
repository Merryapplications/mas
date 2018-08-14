<?php
session_start();
$id=$_SESSION['CUS_ID'];

function ticketgetdate($scrschnum){
$dbuser="db";
$dbpass="db";

$conn1 = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn1) {
	echo "getdat function has No Coonncetion".oci_error();
	echo("	
			연결 불가 myreservechange.php의 getdatefunction오류
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}
$query = 'select SCR_START_TIME from SCRSCH where SCRSCH_NUM=:v_schnum';

		$parse = oci_parse($conn1,$query);
		oci_bind_by_name($parse, "v_schnum", $scrschnum);
		$result=oci_execute($parse);
		$row = oci_fetch_assoc($parse);
		$scrstarttime=$row["SCR_START_TIME"];


// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn1); 
	return $scrstarttime;
}



//자신의 예매 내역을 조회해 취소할 수 있는 기능
$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "xlogintext.php has No Coonncetion".oci_error();
	echo("	
			연결 불가
	        <script>
	          window.alert('xlogintest.php 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}

?>


<html>
 <head>
 	<meta  charset = "UTF-8">

 	<!--
 	링크를 이용하여 외부 파일을 가져옵니다
 	현재위치/css/bootstrap.css파일을 이용하여 가져옵니다.
 	-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 	
 	<!-- 내가 만든 test.css를 가져온다.
 		폰트와 배너의 크기지정이 들어있다. -->
 	<link rel="stylesheet" type="text/css" href="css/test.css">
 	
 	<!-- 슬라이드 배너를 만들기 위한 링크입니다. -->
 	<link rel="stylesheet" href="css/simpleBanner.css">
	
	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/simpleBanner.js"></script>

</head><body>
	
<table class="table table-striped table-bordered" style="text-align: center;">
	<thead class="thead-dark">
		<th scope="col">영화 제목</th>
		<th scope="col">시작 시간</th>
		<th scope="col">지불 가격</th>
		<th scope="col">좌석 번호</th>
		<th scope="col">취소 버튼</th>
	</thead>
	<tbody>

<?php
$query = 'select * from TICKET t, SCRSCH s, MOVIE m where t.CUS_ID=:v_id AND t.SCRSCH_NUM = s.SCRSCH_NUM AND s.MOVIE_NUM = m.MOV_NUM';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse, "v_id", $id);
		$result=oci_execute($parse);


		//어차피 한 개이기 때문에 그냥 이렇게 한다.
		while($row = oci_fetch_assoc($parse)){
			$tinum=$row["TI_NUM"];
			$representdate=ticketgetdate($row["SCRSCH_NUM"]);

			//문자열 자르기 : 배열로 저장된다.
			$strTok =explode('/' , $row["SEAT_NUM"]);
			$representseatrow = $strTok[0]+1;
			$representseatcol = $strTok[1]+1;
			
			$seatnum="행 : ".$representseatrow.",열 : ".$representseatcol;

			echo("<tr> <th scope="."col".">".$row["MOV_NAME"]."</th>"."<th scope="."col".">".$representdate."</th>"."<th scope="."col".">".$row["TI_SELL_PRICE"]."</th>"."<th scope="."col".">".$seatnum."</th>"."<th scope="."col".">"."<a href='cancel.php?tinum=$tinum'>"."<button class='btn btn-info'>"."취 소</button></a></th></tr>");
		


				
			}

		
		
		
		echo("</tbody>");


// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 


?>