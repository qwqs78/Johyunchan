<?php
   $num = $_REQUEST["num"];
   $page = $_REQUEST["page"] ?? 1;
   $cmt_id = $_REQUEST["cmt_id"];
   
   
   if ($num > 0){ //수정 모드로 셋팅
   require("db_connect.php");
                       //페이지 목록정렬 limit //
   $query = $db -> query("select * from comment where cmt_id=$cmt_id");
   while ($row = $query->fetch()){
	   $writer = $row["writer"];
       $content = $row["content"];
	   $action = "cupdate.php?num=$num&page=$page&cmt_id=$cmt_id";
   }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { width:680px; text-align:center; }
        th    { width:100px; background-color:cyan; }
        input[type=text], textarea { width:100%; }
    </style>
</head>
<body>
<legend>댓글 작성란</legend>
<form method="post" action="<?=$action?>">
    <table>
        <tr>
            <th>작성자</th>
            <td><input type="text" name="writer" maxlength="80" value="<?=$writer?>"></td>
        </tr>
        <tr>
            <th>댓글 내용</th>
            <td><input type="text" name="content" value="<?=$content?>"></td>
        </tr>
    </table>
    <br>
<?php
   }
?>
<input type="submit" value="댓글 수정"><br><br>
<input type="button" value="뒤로 가기" onclick="location.href='view.php?num=<?=$num?>&page=<?=$page?>'">
</form>

<br>
</body>
</html>