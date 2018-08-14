<?php
session_start();
if($_SESSION["islogon"]=="ok")
{
    $id=$_SESSION['id'];
}else{
    echo(" <script>
        alert('비회원은 글을 쓰지 못합니다.');
        window.close();
        history.go(-1);
        </script>");
    $id="비회원";

}
?>


<html>
<head>
<title>영화 게시판</title>
<meta charset="UTF-8">
<style>
<!--
td { font-size : 9pt; }
A:link { font : 9pt; color : black; text-decoration : none; 
font-family : 굴림; font-size : 9pt; }
A:visited { text-decoration : none; color : black; font-size : 9pt; }
A:hover { text-decoration : underline; color : black; 
font-size : 9pt; }
-->
</style>
</head>

<body topmargin=0 leftmargin=0 text=#464646>
<center>
<BR>
<!-- 입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다. -->
<form action=insert.php method=post>
<table width=580 border=0 cellpadding=2 cellspacing=1 bgcolor=#777777>
    <tr>
        <td height=20 align=center bgcolor=#999999>
        <font color=white><B>글 쓰 기</B></font>
        </td>
    </tr>
    <!-- 입력 부분 -->
    <tr>
        <td bgcolor=white>&nbsp;
        <table>
            <tr>
                <td width=60 align=left >아이디</td>
                
                <?php
                if($_SESSION["islogon"]=="ok"){
                echo("<td align=left >
                    <INPUT type=text name=name size=20 maxlength=10 value="."$id".">
                </td>");
                }else
                {
                    echo("<td align=left >
                    <INPUT type=text name=name size=20 maxlength=10 value="."$id".">
                </td>");
                }
                ?>

            </tr>
            <tr>

                <?php
                if(isset($_SESSION["movie"])){

                echo("<td width=60 align=left >영화</td>
                <td align=left >
                    <INPUT type=text name=movie size=20 maxlength=25 value=".$_SESSION['movie'].">
                </td>");
                }else
                {
                    echo("<td width=60 align=left >영화 </td>
                    <td align=left>
                    <INPUT type=text name=movie size=20 maxlength=25>
                    </td>");
            
                }
                ?>

            </tr>
            <tr>
                <td width=60 align=left >평점</td>
                <td align=left >
                    <INPUT type=text name=rating size=8 maxlength=1> 
                    </td>
            </tr>
            <tr>
                <td width=60 align=left >제 목</td>
                <td align=left >
                    <INPUT type=text name=title size=60 maxlength=35>
                </td>
            </tr>
            <tr>
                <td width=60 align=left >내용</td>
                <td align=left >
                    <TEXTAREA name=content cols=60 rows=6></TEXTAREA>
                </td>
            </tr>
            <tr>
                <td colspan=10 align=center>
                    <INPUT type=submit value="글 저장하기">
                    &nbsp;&nbsp;
                    <INPUT type=reset value="다시 쓰기">
                    &nbsp;&nbsp;
                    <INPUT type=button value="되돌아가기" 
                    onclick="history.back(-1)"> <!--버튼이 클릭되었을때 발생하는 이벤트로 자바스크립트를 실행함. 이렇게 하면 바로 이전페이지로 감-->
                </td>
            </tr>
        </TABLE>
</td>
</tr>
<!-- 입력 부분 끝 -->
</table>
</form>
</center>
</body>
</html>
</html>