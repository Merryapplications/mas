<?php
session_start();


if(!isset($_SESSION["islogon"]) || $_SESSION["islogon"]=="not ok"){
	$_SESSION["islogon"]="not ok";
	$islogon="not ok";
	}
else if($_SESSION["islogon"]=="ok"){
		$islogon="ok";
		$id = $_SESSION["CUS_ID"];
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

<script type="text/javascript">

function loginpopupOpen(){

	var popUrl = "login.php";	//팝업창에 출력될 페이지 URL

	var popOption = "width=600, height=500, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);

	}

	function signuppopupOpen(){

	var popUrl = "signup.php";	//팝업창에 출력될 페이지 URL

	var popOption = "width=600, height=700, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);

	}

	function myinfopopupOpen(){

	var popUrl = "myinfochange.php";	//팝업창에 출력될 페이지 URL

	var popOption = "width=600, height=700, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);

	}
	function myreservepopupOpen(){

	var popUrl = "myreservechange.php";	//팝업창에 출력될 페이지 URL

	var popOption = "width=700, height=700, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);

	}

	function windowclose(){
		window.close();
	}

	function logout(){

		window.reload();
	}

</script>



 	</head>



 <body>



 	<!-- 화면 제일 상단 네비게이션 부분입니다. -->
 	<nav class="navbar-default">
 		<div class="container-fluid" id="topframe">
 			<div class="navbar-header">
 				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
 				data-target="#bs-example-navbar-collapse-1"
 				aria-expanded="false">
 				<span class="sr-only"></span>
 				<!-- 아이콘바는 오른쪽의 네모칸 속 줄 한개 당 한개 -->
 				<span class="icon-bar"></span>
 				</button>
 			<!-- navbar-brand는 가장 왼쪽에 네비게이션의 이름 모양이 된다
 			 -->
 			<a class="navbar-brand" href="mainframe.php" target="_parent">UOS시네마</a>
 			</div>

 		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
 			<ul class="nav navbar-nav">
 				<li><a href="./mainframe.php" target="_parent"> 영화 예매 <span class="sr-only"></span></a></li>
 
 				<li><a href ="./list.php" target="_blank">의견 게시판</a></li>
 				<!-- 
 				드롭다운 클래스를 받으로면 li에 dropdown으로 만들고
 				다시 속에 ul에 드롭다운-메뉴 클래스를 받는다 
 				바디 제일 아랫 부분에 자바스크립트를 추가 시켜줘야 한다.-->
 				<!-- <li class = "dropdown">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">의견 게시판<span class="caret"></span></a>
 					<ul class="dropdown-menu">
 						<li><a href="#">포인트할인</a>
 						</li>
 						<li><a href="#">카드할인</a></li>
 						<li><a href="#">문화의 날</a></li>
 						
 					</ul>
 				</li> -->
 			</ul>

 			<div class="nav navbar-nav navbar-right collapse navbar-collapse">
 				<ul class="nav navbar-nav">
 					<?php
 					
 					if($islogon=="not ok"){
 					echo("<li><a href ='javascript:loginpopupOpen();' class='btn' >로그인</a></li>
 					<li><a href ='javascript:signuppopupOpen();' class='btn'>회원가입</a></li>");
 					}
 					else if($islogon=="ok"){
 					echo("
 						<li><a href='#'> $id 님</a></li>
 						<li><a href ='javascript:myinfopopupOpen();' class='btn'  >내정보수정</a></li>
 						<li><a href ='javascript:myreservepopupOpen();' class='btn'  >예매 내역</a></li>
 						<li><a href ='logout.php' class='btn'>로그아웃</a></li>");
 					}	
 					
 					?>
 				</ul>
 				
 					
 				
 			</div>

 		</div>
	</nav>
</div>





<!-- 모달부분을 팝업창으로 대체해야 하겠습니다.. ㅠㅠ 모달이 더 예쁜데 

<div class="row">
		<div class = "modal" id="modal_login" tabindex="-1">
				<div class ="modal-dialog">
					<div class="modal-content">
						<div class ="modal-header">
							<button class="close" data-dismiss="modal">&times;</button>
							<h4>LOGIN</h4>
						</div>

						<div class="modal-body">
							<div style="text-align:center">
							<br>
							UOS-Cinnenma
							로그인 시 포인트 혜택이 있습니다.<br><br>
							</div>
							<div>
									<div>								
										<form action="main.html" method="POST">
											<div class="form-group">
													<label for="id">사용자 아이디</label>
													<input type="id" name="id" class="form-control" id="id" placeholder="아이디를 입력하세요.">

											</div>
											<div class="form-group">
													<label for="password">암호</label>
													<input type="password" class="form-control" id="password" name="password" placeholder="암호를 입력하세요.">

											</div>
											<div style="text-align:right">
											<button type="submit" class="btn btn-default" >입력</button>
											</div>
										</form>
									</div>

						
							</div>
						</div>

					</div>
				</div>
		</div>
	</div>


<div class="row">
		<div class = "modal" id="modal_signup" tabindex="-1">
				<div class ="modal-dialog">
					<div class="modal-content">
						<div class ="modal-header">
							<button class="close" data-dismiss="modal">&times;</button>
							<h4>SIGN UP</h4>
						</div>

						<div class="modal-body">
							<div style="text-align:center">
							<br>
							UOS-Cinnenma
							회원가입은 언제나 환영입니다.<br><br>
							</div>
							<div>
									<div>								
										<form action="main.html" method="POST">
											<div class="form-group">
													<label for="userid">사용자 아이디</label>
													<input type="id" name="userid" class="form-control" id="userid" placeholder="아이디를 입력하세요.">

											</div>
											<div class="form-group">
													<label for="password1">암호</label>
													<input type="password" class="form-control" id="password1" name="password1" placeholder="암호를 입력하세요.">

											</div>
											<div class="form-group">
													<label for="password2">암호 재입력</label>
													<input type="password" class="form-control" id="password2" name="password2" placeholder="암호를  다시 입력하세요.">

											</div>
											<div class="form-group">
													<label for="username">이름</label>
													<input type="id" name="username" class="form-control" id="username" placeholder="이름을 입력하세요.">

											</div>
											<div class="form-group">
													<label for="phonenumber">전화번호</label>
													<input type="id" name="phonenumber" class="form-control" id="phonenumber" placeholder="전화번호를 입력하세요.">

											</div>
											<div class="form-group">
													<label for="useremail">이메일</label>
													<input type="id" name="useremail" class="form-control" id="useremail" placeholder="이메일을 입력하세요.">

											</div>
											<div style="text-align:right">
											<button type="submit" class="btn btn-default" >입력</button>
											</div>
										</form>
									</div>
						
							</div>
						</div>

					</div>
				</div>
		</div>
	</div>






 -->













 	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
 	<script src="js/bootstrap.js"></script>

 	</body>

 </html>