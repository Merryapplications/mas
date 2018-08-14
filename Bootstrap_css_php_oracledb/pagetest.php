<?php

echo("php 동작 실행 여부 판단");

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
	<!-- 더 이상 작동하지 않는 라이브러리네....
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
	-->
	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/simpleBanner.js"></script>

</head>

<body>
	<br>

	안녕하세요 html 테스트입니다.
	<div style="text-align:center">

 			<h4>Sign Up</h4>		
 							
								<br>
								UOS-Cinnenma
								회원가입을 환영합니다.<br><br>
							</div>
							
							<div>
									
									<div>								
										<!-- 세션 확인을 위해 get방식으로 보냈었으나, 확인후 POST방식으로 보냅니다. -->
										<form action="testreceiver.php" method="GET" target="topframe" name="signupform">
											<div class="form-group">
													<label for="id">사용자 아이디</label>
													<input type="id" name="id" class="form-control" id="id" placeholder="아이디를 입력하세요.">
													&nbsp&nbsp&nbsp&nbsp <button class="btn btn-default">아이디 중복 확인</button>

											</div>
											<div class="form-group">
													<label for="password1">암호</label>
													<input type="password" class="form-control" id="password1" name="password1" placeholder="암호를 입력하세요.">

											</div>
											<div class="form-group">
													<label for="password2">암호</label>
													<input type="password" class="form-control" id="password2" name="password2" placeholder="암호를 다시 입력하세요.">

											</div>

											<div class="form-group">
													<label for="username">사용자 이름</label>
													<input type="name" class="form-control" id="username" name="username" placeholder="이름을 입력하세요.">

											</div>

											<div class="form-group">
													<label for="useremail">사용자 이메일</label>
													<input type="email" name="useremail" class="form-control" id="useremail" placeholder="이메일을 입력하세요.">
													&nbsp&nbsp&nbsp&nbsp <button class="btn btn-default">이메일 중복 확인</button>
											</div>

											<div style="text-align:right">
											<a href="javascript:self.close();"><button type="submit" class="btn btn-default" >회원 가입</button></a>

										</form>
										
									</div>

						</div>
					</div>

	</body>
	</html>