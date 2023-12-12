
<?php
    session_start();
    $id=$_SESSION["userId"];	
  
	require("db_connect.php"); //db접속
    $db -> exec("delete from member where id='$id'");
	unset($_SESSION["userId"]);
	unset($_SESSION["userName"]);
	 
	  
	header("Location:hcmain.php")
?>
