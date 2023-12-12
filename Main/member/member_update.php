<?php 
    session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php 
    $id   = $_REQUEST["id"  ];
    $pw   = $_REQUEST["pw"  ];
    $name = $_REQUEST["name"];
    
    require("db_connect.php");
        if (!($id && $pw && $name)) {
?>
            <script>
                alert('빈칸 없이 입력해야 합니다.');
                history.back();
            </script>
<?php            
        } else {
            $db->exec("update member set pw='$pw', name='$name' where id='$id'");
            
            $_SESSION["userName"] = $name;
?>            
            <script>
                alert('수정이 완료되었습니다.');
                history.back();
            </script>
<?php            
        }
?>
</body>
</html>