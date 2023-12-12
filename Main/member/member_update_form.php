<?php
    session_start();
    $id = $_SESSION["userId"];
    
    require("db_connect.php");
    
    $query = $db->query("select * from member where id='$id'");
    $row = $query->fetch();
        
    $pw   = $row["pw"  ];
    $name = $row["name"];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<form action="member_update.php" method="post">
    <table>
        <tr>
            <td>아이디</td>
            <td><input type="text" name="id" readonly value="<?=$id?>"></td>
        </tr>
        
        <tr>    
            <td>비밀번호</td>
            <td><input type="password" name="pw" value="<?=$pw?>"></td>
        </tr>
        
        <tr>
            <td>이름</td>
            <td><input type="text" name="name" value="<?=$name?>"></td>
        </tr>
        </table>
    <input type="submit" value="등록">
	<input type="button" value="메인 이동" onclick="location.href='hcmain.php'"
</form>
</body>
</html>