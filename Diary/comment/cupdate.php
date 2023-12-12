<?php
   $num = $_REQUEST["num"];
   $cmt_id = $_REQUEST["cmt_id"];
   $page = $_REQUEST["page"] ?? 1;
   
   $writer = $_REQUEST["writer"];
   $content = $_REQUEST["content"];
   
   if ($writer && $content){
	   
	   require("db_connect.php"); //db접속
       $query = $db -> exec("update comment set writer='$writer', content='$content' where  cmt_id ='$cmt_id'"); 
   
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
