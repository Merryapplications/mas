<?php
session_start();
extract($_GET);

$phone = $_GET["phone"];
$phonetestresult="default";
$_SESSION["phonetestresult"]=$phonetestresult;

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
	echo "phonetest.php has No Coonncetion".oci_error();
	$_SESSION['error']= "No Connection".oci_error();
	echo("	
			연결 불가
	        <script>
	          window.alert('phonetest.php 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}

//테이블 이름 CUSTOMER
$query = 'select * from CUSTOMER';

$stmt = oci_parse($conn,$query);

oci_execute($stmt);


while($row = oci_fetch_assoc($stmt))
{
	
    //print_r($row);
    if($row['PHONENUMBER']==$phone)
    {
    	$_SESSION['phonetestresult']="not ok";
    	$phonetestresult="not ok";

    	echo("<script>
    		alert('전화번호가 중복되었습니다.')</script>");
    	echo("<script> history.go(-1) </script>");
    	break;

    }

     if($phone==""){
     	//정규화를 통한 예외처리가 필요
    	echo("<script>
    		alert('전화번호가 없습니다.')</script>");
    	break;
    }
     
}

	if($phonetestresult=="default"){
		$_SESSION['phonetestresult']="ok";
		$_SESSION['phonetest']=$phone;
		$phonetestresult="ok";
		echo("<script> alert(' $phone 가 사용가능 합니다.'); </script>");
		echo("<script> history.go(-1); </script>");

	}


echo('
	</body></html>');

// 오라클 접속 닫기 
oci_free_statement($stmt);
// 오라클에서 로그아웃 
oci_close($conn); 

?>

