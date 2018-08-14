<?php
session_start();
extract($_GET);
$currentmovieinfos = $_SESSION["currentmovieinfo"];
$date=$currentmovieinfos[4]; // scr_start_time
$scrsch_num = $currentmovieinfos[1];// 상영일정 번호
$mypoint = $_SESSION['mypoint'];
$usepoint=(int) $_GET['usepoint'];
$seat=unserialize($_SESSION['seat']);
$seatlength=count($seat);

if(isset($_SESSION['id'])){
$id=$_SESSION['id'];
}else
{
	echo("buy php No ID");
}
//보내온 사용한 포인트가 자신의 포인트보다 적으면 사용가능하고 아니면 불가능하게한다.
//이후 데이터베이스에 저장한다.



if($usepoint<0){
	echo("<script>alert('Used Too Small Point');</script>");
	echo("<script>history.go(-1);</script>");
	exit;	
}else if ($mypoint < $usepoint){
	echo("<script>alert('Not Enough Point');</script>");
	echo("<script>history.go(-1);</script>");
	exit;
}else if($mypoint>=$usepoint){
$mypoint=$mypoint-$usepoint;
}

//만약 자신의 포인트를 가격보다 더 크게 정할경우 예를들어 티켓이 2장인데 22000의 포인트를 사용할 경우

if($seatlength*10000<$usepoint){

	echo("<script>alert('Too Much Point Used');</script>");
	echo("<script>history.go(-1);</script>");
	exit;
}



//이것이 아니라면 등록합니다.

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "Buy.php has No Coonncetion".oci_error();
	$_SESSION['error']= "No Connection".oci_error();
	echo("	
	        <script>
	          window.alert('buy.php ERRROR');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
}

//티켓여러장 중 맨 처음것이 할인을 모두 받는다.
//이후 티켓과 또한 고객의 DB, point를 모두 수정한다.
$query = 'insert into TICKET (TI_NUM, TI_PRINT_FLAG,TI_STD_PRICE,TI_SELL_PRICE,SCRSCH_NUM,SEAT_NUM,CUS_ID ) VALUES ( :v_tinum, :v_printflag, :v_stdprice, :v_sellprice, :v_scrschnum, :v_seatnum, :v_id )';
		
for($i=0;$i<$seatlength;$i++){
		$stdprice=(int) "10000";
		//printflag char1바이트
		$printflag='0';
		//상영일정넘버 등등은 모두  NUMBER형태 
		$seatnumber=  $seat[$i];
		//ticketnumber는 varchar
		$tinum= $scrsch_num."/".$seatnumber;
		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_tinum",$tinum);
		oci_bind_by_name($parse,":v_stdprice",$stdprice);
		oci_bind_by_name($parse,":v_printflag",$printflag);


		if($usepoint==($seatlength*10000)){
		$sellprice=(int) 0;
		oci_bind_by_name($parse,":v_sellprice",$sellprice);
		}
		else if($usepoint==10000){

		$sellprice=(int) 0;
		$usepoint=$usepoint-10000;

		oci_bind_by_name($parse,":v_sellprice",$sellprice);
		}
		else if($usepoint>0){

		$sellprice=(int) 10000-($usepoint%10000);
		$usepoint=$usepoint-($usepoint%10000);

		oci_bind_by_name($parse,":v_sellprice",$sellprice);
		}
		else if($usepoint==0){
			
			oci_bind_by_name($parse,":v_sellprice",$stdprice);
			//포인트를 사용하지 않을 때만 적립하며 비회원은 포인트 적립 안됨.
			
			if(isset($_SESSION["logintype"])){

			}else
			{
				$_SESSION["logintype"]=="x";
			}

			if($_SESSION["logintype"]=="x")
			{
			//만약 로그인이 비회원이면 포인트는 그대로입니다.
			}else
			{
				$mypoint = $mypoint + 1000;
			}
		}

		

		
		oci_bind_by_name($parse,":v_scrschnum",$scrsch_num);
		oci_bind_by_name($parse,":v_seatnum",$seatnumber);
		oci_bind_by_name($parse,":v_id",$id);
		$result=oci_execute($parse);

		

}

//사용자의 포인트를 다시 재정의한다.


$aquery ="UPDATE CUSTOMER SET point =:v_point";
$poinstparse = oci_parse($conn,$aquery);
oci_bind_by_name($poinstparse, ":v_point", $mypoint);
oci_execute($poinstparse);




// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 

	echo("<script> location.href='/mainframe.php'</script>");
	
	//goto.url("mainframe.php");	
?>