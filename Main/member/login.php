<?php 
    $id = $_REQUEST["id"];
    $pw = $_REQUEST["pw"];
    
        require("db_connect.php");
    
        $query = $db->query("select * from member where id='$id' and pw='$pw'");
        if ($row = $query->fetch()) {
            session_start();
            
            $_SESSION["userId"  ] = $row["id"  ];
            $_SESSION["userName"] = $row["name"];
            
            header("Location:hcmain.php");
            exit;
        }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<script>
    alert('아이디 또는 비밀번호가 틀렸습니다.');
    history.back();
</script>

</body>
</html> 
