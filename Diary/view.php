<?php
   $num = $_REQUEST["num"];
   $page = $_REQUEST["page"] ?? 1;

   require("db_connect.php"); //db접속
   
   $query = $db -> query("select * from board where num=$num");
   if ($row = $query->fetch()){
	   $writer = $row["writer"];
	   $regtime = $row["regtime"];
	   $picture = $row["picture"];
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
        table { width: 800px; margin: 0 auto; text-align: center; } /* 테이블을 수평으로 가운데 정렬합니다. */
        th    { width: 150px; background-color: pink; }
        td    { text-align: center; border: 1px solid gray; padding: 5px; }
		
		.writer      { width:80px; }
        .content    { width:50px; }
		.cmt_id  {width:20px}
		.writer {width: 20px}
		
		/* 버튼 위젯 가운데 정렬 스타일 */
        .button-container {
            text-align: center;
            margin-top: 10px; /* 버튼 위젯과 상단 간격을 조절합니다. */
        }
    </style>
	
</head>
<body>
<div style="text-align : center; margin-right:right;">
<h1><a href="list.php">일기장</a></h1></div>
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
	<tr>
    <th>사진</th> <td><img src="<?=$picture?>"></td>
	</tr>

</table>

<div class="button-container">
<input type="button" value="목록보기" onclick="location.href='list.php?page=<?=$page?>'">
<input type="button" value="수정"     onclick="location.href='write.php?num=<?=$num?>&page=<?=$page?>'">
<input type="button" value="삭제"     onclick="location.href='delete.php?num=<?=$num?>&page=<?=$page?>'"><br><br>
</div>
<?php
   $page = $_REQUEST["page"] ?? 1;
   
    //새글 쓰기 모드
   $title = "";
   $writer = "";
   $content = "";
   $picture = "";
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
		 $picture = $row["picture"];
         $action = "update.php?num=$num&page=$page";
      }
   }
?>

</body>
</html>
