<?php

echo('Draw seat using PHP <br>');

//임의적으로 해당 관의 총 의자 수를 100개라고 가정합니다.
$number_of_seats = 100;
$i=0;
$j=0;
$IsReserved=false;


//바로 아래 echo는 테스트를 하기 위해서 잠시 넣어둔 것으로 실제 include시는 제거한다.
echo('
	<html>
 <head>
 	<meta  charset = "UTF-8">

 	<!--
 	링크를 이용하여 외부 파일을 가져옵니다
 	현재위치/css/bootstrap.css파일을 이용하여 가져옵니다.
 	-->
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

 	
 	<!-- 내가 만든 test.css를 가져온다.
 		폰트와 배너의 크기지정이 들어있다. -->
 	<link rel="stylesheet" type="text/css" href="css/test.css">

 	
 	<!-- 슬라이드 배너를 만들기 위한 링크입니다. -->
 	<link rel="stylesheet" href="css/simpleBanner.css">
	<!-- 더 이상 작동하지 않는 라이브러리네....
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
	-->
	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/simpleBanner.js"></script>



 	</head>



 <body>');




echo("<form action='confriming.php' method='GET' target='movieseatframe'");
echo("<div class ='checkbox'>");

for($i=0; $i<$number_of_seats ; $i++){
	/*자리가 예매 되어 있는 곳은 diabled checkbox가 되고 예매가 안 되어 있는 경우 그냥 checkbox가 된다.*/

	if($IsReserved==True){
		//이미 예매가 되어있는 경우 Disabled
		echo("<label><input type='checkbox' value='$i' disabled><- 예매 불가 &nbsp &nbsp&nbsp&nbsp</label>");
	}
	else{
		//자리 예매가 안 되어 있는 경우
		echo("<label><input type='checkbox' value='$i'><- 예매 가능 &nbsp&nbsp&nbsp</label>");

	}

	if(($i+1)%10==0)
	{
		echo("<br>");
	}


}

echo("</div><br>");
echo("<button type='submit' class='btn btn-primary'>좌석 선택</button>");

echo("</form>");
echo("</body></html>");


function getNumberOfSeats ($movietheater) {

/* 해당 관의 총 의자 수를 찾아옵니다.*/
	$number_of_seats = 100;


	return number_of_seats;
}

function getIsReserved($movietheater, $moviedate, $movie){

	/*해당 영화의 해당 날짜의 해당 관에 자리가 예매 되었는 지 확인합니다.*/
	$IsReserved = Null;

	return IsReserved;
}


?>