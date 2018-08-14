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

<script type="text/javascript">

function selfclose(){
	window.close();
}


</script> 
</head>



 	<body>

 		<div style="text-align:center">

 			<h4>X-Sign UP</h4>		
 							
								<br>
								UOS-Cinnenma
								회원가입 시 포인트 혜택이 있습니다.<br><br>
							</div>
							
							<div>
									
									<div>								
										<form action="xlogintest.php" method="POST" >
											<div class="form-group">
													<label for="xid">전화 번호</label>
													<input type="id" name="xid" class="form-control" id="xid" placeholder="-제외 를 입력하세요." maxlength="11">

											</div>
											<div class="form-group">
													<label for="password">암호</label>
													<input type="password" class="form-control" id="password[]" name="password[]" placeholder="암호를 입력하세요.">
													<br>
													<input type="password" class="form-control" id="password[]" name="password[]" placeholder="암호를 다시 입력하세요.">

											</div>
											<div style="text-align:right">
											<button type="submit" class="btn btn-default" >간편 회원 가입</button> &nbsp&nbsp&nbsp&nbsp&nbsp

										</form>
										
									</div>

						</div>
					</div>
				

	</body>
</html>