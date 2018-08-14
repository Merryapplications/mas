<?php
session_start();
extract($_GET);

$id = $_GET["id"];
$_SESSION["idtestresult"]="ok";
$_SESSIION["sid"]="not ok";
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

//테이블 이름 CUSTOMER
$query = 'select * from CUSTOMER';

$stmt = oci_parse($conn,$query);

oci_execute($stmt);


while($row = oci_fetch_assoc($stmt))
{
	
    //print_r($row);
    if($row['CUS_ID']==$id)
    {
    	$_SESSION['idtestresult']="not ok";
    	$_SESSION['sid']="not ok";
    	$_SESSION['idtest']="";
    	$idtestresult="not ok";

    	echo("<script>
    		alert('아이디가 중복되었습니다.')</script>");
    	echo("<script> history.go(-1) </script>");
    	exit;


    }
    if($id==""){
    	echo("<script>
    		alert('아이디가 중복이거나 없습니다.')</script>");
    	exit;
    }
     
}

	if( $_SESSION["idtestresult"]="ok"){
	
		$_SESSION['idtest']=$id;
		$_SESSION['sid']="ok";
		
		echo("<script> alert(' $id 가 사용가능 합니다.'); </script>");
		echo("<script> window.location.href='signup.php' </script>");

	}


echo('
	</body></html>');

// 오라클 접속 닫기 
oci_free_statement($stmt);
// 오라클에서 로그아웃 
oci_close($conn); 

?>

