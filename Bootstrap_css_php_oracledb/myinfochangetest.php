<?php
session_start();
extract($_POST);

$id = $_SESSION["info_id"];
$username = $_SESSION["info_name"];
$ssnnumber=$_SESSION["info_ssn"];

$phone = $_POST["phone"];
$password=$_POST["password"];

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


	if($password[0]==$password[1] && $password[0]!=""){
		
		//테이블 이름 CUSTOMER
		$query = 'UPDATE CUSTOMER  SET PASSWORD = :v_password, PHONENUMBER=:v_phone WHERE CUS_ID = :v_id';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_id",$id);
		oci_bind_by_name($parse,":v_password",$password[0]);
		oci_bind_by_name($parse,":v_phone",$phone);
		$result =oci_execute($parse);
		if($result=="1"){
			unset($_SESSION['info_name']);
			unset($_SESSION['info_phone']);
			unset($_SESSION['info_id']);
			unset($_SESSION['info_ssn']);
		echo(" <script> alert(' $id 님 정보 변경 완료하였습니다.'); window.self.close(); </script> ");
		}
	}
	else
	{
		echo(" <script> alert('회원 정보 변경 실패 '); window.self.close(); </script> ");

	}


echo('
	</body></html>');

// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 

?>

