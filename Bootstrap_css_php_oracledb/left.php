<?php
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

<!doctype html>
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
	<!-- 더 이상 작동하지 않는 라이브러리네....
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
	-->
	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/simpleBanner.js"></script>



 	</head>


<body>
<div style="text-align: center"><h1>
	전체 영화 목록
<br>
</h1></div>
<table class="table table-striped table-bordered" style="text-align: center;">
	<thead class="thead-dark">
		<th scope="col">영화 이름</th>
		<th scope="col">러닝 타임</th>
		<th scope="col">연령 제한</th>
		<th scope="col">예매 버튼</th>
	</thead>
	<tbody>
		<?php
$query = 'select * from MOVIE ';

		$parse = oci_parse($conn,$query);
		$result=oci_execute($parse);


		//어차피 한 개이기 때문에 그냥 이렇게 한다.
		while($row = oci_fetch_assoc($parse)){
			if($row["WATCH_AGE"]==0)
				$row["WATCH_AGE"]="전체 관람";
			echo("<tr> <th scope="."col".">".$row["MOV_NAME"]."</th>"."<th scope="."col".">".$row["SCREEN_TIME"]."분</th>"."<th scope="."col".">".$row["WATCH_AGE"]."</th>"."<th scope="."col".">"."<a target ='_parent' href='subframe.php?movie=".$row["MOV_NAME"]."'><button class='btn btn-info'>"."예 매</button></a></th></tr>");
		


				
			}

		
		
		
		echo("</tbody>");


// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 


?>
	</tbody>
</table>

 </body>



 </html>
