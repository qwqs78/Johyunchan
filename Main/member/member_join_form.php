<!doctype html>
 <html>
 <head>
     <meta charset="utf-8">
 </head>
 <style>
	h1{
		text-align: center;
		font-size: 35px;
		font-weight:bold;
		color: sandybrown;
	}
	h2{
		text-align: right;
		font-size: 15px;
		font-weight:bold;
		color: black;
	}
	</style>
 <body>
 <h1>회원가입 화면</h1> 
 <h2><a href="hcmain.php">메인으로</a></h2>
<form action="member_join.php" method="post">
    아이디 : <input type="text" name="id"><br>
	비밀번호 : <input type="text" name="pw"><br>
	이름 : <input type="text" name="name"><br>
	<input type="submit" value="가입"><br>
	<input type="button" value="로그인 화면으로" onclick="history.back()"><br>
	
	
</form>

 </body>
 </html>
