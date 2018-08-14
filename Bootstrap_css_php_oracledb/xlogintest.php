<?php
session_start();
extract($_POST);

$id=$_POST['xid'];
$password=$_POST['password'];

$idtestresult="ok";
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


$query = 'select CUS_ID from CUSTOMER';

		$parse = oci_parse($conn,$query);
		$result=oci_execute($parse);
	
		//어차피 한 개이기 때문에 그냥 이렇게 한다.
		while($row = oci_fetch_assoc($parse)){
			if($row["CUS_ID"]==$id)
			{
				$idtestresult="not ok";
				echo("<script>alert('Already signed up on YOUR PHONE NUMBER.');</script>");
				
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


				exit;
			}

		
		}
		
		
// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 





if($password[0]==$password[1] ||$idtestresult=="ok")

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "Logintest.php has No Coonncetion".oci_error();
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


$query = 'INSERT INTO  CUSTOMER (CUS_ID,PASSWORD,CUS_NAME,SSN,PHONENUMBER ) VALUES(:v_id,:v_pass,:v_cusname,:v_ssn,:v_phonenumber)';
		
		$numberid=(int) $id;
		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_id",$id);
		oci_bind_by_name($parse,":v_pass",$password[0]);
		oci_bind_by_name($parse,":v_cusname",$id);
		oci_bind_by_name($parse,":v_ssn",$numberid);
		oci_bind_by_name($parse,":v_phonenumber",$numberid);
		$result=oci_execute($parse);
	
	if($result ==true){
		$_SESSION["id"]=$id;
		$_SESSION["islogon"]="ok";
		$_SESSION["CUS_ID"]=$id;
		$_SESSION["logintype"]="x";

		echo("
	       			 <script>

	        		opener.parent.location.reload();
	        		window.self.close();
	    		    </script>

	  			    ");
	}
// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 



?>