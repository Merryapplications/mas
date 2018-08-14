
<html>
<head>
<title>관리자 페이지</title>
<meta charset='UTF-8'>
<?php
	session_start();
	extract($_POST);
	if(isset($_POST['password'])) {
		$testpassword=$_POST['password'];
		$password="1234";
		if($testpassword == $password)
			$_SESSION["admin"] = true;
		else {
			echo("<script>alert('비밀번호가 일치하지 않습니다!'); window.history.back();");
			unset($_SESSION['admin']);
		}
	}
?>
</head>
<body>
<?php
	if($_SESSION["admin"]) {
		echo("
			<div style='text-align:center'>
				<h2>UOS 시네마 관리자 페이지</h2>
				<br>
				<h4> 원하는 작업을 선택하세요. </h4>
				<br>
				<h5><a href='admin-customer-list.php'><button type='btn'>고객 정보 수정</button></a></h5> 
				<h5><a href='#'><button type='btn'>상영 정보 수정</button></a></h5> 
				<h5><a href='admin-movie-list.php'><button type='btn'>영화 정보 수정</button></a></h5> 
				<h5><a href='admin-sales-report.php'><button type='btn'>매출 정보 조회</button></a></h5> 
				<h5><a href='admin-theater-list.php'><button type='btn'>상영관 정보 수정</button></a></h5> 
			</div>
		");
	}
?>
</body>
</html>
