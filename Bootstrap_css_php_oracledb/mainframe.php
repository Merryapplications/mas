<?PHP
	session_start();
	/*$_SESSION['id']="SessionUser";
	$_SESSION['password']="SessionPassword";
	$test = "test";*/
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

 
 	<frameset rows="6%, 88%, 6%" border=0 name="totalframe">
 		<frame width="100%" height="5%" marginheight="0" marginwidth="0" src="top.php" name="topframe" scrolling="no"></frame>
 			<frameset cols="40%, 35%, 40%">
 				<frame  marginheight="0" marginwidth="0" src="left.php" name="leftframe" scrolling="no"></frame>
 				<frame  marginheight="0" marginwidth="0" src="middle.php" name="middleframe" scrolling="no"></frame>
 				<frame  marginheight="0" marginwidth="0" src="right.php" name="rightframe" scrolling="no"></frame>
 			</frameset>
 		<frame marginheight="0" marginwidth="0" src="bottom.php" name="bottomframe"></frame>
 	</frameset>


</html>
