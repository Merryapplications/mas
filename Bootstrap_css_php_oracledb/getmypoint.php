<?php
session_start();
//회원만 포인트가 있으므로!
$id=$_SESSION["id"];


$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "Logintest.php has No Coonncetion".oci_error();
	$_SESSION['error']= "No Connection".oci_error();
	echo("	
			연결 불가
	        <script>
	          window.alert('getmoviedate.php 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}
	$query = 'select POINT from CUSTOMER where CUS_ID=:v_id';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_id",$id);
		$result=oci_execute($parse);
	
		while($row = oci_fetch_assoc($parse))
		{
			$mypoint = $row["POINT"];

			}

echo("<h3>".$mypoint."</h3>");
$_SESSION["mypoint"]=$mypoint;
	
// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 



?>