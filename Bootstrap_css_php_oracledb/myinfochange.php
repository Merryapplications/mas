<?php
session_start();
//테스팅중...session_destroy();함수를 써서 없애야한다.세션을
$id = $_SESSION['id'];


$dbuser="db";
$dbpass="db";
//$dbsid는 디스크립션을 말하는거네.

//html형식 삭제했다.
echo("<html>
	<head>
 	<meta  charset = 'UTF-8'>
 	<script src='https://code.jquery.com/jquery-3.1.1.min.js'></script>
 	</head>
 	</html>");

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "Logintest.php has No Coonncetion".oci_error();
	$_SESSION['error']= "No Connection".oci_error();
	echo("	
			연결 불가
	        <script>
	          window.alert('logintest.php id = $id ,pass= $password 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}
		//아 이건 왜 또 소문자야? 
		$query = "select * from CUSTOMER";
		$parse = oci_parse($conn,$query);
		//oci_execute를 하면 $parse에 저장되는거지 $result는 true false밖에 안된다.
		$result =oci_execute($parse);

		
		while($row = oci_fetch_assoc($parse)){
			if($row["CUS_ID"]==$id){
			$username = $row["CUS_NAME"];
			$ssnnumber = $row["SSN"];
			$phonenumber=$row["PHONENUMBER"];

			//이곳과 myinfochangetest.php에만 쓰일 것이며, myinfochangetest.php에서 unset을 통해서 없애야한다.
			$_SESSION["info_id"]=$id;
			$_SESSION["info_name"]=$username;
			$_SESSION["info_ssn"]=$ssnnumber;
			$_SESSION["info_phone"]=$phonenumber;

			}
		}

		

echo('
	</body></html>');

// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 


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
 	<script src="js/bootstrap.js"></script>



 	</head>



 <body>
 	<!-- top.html의 회원 가입 버튼을 눌렀을 시 나오는 signup.html입니다. -->
<!-- 데이터베이스에서 아이디 중복 여부를 체크하기 위한 idcheck.php 파일, ssn중복 여부를 체크하는 ssncheck.php와 비밀번호1과 비밀번호2를 체크하는 passwordcheck.php 파일이 필요합니다. -->
<!-- 총 세개의 php 검사를 통과하면 맨 마지막 회원가입 버튼으로 회원 가입을 합니다. -->

 		<div style="text-align:center">

 			<h4>Infomation Change</h4>		
 							
								<br>
								UOS-Cinnenma
								회원 정보 수정 <br><br>
							</div>
							
							<div>
									
									<div>								
										<!-- 세션 확인을 위해 get방식으로 보냈었으나, 확인후 POST방식으로 보냅니다. -->
										<form action="myinfochangetest.php" method="POST"  name="myinfoform" id="myinfoform">
											<div class="form-group">
																	
														<label for='id'>사용자 아이디</label>
														<input type='text' name='id' class='form-control' id='id' value=  '<?php echo("$id") ?>' maxlength='20' disabled>
				
											</div>
											<div class="form-group">
													<label for='password1'>암호</label>
													<input type='password' class='form-control' id='password1' name='password[]' placeholder='암호를 입력하세요.' maxlength='20'>

													<label for='password2'>암호 재입력</label>
													<input type='password' class='form-control' id='password2' name='password[]' placeholder='암호를 다시 입력하세요.' maxlength='20'>
											</div>

											<div class="form-group">
													<label for="username">사용자 이름</label>
													<input type="name" class="form-control" id="username" name="username" 
													value='<?php echo("$username"); ?>' maxlength="10" disabled>

											</div>

											<div class="form-group">					
														<label for='ssn'>사용자 주민등록 번호 </label>
														<input type='text' name='ssn' class='form-control' id='ssn' maxlength='13' value ='<?php echo("$ssnnumber"); ?> ' disabled>
														
											</div>
											<div class="form-group">
														<label for='phone'>사용자 전화 번호 </label>
														<input type='text' name='phone' class='form-control' id='phone' value ='<?php echo("$phonenumber"); ?>' maxlength='11'>
														 
											</div>
											<div style="text-align:right">
											<a href="javascript:self.close();"><button type="submit" class="btn btn-default" >정보 수정</button></a>
											</div>
										</form>
										
									</div>

						</div>
					</div>

</body></html>