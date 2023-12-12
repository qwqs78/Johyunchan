<!doctype html>
 <html>
 <head>
     <meta charset="utf-8">
 </head>
 <body>

<?php
    $id = $_REQUEST["id"];
	$pw = $_REQUEST["pw"];
	$name = $_REQUEST["name"];
	
	require("db_connect.php");
	//$db = new PDO("mysql:host=localhost;port=3307;dbname=phpdb","php","1234");
	//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	if ( !($id && $pw && $name)) { //빈칸 있으면
?>
       <script>
	       alert('빈 칸을 채워주세요') //팝업창 
	  	   history.back();
	   </script>
<?php
    }else if ($db->query("select * from member where id='$id'")->fetch()){
?>		
		<script>
	       alert('이미 등록된 아이디 입니다.'); //팝업창 
	  	   history.back(); //뒤로가기
	   </script>
<?php   
	} else{
		
	    
	    $db->exec("insert into member values ('$id','$pw','$name')");
?>
        가입이 완료되었습니다.<br>
        <input type="button" value="로그인 화면으로" onclick="location.href='hcmain.php'">
<?php
    }
?>

</body>
</html> 
