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

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { width:680px; margin: 0 auto; text-align:center; }
        th    { width:100px; background-color:pink; }
        input[type=text], textarea { width:100%; }
		
		.button-container {
            text-align: center;
            margin-top: 10px; /* 버튼 위젯과 상단 간격을 조절합니다. */
        }
    </style>
</head>
<body>
<?php
    session_start();
		
	require("db_connect.php");
                       
   $query = $db -> query("select * from member where id ='$_SESSION[userId]'");
   while ($row = $query->fetch()){
?>
<form method="post" action="<?=$action?>">
    <table>
        <tr>
            <th>제목</th>
            <td><input type="text" name="title" maxlength="80" value="<?=$title?>"></td>
        </tr>
        <tr>
            <th>작성자</th>
            <td><input type="text" name="name" maxlength="20" value="<?=$_SESSION["userName"]?>"></td>
        </tr>
		<tr>
            <th>사진이름</th>
            <td><input type="text" name="picture" maxlength="80" value="<?=$picture?>"></td>
        </tr>
        <tr>
            <th>내용</th>
            <td><textarea name="content" rows="10"><?=$content?></textarea></td>
        </tr>
    </table>
<?php
	}
?>
    <br>
	<div class="button-container">
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back()">
	</div>
</form>

</body>
</html>