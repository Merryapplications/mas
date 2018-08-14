<?php
session_start();
extract($_GET);

$id = $_GET["id"];
$password = $_GET["password"];
$islogon="default";
$dbuser="db";
$dbpass="db";
//$dbsid는 디스크립션을 말하는거네.

//html형식 삭제했다.
echo("<html>
	<head>
 	<meta  charset = 'UTF-8'>
 	<script src='https://code.jquery.com/jquery-3.1.1.min.js'></script>

 	</head>
 	<body>");

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
    if($row['CUS_ID']==$id && $row['PASSWORD']==$password)
    {
    	$_SESSION['islogon']="ok";
    	$_SESSION['CUS_ID']=$id;
    	$_SESSION['id']=$id;
    	$islogon="ok";

    	/*echo("
	        <script language=javascript>
	         	window.alert('logintest.php id = $id ,pass= $password Login Success '); 
	        </script>
	      ");*/

	      //일단 부모 새로고침은 된다.

    	echo("
	        <script>

	        	opener.parent.location.reload();
	        
	        </script>
	      ");


    	echo("
	        <script language=javascript>
	         	window.self.close();
	        </script>
	      ");

    } 

    /*		
			윈도우 닫기
			왜 안되나 봤더니 이게 scrtip안에서 <!-- --> 주석 처리가 되면 안되네 
    		window.alert('logintest.php id = $id ,pass= $password Login Success '); 
	        parent.location.reload(true); 
	        document.getElementById('topframe').reload();
	        window.opener.reload();
	       	window.close(); 


			한 줄씩 사용하게 한다.
			window.opener.reload();


			부모 프레임 다시 하기 안됨 페이지내 iframe
			<script language=javascript>
	         document.getElementById(topframe).ccontentDocument.loaction.reload(true);
	        </script>

	        프레임 메뉴 구조에서 다른 프레임 새로고침
	        parent.프레임명.location.reload(true);
	         parent.topframe.location.reload(true); 일단 이게 작동안되고
	       	*/
    

}

if($islogon=="default"){
	echo(" <script> alert('로그인 실패');</script>");
	echo(" <script language=javascript>	window.self.close(); </script> ");
}


echo('
	</body></html>');

// 오라클 접속 닫기 
oci_free_statement($stmt);
// 오라클에서 로그아웃 
oci_close($conn); 

?>

