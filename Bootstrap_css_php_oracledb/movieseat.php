<?PHP
	session_start();
	extract($_POST);
	extract($_GET);
	$scrsch_num = $_SESSION["scrsch_num"];
	//SCRSCH 테이블의 상영 번호를 받아온다.
	//상영 번호를 기준으로 이름과 상영관을 찾는다.

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



<!-- 좌석을 선택하는 부분 -->
<br>
		<div class="container">
				<div style="text-align: center;">
					<img class="imgcenter" src="images/moviesilhouette.jpeg">
					<h2>SCREEN</h2>
					<div style="width:1200px; margin: auto;">
					<?PHP
					include("seatselect.php");

						/*
						
						$movie=$_SESSION['movie'];
						$date=$_SESSION['date'];
						$theater=$_SESSION['theater'];
						$id=$_SESSION['id'];
						$password=$_SESSION['password'];
						
						echo("세션유지 성공입니다. <br> 아이디 : $id <br> password : $password <br> 영화 : $movie <br> 일시 : $date <br> 상영관 : $theater<br>");

						*/
					?>
					
					<!-- 
							php를 통해 상영관 별 좌석 수를 받아와야 하며, 각 좌석의 예매 여부를 판단해 사용자가 클릭을 못하게 해야한다.
							부트스트랩의 체크 버튼을 이용한다.
					
					아래 부분에 seat.php 파일을 삽입하여서 버튼들을 만들 예정입니다.

					 -->
					<!-- 먼저 데이터베이스와 연동하여 좌석의 현황을 받아옵니다. -->


				</div>
				
				</div>
			
		</div>












 		<!-- 굳이 맨 아래에 안 해줘도 되지만
 			모달과 슬라이드 그리고 드롭다운 메뉴를 위한 자바스크립트입니다. -->
 		<!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
 	<script src="js/bootstrap.js"></script>


</body>





</html>
