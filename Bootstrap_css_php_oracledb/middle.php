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








 	<!-- 점보트론으로 덧입힌 배너부분  -->
 		<div class="container">	
	<!-- 배너 부분입니다. 압축파일의 simple_banner_wrap을 01로 바꿔서합니다.-->
			<p>
					<div class="simple_banner_wrap center-block" data-type="hslide" data-interval="3000">
				
					<ul>
					<li><a target="_parent" href="subframe.php?movie=쥬라기 월드" ><img class="media-object" src="images/쥬라기 월드.jpg"></a></li>
					<li><a target="_parent" href="subframe.php?movie=더 폰" ><img class="media-object" src="images/더폰.jpg"></a></li>
					<li><a target="_parent" href="subframe.php?movie=반지의 제왕 : 왕의 귀환"><img class="media-object" src="images/반지의 제왕.jpg" alt="반지의제왕 사진입니다."></a></li>
					<li><a target="_parent" href="subframe.php?movie=벼랑 위의 포뇨"><img class="media-object" src="images/포뇨.jpg" alt=" 사진입니다."></a></li>
				</div>
			</p>
		</div>






 		<!-- 굳이 맨 아래에 안 해줘도 되지만
 			모달과 슬라이드 그리고 드롭다운 메뉴를 위한 자바스크립트입니다. -->
 		<!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
 	<script src="js/bootstrap.js"></script>


 </body>







 </html>
