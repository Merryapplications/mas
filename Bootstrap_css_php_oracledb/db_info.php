<?php

function getmovienum($movie){

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "xlogintext.php has No Coonncetion".oci_error();
	$_SESSION['error']= "No Connection".oci_error();
	echo("	
			연결 불가
	        <script>
	          window.alert('xlogintest.php 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}
//일단 자동으로 movie의 제목을 movie num으로 바꿉니다
$query = 'select MOV_NAME, MOV_NUM from MOVIE';

		$parse = oci_parse($conn,$query);
		$result=oci_execute($parse);
	
		//어차피 한 개이기 때문에 그냥 이렇게 한다.
		while($row = oci_fetch_assoc($parse)){
			if($row["MOV_NAME"]==$movie)
				{$movienum=$row["MOV_NUM"];}
			}
		
return $movienum;
		// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 


}
		

?>