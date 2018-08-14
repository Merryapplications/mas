<?PHP
	session_start();
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
	<script src="js/bootstrap.js"></script>
 	</head>

 <body>
 
 <?PHP 
 	$movie=$_SESSION['movie'];
 	if($movie=="반지의 제왕 : 왕의 귀환"){
 		$movie="ring";
 		$_SESSION["movie"]=$movie;
 	}else if($movie=="벼랑 위의 포뇨"){
 		$movie="pono";
 		$_SESSION["movie"]=$movie;
 	}else if($movie=="더 폰")
 	{
 		$movie="phone";
 		$_SESSION["movie"]=$movie;
 	}else if($movie=="쥬라기 월드 : 폴른 킹덤"){
 		$movie="쥬라기 월드";
 		$_SESSION["movie"]=$movie;
 	}
 	?>
 	<br>
 	<div style="text-align:center;">
 	<img src=' <?php echo("images/$movie.jpg")?>'>
 	</div>

 </body>
 </html>