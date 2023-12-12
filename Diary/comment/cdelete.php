<?php
   $cmt_id = $_REQUEST["cmt_id"];
   $num = $_REQUEST["num"];
   $page = $_REQUEST["page"] ?? 1;
	   
	require("db_connect.php"); //db접속
    $query = $db -> exec("delete from comment where cmt_id=$cmt_id");
	header("Location:view.php?num=$num&page=$page");
?>


