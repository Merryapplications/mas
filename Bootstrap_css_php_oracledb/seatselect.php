<?php

$currentmovieinfos = $_SESSION["currentmovieinfo"];
$scrsch_num = $currentmovieinfos[1];
//임의적으로 해당 관의 총 의자 수를 100개라고 가정합니다.
//print_r($scrsch_num);
echo("<br>");
//print_r($currentmovieinfos);
$i=0;
$j=0;

//print_r($currentmovieinfo); 여기까지 정보는 다 잘 동작한다. 상영관 TH_NUM은 인덱스 3번 즉 4번째 변수값 $currentmovieinfo[3]의 값이다. 우선 이 값을 기준으로 그릴 좌석의 크기와 동시에 예매여부를 찾아야한다.
//currentmovieinfo[1]은 SCRSCH_NUM

// 1. 상영관 별 좌석의 숫자(크기) 찾기

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "seatselect.php has No Coonncetion".oci_error();
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

//scrnum으로 몇관인지 확인하자
$query = 'select TH_NUM from SCRSCH where SCRSCH_NUM =:v_scrnum';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_scrnum",$scrsch_num);
		$result=oci_execute($parse);

		$row =oci_fetch_assoc($parse);
		$thnum=$row["TH_NUM"];
		$_SESSION["thnum"]=$thnum;
// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "seatselect.php has No Coonncetion".oci_error();
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


$query = 'select TH_HOR_LINE_LEN, TH_VER_LINE_LEN from THEATER where TH_NUM =:v_thnum';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_thnum",$thnum);
		$result=oci_execute($parse);
	
		//어차피 한 개이기 때문에 그냥 이렇게 한다.
		$row = oci_fetch_assoc($parse);
		
		$ver_line_len=$row["TH_VER_LINE_LEN"];
		$hor_line_len=$row["TH_HOR_LINE_LEN"];

// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 

//총 좌석 수를 구한다.
$number_of_seats = $ver_line_len * $hor_line_len;


//2. 본 좌석이 예매 되어있는 지 확인하는 함수. 좌석 가로 좌석 세로 상영 일정번호를 넣는다.
//ticket 테이블의 상영일정 번호와 가로세로 좌석 번호를 합친 좌석 번호가 있다면 예매가 된 상태이다.
//없다면 예매가 안 된상태이다.
function seattest($hor,$ver,$scrnum){

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	var_dump(oci_error());
		echo("	
			연결 불가
	        <script>
	          window.alert('seatselect.php seattest함수 오류');
	        </script>
	      ");
  exit;
} else {
	//동작이 잘 되고 있습니다.
		}


	$seatnumber=$hor."/".$ver;
	$query = 'select SCRSCH_NUM, SEAT_NUM  from TICKET';
	$stmt = oci_parse($conn,$query);
	oci_execute($stmt);

	while($row=oci_fetch_assoc($stmt)){

		if($row["SCRSCH_NUM"]==$scrnum && $row["SEAT_NUM"]==$seatnumber){

			// 오라클 접속 닫기 
			oci_free_statement($stmt);
			// 오라클에서 로그아웃 
			oci_close($conn); 

			return "reserved";
		}

	}

		// 오라클 접속 닫기 
		oci_free_statement($stmt);
		// 오라클에서 로그아웃 
		oci_close($conn); 

	return "notreserved";

}

//echo("<br>상영일정 번호 : ".$scrsch_num." 열 : ".$ver_line_len." 행 : ".$hor_line_len."");


echo("<form id='seatcheckbox' action='confirming.php' method='GET' target='movieseatframe'");
echo("<div class ='checkbox' style='text-align:center;'>");

for($i=0; $i<$hor_line_len ; $i++){

	for($j=0; $j<($ver_line_len) ; $j++)
	{

		/*자리가 예매 되어 있는 곳은 diabled checkbox가 되고 예매가 안 되어 있는 경우 그냥 checkbox가 된다.*/

		$seatnumber=$i."/".$j;
		if(seattest($i,$j,$scrsch_num)=="reserved"){
		//함수를 사용해서 매 자리마다 확인을 해야겠다.
		//이미 예매가 되어있는 경우 Disabled
			//보이는 부분만 representrow,col로 만든다.
			$representrow=$i+1;
			$representcol=$j+1;
		echo("<label><input type='checkbox' value=' ".$seatnumber." ' disabled>행:".$representrow."열:".$representcol."&nbsp(x)&nbsp&nbsp&nbsp&nbsp</label>");
		}
		else if(seattest($i,$j,$scrsch_num)=="notreserved"){
		//자리 예매가 안 되어 있는 경우
			$representrow=$i+1;
			$representcol=$j+1;
		echo("<label><input type='checkbox' name='seat[]' value='".$seatnumber."'>"."행:".$representrow."열:".$representcol."&nbsp(o)&nbsp&nbsp&nbsp&nbsp</label>");
		}

	}
		echo("<br>");



}

echo("</div><br>");
echo("<div style='text-align:center'><button type='submit' class='btn btn-primary'>좌석 선택</button></div>");

echo("</form>");

/*
function getNumberOfSeats ($movietheater) {

 //해당 관의 총 의자 수를 찾아옵니다.
	$number_of_seats = 100;


	return number_of_seats;
}

function getIsReserved($movietheater, $moviedate, $movie){

	//해당 영화의 해당 날짜의 해당 관에 자리가 예매 되었는 지 확인합니다.
	$IsReserved = Null;

	return IsReserved;
}
*/

?>