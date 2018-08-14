<?php

//This is test for connecting Oracle

//오라클 게정 아이디와 패스워드
	$conn = oci_logon('db','db');

	if(!$conn){
		$e=oci_error();
		trigger_error(htmlentities($e['message'],ENT_QUOTES), E_USER_ERROR);
	}
	$stid = oci_parse($conn, 'select * from employees');
	oci_execute($stid);

	echo"<table border='1'>\n";

	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		echo"<tr>\n";
		foreach($row as $item){
			echo"	<td>".($item !== null ? htmlentities($item, ENT_QUOTES): "&nbsp;")."</td\n";

		}
		echo"</td>\n";

	}

	echo"</table>\n";


?>