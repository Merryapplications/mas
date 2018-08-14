<?php
session_start();
//테스팅중...session_destroy();함수를 써서 없애야한다.세션을

//회원가입시 필요한 세션변수
if($_SESSION["idtest"]=="ok" || $_SESSION["sid"]=="ok")
{

}else
{
$_SESSION["idtestresult"]="default";
$_SESSION["idtest"]="default";
$_SESSION["sid"]="default";
}
if(isset($_SESSION["ssntestresult"])){

}else
{

$_SESSION["ssntestresult"]="default";
$_SESSION["ssntest"]="default";
$_SESSION["sssn"]="default";
}
if(isset($_SESSION["phonetestresult"])){

}else
{

$_SESSION["phonetestresult"]="default";
$_SESSION["phonetest"]="default";
$_SESSION["sphone"]="default";
}


if(isset($_SESSION["passtestresult"])){

}else
{
$_SESSION["passtestresult"]="default";
$_SESSION["passtest"]="default";
$_SESSION["spass"]="default";
}



function unsetall(){
$_SESSION["idtestresult"]="default";
$_SESSION["idtest"]="default";
$_SESSION["sid"]="default";


$_SESSION["ssntestresult"]="default";
$_SESSION["ssntest"]="default";
$_SESSION["sssn"]="default";


$_SESSION["phonetestresult"]="default";
$_SESSION["phonetest"]="default";
$_SESSION["sphone"]="default";

}

function unsetid(){
$_SESSION["idtestresult"]="default";
$_SESSION["idtest"]="default";
$_SESSION["sid"]="default";
}

function unsetpass(){
$_SESSION["passtestresult"]="default";
$_SESSION["passtest"]="default";
$_SESSION["spass"]="default";
}


function unsetssn(){

$_SESSION["ssntestresult"]="default";
$_SESSION["ssntest"]="default";
$_SESSION["sssn"]="default";
}

function unsetphone(){
$_SESSION["phonetestresult"]="default";
$_SESSION["phonetest"]="default";
$_SESSION["sphone"]="default";
}


?>

<!doctype>
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


<!-- 폼 하나에 버튼이 두개이므로 각각 버튼마다 다른 html에 값을 보내려고 한다. -->

<script>
	function idtest(){
		var username = document.signupform.id.value;
		//html파일로 보낼 것이면 이렇게 한다.
		//php 파일로 보낼 것이면 또 다르게 해야겠지.
		document.signupform.action="idtest.php"

	}
	function passtest(){
		document.signupform.action="passtest.php"
	}

	function ssntest(){
		var userssn = document.signupform.ssn.value;
		document.signupform.action="ssntest.php"
	}
	function phonetest(){
		var userssn = document.signupform.phone.value;
		document.signupform.action="phonetest.php"
	}

	function unsetall(){

	}

	function passwordtest(){
		var password1 = document.signupform.password1.value;
		var password2 = document.signupform.password2.value;
		if(password1==pasword2){
			return true;
		}
	}

</script>


 	</head>



 <body>
 	<!-- top.html의 회원 가입 버튼을 눌렀을 시 나오는 signup.html입니다. -->
<!-- 데이터베이스에서 아이디 중복 여부를 체크하기 위한 idcheck.php 파일, ssn중복 여부를 체크하는 ssncheck.php와 비밀번호1과 비밀번호2를 체크하는 passwordcheck.php 파일이 필요합니다. -->
<!-- 총 세개의 php 검사를 통과하면 맨 마지막 회원가입 버튼으로 회원 가입을 합니다. -->

 		<div style="text-align:center">

 			<h4>Sign Up</h4>		
 							
								<br>
								UOS-Cinnenma
								회원가입을 환영합니다.<br><br>
							</div>
							
							<div>
									
									<div>								
										<!-- 세션 확인을 위해 get방식으로 보냈었으나, 확인후 POST방식으로 보냅니다. -->
										<form action="new_customer.php" method="GET"  name="signupform" id="signupform">
											<div class="form-group">
													
													<?php
													if($_SESSION["idtestresult"]=="ok" OR $_SESSION["sid"]=="ok")
													{
														
														$id=$_SESSION["idtest"];
														echo(" <label for='id'>사용자 아이디</label>
														<input type='text' name='id' class='form-control' id='id' value= '$id'   >
														 <div style='text-align:center;'> <button class='btn btn-default' onClick='idtest()' >아이디를 다시 검색하려면 누르세요.</button></div>
														 ");
														

													}
													else if(  $_SESSION["idtestresult"]==="default" || $_SESSION["idtestresult"]==="not ok"||$_SESSION["sid"]==="not ok"){
														echo("
														<label for='id'>사용자 아이디 </label>
														<input type='text' name='id' class='form-control' id='id' placeholder=' 아이디를 입력하세요.''>
														 <div style='text-align:center;'> <button class='btn btn-default' onClick='idtest()'>아이디 확인 중복 하세요.</button></div>
														 ");
														}
													
													?>
													
												

											</div>
											<div class="form-group">

												<?php
													if($_SESSION["passtestresult"]=="ok")
													{
														$passtestresult=$_SESSION["passtestresult"];
														$password=$_SESSION["passtest"];
														echo(" <label for='password'>사용자 아이디</label>
														<input type='password' name='password' class='form-control' id='password' value= '$password'   >
														 <div style='text-align:center;'> <button class='btn btn-default' >비밀번호 사용 가능</button></div>
														 ");
														$_SESSION["spassword"]="ok";

													}
													else if(  $_SESSION["passtestresult"]=="default" || $_SESSION["passtestresult"]=="not ok"){
														echo("
														<label for='password1'>암호</label>
													<input type='password' class='form-control' id='password1' name='password[]' placeholder='암호를 입력하세요.'>

													<label for='password2'>암호 재입력</label>
													<input type='password' class='form-control' id='password2' name='password[]' placeholder='암호를 다시 입력하세요.'>
														 <div style='text-align:center;'> <button class='btn btn-default' onClick='passtest()'>비밀번호 확인 </button></div>
														 ");
														}
													
													?>

													




											</div>

											<div class="form-group">
													<label for="username">사용자 이름</label>
													<input type="name" class="form-control" id="username" name="username" placeholder="이름을 입력하세요.">

											</div>

											<div class="form-group">
													<?php
													if($_SESSION["ssntestresult"]=="ok")
													{
														$ssntestresult=$_SESSION["ssntestresult"];
														$ssn=$_SESSION["ssntest"];
														echo(" <label for='ssn'>사용자 주민등록 번호</label>
														<input type='text' name='ssn' class='form-control' id='ssn' value= '$ssn'   >
														 <div style='text-align:center;'> <button class='btn btn-default' >주민등록 번호 사용 가능</button></div>
														 ");
														$_SESSION["sssn"]="ok";

													}
													else if(  $_SESSION["ssntestresult"]=="default" || $_SESSION["ssntestresult"]=="not ok"){
														echo("
														<label for='ssn'>사용자 주민등록 번호 </label>
														<input type='text' name='ssn' class='form-control' id='ssn' placeholder=' - 제외 숫자만 입력하세요.''>
														 <div style='text-align:center;'> <button class='btn btn-default' onClick='ssntest()'>주민등록 번호 중복 확인</button></div>
														 ");
														}
													
													?>
											</div>

											<div class="form-group">
													<?php
													if($_SESSION["phonetestresult"]=="ok" )
													{
														$phonetestresult=$_SESSION["phonetestresult"];
														$phone=$_SESSION["phonetest"];
														echo(" <label for='phone'>사용자 전화 번호</label>
														<input type='text' name='phone' class='form-control' id='phone' value= '$phone'   >
														 <div style='text-align:center;'> <button class='btn btn-default' >전화 번호 사용 가능</button></div>
														 ");
														$_SESSION["sphone"]="ok";

													}
													else if(  $_SESSION["phonetestresult"]=="default" || $_SESSION["phonetestresult"]=="not ok"){
														echo("
														<label for='phone'>사용자 전화 번호 </label>
														<input type='text' name='phone' class='form-control' id='phone' placeholder=' - 제외 숫자만 입력하세요.''>
														 <div style='text-align:center;'> <button class='btn btn-default' onClick='phonetest()'>전화 번호 중복 확인</button></div>
														 ");
														}
													
													?>
											</div>

											<div style="text-align:right">


											<a href="javascript:self.reload();"><button class="btn btn-default" onclick="document.write('<?php unsetall(); ?>') " >정보 초기화</button></a>
											<a href="javascript:self.close();"><button type="submit" class="btn btn-default" >회원 가입</button></a>
											</div>
										</form>
										
									</div>

						</div>
					</div>





 		<!-- 굳이 맨 아래에 안 해줘도 되지만
 			모달과 슬라이드 그리고 드롭다운 메뉴를 위한 자바스크립트입니다. -->
 		<!--  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
 	<script src="js/bootstrap.js"></script>
</body></html>