<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table     { width:800px; text-align:center; margin-left:auto; margin-right:auto;font-size: 20px}
		table1    { width:800px; text-align:right; font-size: 20px}
		
        th        { background-color:pink; }
        
        .num      { width: 80px; }
        .title    { width:230px; }
        .writer   { width:100px; }
        .regtime  { width:230px; }

        a         { text-decoration:none; }    
        a:link    { color:blue; }
        a:visited { color:blue; }
		a:hover   { color:red;  }
       
        .center     { text-align:center; }
		
		h1{
		font-size: 50px;
		font-weight:bold;
		color: sandybrown;
	}
    </style>
</head>
<body>
<div style="text-align : center; margin-right:right;">
<h1><a href="list.php">일기장</a></h1></div>

<table>

    <tr>
        <th class="num"    >번호    </th>
        <th class="title"  >제목    </th>
        <th class="writer" >작성자  </th>
        <th class="regtime">작성일시</th>
        <th>                조회수  </th>
    </tr>
	
<?php
   $listSize = 5; //글은 5개씩만 보여줘라
   
   $page = $_REQUEST["page"] ?? 1; //주소 페이지 창  ?page = 2,3,4 붙이면 다음 장 넘어감
   $start = ($page - 1) * $listSize; //페이지 시작 계산법
   
   require("db_connect.php");
                       //페이지 목록정렬 limit //
   $query = $db -> query("select * from board order by num desc limit $start,$listSize");
   while ($row = $query->fetch()){
	   $hits = $row["hits"];
?>
    <tr>
        <td><?=$row["num"]?></td>
        <td style="text-align:left;"><a href="view.php?num=<?=$row["num"]?>&page=<?=$page?>&hits=<?=$hits+1?>"><?=$row["title"]?></a></td>
        <td><?=$row["writer"]?></td>
        <td><?=$row["regtime"]?></td>
        <td><?=$row["hits"]?></td>
    </tr>
<?php
	}
?>
<td><input type="button" value="글쓰기" onclick="location.href='write.php'"></td>
</table>

<br>
<div style ="width:680px; text-align:center; margin-left:auto; margin-right:auto;"}> 
<?php
    $paginationSize = 3; //페이지 3개씩 보여주기
	
    $firstLink = floor(($page - 1) / $paginationSize) * $paginationSize + 1; //페이지네이션 처음 부분 계산법
	$lastLink = $firstLink + $paginationSize - 1; //마지막 링크 번호
	
	$query = $db -> query("select count(*) from board"); //마지막 없는 페이지가 나오면 안되니까 하는 거
    $row = $query->fetch();
	$numRecords = $row[0];
	// $numRecords = $db -> query("select count(*) from board")->fetch()[0];  //위에꺼 3줄이랑 똑같음
	$numPages = ceil($numRecords / $listSize); //페이지 계산법 (전체 글 수 / listSize)
	if ($lastLink > $numPages) { //나눴을 때 딱 안 떨어질 때 페이지 하나 반 올림ceil 해서 페이지 하나 만듬
		$lastLink = $numPages;
	}
	
	// 다음 -- 이전 페이지 목록 
	if ($firstLink > 1){
		$link = $firstLink - 1;
	 echo "<a href=\"list.php?page=$link\">이전</a> ";
	}
	for ($i = $firstLink; $i <= $lastLink; $i++){
        if ($i == $page) {                  //현재 페이지 밑줄
			echo "<a href=\"list.php?page=$i\"><u>$i</u></a>  "; 
		} else {			
	        echo "<a href=\"list.php?page=$i\">$i</a> ";
	    }
	}
	
	if ($lastLink < $numPages){
		$link = $lastLink + 1;
	    echo "<a href=\"list.php?page=$link\">&nbsp다음</a> ";
	}
?>       
	
</div>

<br>

<input type="button" value="메인 이동" onclick="location.href='hcmain.php'"
style="display:block; width:200px; text-align:center;  margin-left:auto; margin-right:auto; font-size:20px; padding:5px;">
</body>
</html>
