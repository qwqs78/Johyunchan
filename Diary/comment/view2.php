<?php
   $num = $_REQUEST["num"];
   $page = $_REQUEST["page"] ?? 1;

   require("db_connect.php"); //db접속
   
   $query = $db -> query("select * from board where num=$num");
   if ($row = $query->fetch()){
	   $writer = $row["writer"];
	   $regtime = $row["regtime"];
	   $hits = $row["hits"];
	   $action = "update.php?num=$num&page=$page";
	   
	   $title = str_replace(" ", "&nbsp", $row["title"]);
	   $content = str_replace(" ", "&nbsp", $row["content"]);
	   $content = str_replace("\n", "<br>", $content); //줄 띄우기?
   }
   if (isset($_GET["hits"])) {
  $hits = $_GET["hits"];
  $query = $db ->query("update board set hits = hits+1 where num=$num");
} 
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { width:680px; text-align:center; }
        th    { width:100px; background-color:#D6D1FF; }
        td    { text-align:left; border:1px solid gray; }
		
		.writer      { width:80px; }
        .content    { width:50px; }
		.cmt_id  {width:20px}
		.writer {width: 20px}
    </style>
</head>
<body>

<table>
    <tr>
        <th>작성자</th><td><?=$writer?></td>
    </tr>
    <tr>
        <th>작성일시</th><td><?=$regtime?></td>
    </tr>
    <tr>
        <th>조회수</th><td><?=$hits?></td>
    </tr>
    <tr>
        <th>내용</th><td><?=$content?></td>
    </tr>
</table>

<input type="button" value="목록보기" onclick="location.href='list.php?page=<?=$page?>'">
<input type="button" value="수정"     onclick="location.href='write.php?num=<?=$num?>&page=<?=$page?>'">
<input type="button" value="삭제"     onclick="location.href='delete.php?num=<?=$num?>&page=<?=$page?>'"><br><br>

<?php
   $page = $_REQUEST["page"] ?? 1;
   
    //새글 쓰기 모드
   $title = "";
   $writer = "";
   $content = "";
   $action = "insert.php";
   
   //$num = isset($_REQUEST["num"]) ? $_REQUEST["num"] : 0;
   $num = $_REQUEST["num"] ?? 0; //위에 의미랑 똑같음
   
   if ($num > 0){ //수정 모드로 셋팅
       require("db_connect.php"); 
       $query = $db -> query("select * from board where num=$num");
	   
       if ($row = $query->fetch()) {
         $title = $row["title"];
         $writer = $row["writer"];
         $content = $row["content"];
         $action = "update.php?num=$num&page=$page";
      }
   }
?>
<?php
    session_start();
		
	require("db_connect.php");
                       
   $query = $db -> query("select * from member where id ='$_SESSION[userId]'");
   while ($row = $query->fetch()){
?>
<legend>댓글 작성란</legend>
<table>
<td style="width:70px";> 댓글 작성자</td> <td style="width:350px";>댓글 내용</td>
</table>
<form action="cinsert.php">
<input type="hidden"  name="page" value="<?=$page?>">
<input type="hidden"  name="num" value="<?=$num?>">
<input type="text" name="name" value="<?=$_SESSION["userName"]?>">
<textarea type="text" name="content" value="<?=$content?>"style="width:480px; height:100px; border:1px solid; resize:none;"></textarea><br>
<input type="submit" value="댓글 작성">
</form>
<?php
	}
?>
<br>
<table>
    <tr>
	    <th class="cmt_id" >댓글 번호</th>
        <th class="writer" >작성자  </th>
        <th class="content">댓글내용</th>
    </tr>
	
<?php

   
   require("db_connect.php");
                       //페이지 목록정렬 limit //
   $query = $db -> query("select * from comment where msg_id = $num order by cmt_id desc");
   while ($row = $query->fetch()){
	   $writer = $row["writer"];
       $content = $row["content"];
	   $action = "cinsert.php?num=$num&page=$page";
?>
    <tr>
	    <td><?=$row["cmt_id"]?></td>
        <td><?=$row["writer"]?></td>
        <td><?=$row["content"]?></td>
    </tr>
<?php
	}
?>

</table>
 <form action="cdelete.php" method="post">
 댓글 번호
<input type="text" name="cmt_id">
<input type="hidden"  name="page" value="<?=$page?>">
<input type="hidden"  name="num" value="<?=$num?>">
<input type="submit" value="댓글 삭제" onclick="location.href='cdelete.php?num=<?=$num?>&page=<?=$page?>'">
</form>


 <form action="cupdate_form.php" method="get">
 댓글 번호
<input type="text" name="cmt_id">
<input type="hidden"  name="page" value="<?=$page?>">
<input type="hidden"  name="num" value="<?=$num?>">
<input type="submit" value="댓글 수정" onclick="location.href='cupdate_form.php?num=<?=$num?>&page=<?=$page?>&cmt_id=<?=$cmt_id?>'">
</form>
</body>
</html>
