<?php
   $title = $_REQUEST["title"];
   $name = $_REQUEST["name"];
   $content = $_REQUEST["content"];
   $picture = $_REQUEST["picture"];
   
   if ($title && $name && $content && $picture){
	   $regtime = date("Y-m-d H:i:s");
	   
	   require("db_connect.php"); //db접속
       $query = $db -> exec("insert into board (writer, title, content, regtime, hits, picture)
	   values('$name','$title','$content','$regtime',0 , '$picture')"); //insert 할시 exec
   
       header("Location:list.php");
	   exit; //헤더 쓰면 exit 써주면 좋다
   }

 
   
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<script>
   alert('모든 항목이 빈칸 없이 입력되어야 합니다.');
   history.back();
</script>
</body>
</html>
