<?php
   $page = $_REQUEST["page"] ?? 1;
   
    //새글 쓰기 모드
   $writer = "";
   $content = "";
   $action = "cinsert.php";
   
   //$num = isset($_REQUEST["num"]) ? $_REQUEST["num"] : 0;
   $num = $_REQUEST["num"] ?? 0; //위에 의미랑 똑같음
 
   if ($num > 0){ //수정 모드로 셋팅
       require("db_connect.php"); 
       $query = $db -> query("select * from comment where num=$num");
	   
       if ($row = $query->fetch()) {
         $cmd_id = $row["cmt_id"];
         $msg_id = $row["msg_id"];
         $content = $row["content"];
		 $writer = $row["writer"];
      }
   }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        th    { width:100px; background-color:cyan; }
        input[type=text], textarea { width:100%; }
    </style>
</head>
<body>
<form method="post" action="<?=$action?>">
        <tr>
            <th>작성자</th>
            <td><input type="text" name="writer" maxlength="20" value="<?=$writer?>"></td>
        </tr>
        <tr>
            <th>댓글내용</th>
            <td><textarea name="content" rows="10"><?=$content?></textarea></td>
        </tr
    <br>
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back()">
</form>

</body>
</html>