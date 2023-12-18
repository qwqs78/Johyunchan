<?php
   $num = $_REQUEST["num"];
   $page = $_REQUEST["page"] ?? 1;
   
   $title = $_REQUEST["title"];
   $name = $_REQUEST["name"];
   $content = $_REQUEST["content"];
   $picture = $_REQUEST["picture"];
   
   if ($title && $name && $content && $picture){
	   $regtime = date("Y-m-d H:i:s");
	   
	   require("db_connect.php"); //db접속
       $query = $db -> exec("update board set 
	                             writer='$name', title='$title', content='$content',
								 regtime='$regtime',picture='$picture' where num=$num"); 
   
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
