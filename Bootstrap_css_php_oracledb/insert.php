<?php
    session_start();
    $id=$_SESSION["id"];
    //데이터 베이스 연결하기
    include "db_info.php";

    $movie = $_POST["movie"];
    $rating = $_POST["rating"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    $movienum= getmovienum($movie);
   

$dbuser="db";
$dbpass="db";

$conn = @oci_connect($dbuser,$dbpass,"localhost/XE");

if(!$conn) {
    echo "inserttext.php has No Coonncetion".oci_error();
    $_SESSION['error']= "No Connection".oci_error();
    echo("  
            연결 불가
            <script>
              window.alert('insert.php 오류');
            </script>
          ");
  exit;
} else {
    //동작이 잘 되고 있습니다.
}

    $query = "INSERT INTO board
    (CUS_ID,  MOVIE_NUM, RATING, title, content )
    VALUES (:v_id, :v_movienum, :v_rating,:v_title, :v_content)";
    
    $parse = oci_parse($conn,$query);
    oci_bind_by_name($parse, ":v_id", $id);
    oci_bind_by_name($parse, ":v_movienum", $movienum);
    oci_bind_by_name($parse, ":v_rating", $rating);
    oci_bind_by_name($parse, ":v_title", $title);
    oci_bind_by_name($parse, ":v_content", $content);
    oci_execute($parse);

// 오라클 접속 닫기 
oci_free_statement($parse);
// 오라클에서 로그아웃 
oci_close($conn); 

    // 새 글 쓰기인 경우 리스트로..
echo ("<meta http-equiv='refresh' content='0.1; URL=list.php'></meta>");
    //1초후에 list.php로 이동함.
?>

