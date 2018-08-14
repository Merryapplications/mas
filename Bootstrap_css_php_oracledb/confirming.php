<?php 
	session_start();
	extract($_GET);
	extract($_POST);

	$currentmovieinfos = $_SESSION["currentmovieinfo"];
	$scrsch_num = $currentmovieinfos[1];// 상영일정 번호
	//$seat=$_GET['seat'][0];
	$seat=$_GET['seat'];
	$_SESSION['seat']=serialize($seat);
	$seatlength=count($seat);

	//만약 자리를 정하지 않았을 경우
	if($seat[0]==""){

	echo("<script>alert('자리를 정하지 않으셨습니다.');</script>.");
	echo("<script>history.go(-1);</script>");
}
	//배열을 사용하고 싶으면 $seat=unserialize($_SESSION['seat']);

	 	$movie=$_SESSION['movie'];
 	if(!isset($_SESSION["id"])){
 		//echo(" 세션이 등록되어있는지는 isset 으로 확인합니다. id가 없습니다");
 		$id="비회원";
 	}else if(isset($_SESSION["id"])){
 		$id=$_SESSION['id']; 
 	}

 	$theater=$currentmovieinfos[3]; //상영관은 currentmovieinfos[3];
 	$date = $currentmovieinfos[4]; // 일시 : 시작시간 SCR_START_TIME 4번자리;

 	/*echo("좌석의 선택 한 갯수는 $seatlength 개 입니다. <br>");
 	var_dump($seat);*/

echo('
	<html>
		<head>

 	<meta  charset = "UTF-8">
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 	<link rel="stylesheet" type="text/css" href="css/test.css">
 	<link rel="stylesheet" href="css/simpleBanner.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/simpleBanner.js"></script>
	<script type="text/javascript" src="js/logon.js"></script>
	<script type="text/javascript">
	function loginpopupOpen(){

	var popUrl = "login.php";	//팝업창에 출력될 페이지 URL

	var popOption = "width=600, height=500, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);
	}
	</script>

	<script type="text/javascript">

	function XloginpopupOpen(){

	var popUrl = "xlogin.php";	//팝업창에 출력될 페이지 URL

	var popOption = "width=500, height=400, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);
	
	}
	</script>

		</head>
		<body>
			<div class="content">
				
				 <span style="text-align:center;"><h1>예약 정보 확인</h1></span>
				 <div style=" text-align: center;width:50%; float:left;">
					<h2>아이디<br></h2> ');
					
					echo('<h3> <span class="label label-success"> '); 
					echo("$id"); 
					echo(' </span> </h3> <h2>영화<br></h2> <h3><span class="label label-success">'); 
					echo("$movie "); 
					echo('</span> </h3> <h2>상영관<br></h2> <h3> <span class="label label-success">');
					echo("$theater "); 
					echo('</span> </h3> <h2>일시<br></h2> <h3> <span class="label label-success">');
					echo("$date"); 
					echo('</span> </h3> <h2>선택 좌석<br></h2> <h3> <span class="label label-success">');
					for($j=0;$j<$seatlength;$j++){
							$seatrowcol=explode('/',$seat[$j]);
							$row=$seatrowcol[0];
							$col=$seatrowcol[1];
							$representrow=$row+1;
							$representcol=$col+1;
							echo("행 : $representrow 열 : $representcol");
							if($j==$seatlength-1)
								break;
							echo(",&nbsp&nbsp");
						}
					echo('</span> </h3>');



					/*페이지의 오른쪽 부분입니다. 데이터베이스에서 티켓의 값, 사용자의 포인트를 불러오고 계산을 완료하면 */
					echo("</div>
							<div style='text-align:center; width:50%; float:right;'>
								


								<h2>티켓 가격</h2>");
					$STD_PRICE=$seatlength*10000;
					echo('<h3><span class="label label-success">'.$STD_PRICE.'</span></h3>');

					echo("
								<h2>나의 포인트</h2>");
								if($id!="비회원"){
								include("getmypoint.php");
								}else{
								echo('<h3><span class="label label-warning">비회원은 포인트를 사용할 수 없습니다.</span></h3>');
								}
					
					
			
					/*확인 버튼을 누를 시 비회원의 경우 로그인을 하던가 아니면 비회원 예매를 하게 해야한다. */
					if($id=="비회원"){
						/*비회원 예매시 비회원 등록을 해야합니다.*/
					echo('<br><br><br><h4><a href="javascript:loginpopupOpen();" class="btn btn-primary">로그인</a></h4>');
					echo('&nbsp&nbsp <h4><a href="javascript:XloginpopupOpen();" class="btn btn-primary">비회원 예매</a></h4>');
					}
					else
					{
						echo("		<h2>사용할 포인트</h2>
								<br>
								<form action='buy.php' method='GET' target='_parent'>
								<div class='form-group'>
								<input type='text' size='20' name='usepoint'>");
						echo('</div><br><br> <h4><button class="btn btn-primary" type="submit">예매하기</button></h4>');	
						
					}


		echo('
			</div>
			</div>
		</body>
	</html>
		');

?>