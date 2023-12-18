<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<style>
        table     { width:1300px; text-align:center; 
		             margin-left:auto; margin-right:auto;}
        th        { background-color:#B2CCFF; }
        
		.data    {width:200px;}
        .csat      { width:200px; }
        .test    { width:200px; }
        .information   { width:200px; }
        .question  { width:300px; }

        a         { text-decoration:none; }    
        a:link    { color:black; }
        a:visited { color:gray; }
        a:hover   { color:black;  }
       
        .center     { text-align:center; }
   
	h1{
		font-size: 50px;
		font-weight:bold;
		color: sandybrown;
	}
	h2{
		font-size: 30px;
		font-weight:bold;
		color: black;
		text-align: center;
	}
	h3{
		font-size: 15px;
		font-weight:bold;
		color: ##0000;
	}
	.img_box{
		background-image:url("logo.jpg");
		background-size : cover;
		background-position:center;
	}

	</style>
</head>
<body>
<div style="text-align : center;">
<h1>스마트 반려묘<img src="new_icon.png" style="width:50px; height:50px;"/></h1><br>
</div>
<h3>
<div style="text-align : right;">
<?php
    session_start();
    if (empty($_SESSION["userId"])) { // 로그인 안된 상태이면 (userId 세션변수가 없으면/비었으면)	
?>
     
         <form action="login.php" method="post">
           아이디:   <input type="text"     name="id">&ensp;<br>
           비밀번호: <input type="password" name="pw">&ensp;<br><br>
           <input type="submit" value="로그인">
		   <input type="button" value="회원가입" onclick="location.href='member_join_form.php'">
	     </form>
</div></h3>		 
 <?php
   } else {
 ?>
     <form action="logout.php" method="post">
       <?=$_SESSION["userName"]?>님 로그인&ensp;
       <input type="submit" value="로그아웃">
	   <input type="button" value="회원 수정" onclick="location.href='member_update_form.php'">
	   	<input type="button" value="회원 탈퇴"     onclick="location.href='mdelete.php'"><br>
	 </form>
	 <h2>
<table>
    <tr>
	    <th class="data"><a href="data.php">데이터 확인</a></th>
		<th class="camera"><a href="camera.php">카메라 창</a></th>
		<th class="eat"><a href="eat.php">사료 마켓</a></th>
		<th class="health"><a href="health.php">배변 횟수</a></th>
        <th class="question"><a href="list.html">펫 다이어리</a></th>
	</tr>
</table>
</h2>
서버 아이피 :
<?php
     }
	 echo $_SERVER['REMOTE_ADDR'];	
 ?>

<img src="cat.jpg" style="display: block; margin: 0 auto; width:1000px; height:1000px;"/ >
 </div>
</body>
</html> 
