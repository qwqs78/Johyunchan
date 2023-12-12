<?php
    // 데이터베이스 연결 설정
    $db_host = 'localhost'; // 호스트 주소
    $db_name = 'phpdb';   // 데이터베이스 이름
    $db_user = 'php'; // 데이터베이스 사용자 이름
    $db_pass = '1234'; // 데이터베이스 비밀번호

    try {
        // 데이터베이스 연결
        $db = new PDO("mysql:host=$db_host;port=3307;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    } catch (PDOException $e) {
        echo '데이터베이스 연결 실패: ' . $e->getMessage();
        exit;
    }
	
	// 오늘 날짜 계산
$today = date('Y-m-d');

// content 컬럼에서 200 이상의 값을 가진 행의 횟수 계산
$query = $db->prepare("SELECT COUNT(*) AS count FROM data WHERE content >= 200 AND DATE(time) = :today");
$query->bindParam(":today", $today);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);
$count = $result['count'];
	
	
	?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table     { width:800px; text-align:center; margin-left:auto; margin-right:auto;font-size: 20px}
        table1    { width:800px; text-align:right; font-size: 20px}
        
        th        { background-color:#86E57F; }
        
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
<h1>배변 주기</h1></div>

<table>
<th>오늘의 배변 횟수</th>
<tr>
        <td class='count'><?php echo $count; ?></td>
    </tr>
</table>
<br>

</body>
</html>
