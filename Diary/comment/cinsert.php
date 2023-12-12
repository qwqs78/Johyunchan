<?php
   $page = $_REQUEST["page"];
   $num = $_REQUEST["num"];
   $name = $_REQUEST["name"];
   $content = $_REQUEST["content"];
  
   if ($name && $content){
	   
	   require("db_connect.php"); //db접속
       $query = $db -> exec("insert into comment (writer, content, msg_id)
	   values('$name','$content',$num)"); //insert 할시 exec
       header("Location:view.php?num=$num&page=$page");
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
