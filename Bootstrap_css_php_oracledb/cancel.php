<?php
session_start();
extract($_GET);
$tinum = $_GET["tinum"];



$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "cancel.php has No Coonncetion".oci_error();
	echo("	
			연결 불가
	        <script>
	          window.alert'cancel.php 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}




$query = 'DELETE from TICKET where TI_NUM = :v_tinum';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse, "v_tinum", $tinum);
		$result=oci_execute($parse);

		if($result==true){
			echo("<script> history.go(-1);</script>");
		}

// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 

?>