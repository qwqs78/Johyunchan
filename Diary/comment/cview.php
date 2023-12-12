<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<style>
        table     { width:500px; text-align:center; 
		             margin-left:auto; margin-right:auto;}
        th        { background-color:#B2CCFF; }
		td        {}
        
        .kor      { width:200px; }
        .math    { width:200px; }
        .eng   { width:200px; }
        .gita  { width:300px; }

        a         { text-decoration:none; }    
        a:link    { color:black; }
        a:visited { color:gray; }
        a:hover   { color:black;  }
       
        .center     { text-align:center; }
	h1{
		font-size: 50px;
		font-weight:bold;
		color: sandybrown;
	}
	</style>
</head>
<body>
<input type="button" value="뒤로이동" onclick="location.href='csat.php'
	"style="display:block; width:200px; text-align:center;  margin-left:auto; margin-right:right;
	 font-size:20px; padding:1px;">
<div style="text-align : center;">
<h1><a href="csat.php">수능 특강</a></h1><br>
</div>
<table>
<?php
   $csat_id = $_REQUEST["csat_id"];
   require("db_connect.php");
   $query = $db -> query("select * from csat where csat_id=$csat_id");
   if ($row = $query->fetch()){
	   $src = $row["src"];
       $frameborder = $row["frameborder"];
	   $scrolling = $row["scrolling"];
	   $title = $row["title"];
	   $allow = $row["allow"];
   }
?>
<td style = font-size:40px><?=$row["subject"]?></td> <input type="button" value="수정"     onclick="location.href='csat_write.php?csat_id=<?=$csat_id?>'">
<input type="button" value="삭제" onclick="location.href='csat_delete.php?csat_id=<?=$csat_id?>'"><br>
<tr>
      <th><iframe width="936" height="526" src="<?=$src?>"
	  frameborder="<?=$frameborder?>" scrolling="<?=$scrolling?>" title="<?=$title?>" 
	  allow="<?=$allow?>" 
	  allowfullscreen></iframe></th>
</tr
</table>

	
</body>
</html> 
