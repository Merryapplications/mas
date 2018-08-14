<?php
session_start();
extract($_GET);

$id = $_GET["id"];
$password=$_GET["password"];
$username=$_GET["username"];

//받아온 값들을 세션에 저장한다.


//변수를 정수로 바꾼다
$ssnnumberstring=$_GET["ssn"];
$ssnnumber=$ssnnumberstring;
$phonestring=$_GET["phone"];
$phone=$phonestring;

$_SESSION["idtestresult"]="ok";
$_SESSIION["sid"]="not ok";
$ssntest ="ok";
$phonetest="ok";
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

try{
oci_execute($stmt);
}catch(Exception $e){

		echo("<script> alert('$e')</script>");
		echo("<script> window.close()</script>");

}

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
    	break;

    }
    if($id==""){
    	echo("<script>
    		alert('아이디가 중복이거나 없습니다.')</script>");
    	break;
    }

    if($row['SSN']==$ssnnumber)
     {
     	$ssntest="not ok";
     	echo("<script>
    		alert('이미 해당 주민번호로 회원 아이디가 있습니다.')</script>");
    	echo("<script> history.go(-1) </script>");
    	break;
     }
      if($row['PHONENUMBER']==$phone)
     {
     	$phonetest="not ok";
     	echo("<script>
    		alert('이미 해당 전화번호로 회원 아이디가 있습니다.')</script>");
    	echo("<script> history.go(-1) </script>");
    	break;
     }


}

	

	if( $_SESSION["idtestresult"]="ok" AND $password[0]==$password[1] AND $ssntest=="ok" AND $phonetest=="ok"){
		//반드시 대문자로 해줘야 한다.
		$sql = "INSERT INTO CUSTOMER (CUS_ID, PASSWORD,CUS_NAME, SSN, PHONENUMBER )  VALUES (:v_id, :v_password,:v_name, :v_ssnnumber, :v_phone)";

		$parse = oci_parse($conn, $sql);
		oci_bind_by_name($parse,":v_id",$id);
		oci_bind_by_name($parse,":v_password",$password[0]);
		oci_bind_by_name($parse,":v_name",$username);
		oci_bind_by_name($parse,":v_ssnnumber",$ssnnumber);
		oci_bind_by_name($parse,":v_phone",$phone);
		


		$result =oci_execute($parse);
		
		$_SESSION["idtestresult"]="not ok";
		$_SESSION["sid"]="not ok";

		echo(" <script> alert(' $id 님 환영합니다.'); window.self.close(); </script> ");
		
	}
	else
	{
		$_SESSION["idtest"]="";
		$_SESSION["idtestresult"]="not ok";
		echo(" <script> alert('회원가입 실패'); window.self.close(); </script> ");

	}


echo('
	</body></html>');

// 오라클 접속 닫기 
oci_free_statement($stmt);
// 오라클에서 로그아웃 
oci_close($conn); 

?>

