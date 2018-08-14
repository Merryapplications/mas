<?php

//데이터베이스에서 movie 세션에 들어있는 이름으로 영화 컬럼의 mov_num을 찾고
//move_num을 이용하여 상영일정번호인 SCRSCH_NUM과 상영관 번호 TH_NUM, 상영
//수정이 필요하다 시간 + 상영관으로 따로 selection이 되어있는데
//그것을 합쳐서 (시간 + 관 )으로 같이 표현을 해줘야 겠다.
//그 후 SCR_START는 moviedate세션으로 만들고 식을 표현해 주고,
//상영관인 TH_NUM은 movietheater세션으로 만들고 표현해 준다.
//다음 좌석 선택에서는 POST 받는 것이 아니라 세션을 받아온다.
$movie=$_SESSION["movie"];
if($movie=="pono"){
		$movie="벼랑 위의 포뇨";
		$_SESSION["movie"]=$movie;
	}
	if($movie=="ring"){
		$movie="반지의 제왕 : 왕의 귀환";
		$_SESSION["movie"]=$movie;
	}
	if($movie=="phone"){
		$movie="더 폰";
		$_SESSION["movie"]=$movie;
	}
$movienumarray=array();
$moviearray=array();

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
	echo "getmoviedate.php has No Coonncetion".oci_error();
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

		$query = 'select m.MOV_NAME, e.SCRSCH_NUM, e.MOVIE_NUM, e.TH_NUM, e.SCR_DATE, e.SCR_START_TIME, e.SCR_TIME from SCRSCH e, MOVIE m where e.MOVIE_NUM=m.MOV_NUM AND m.MOV_NAME=:v_moviename';

		$parse = oci_parse($conn,$query);
		oci_bind_by_name($parse,":v_moviename",$movie);
		$result=oci_execute($parse);
	
		
		while($row = oci_fetch_assoc($parse))
		{



			//테이블 찾기 성공 .아 맞다 movie_num은 단 한개지만 mov_name으로 찾으면 여러개가 나올 수 밖에 없다.
			//배열과 같은 값만 나온다. 또한 현재 시간과 비교해서 예매는 지금 시간 이후의 것만 찾아 와야한다.
			array_push($movienumarray,$row['MOV_NAME']); //m.MOV_NAME 0
			array_push($movienumarray,$row['SCRSCH_NUM']); // e.SCRSCH_NUM 1
			array_push($movienumarray,$row['MOVIE_NUM']); //e.MOVIE_NUM 2
			array_push($movienumarray,$row['TH_NUM']); //e.TH_NUM 3
			 
			//e."SCR_DATE" 는 지워진 속성
			//array_push($movienumarray,$row['SCR_DATE']);
			array_push($movienumarray,$row['SCR_START_TIME']); //e."SCR_START_TIME" 4
			array_push($movienumarray,$row['SCR_TIME']); //e."SCR_TIME" 5
			
			//한번 그냥 써 보자 없애보자.
			$moviearray[$row['SCRSCH_NUM']]=$movienumarray;
			$movienumarray=array();
			//e.scrsch_num 1번 e.scr_start_time 4번 , e.Th_num 5번
		
			echo "<option value=".$row['SCRSCH_NUM']."> 영화 일정 : ".$row['SCR_START_TIME'].", 영화 상영관 : ".$row['TH_NUM']."관"."</option>";
			
		}
			$_SESSION["movienumarrays"]=$moviearray;
		
		
		
// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 



?>