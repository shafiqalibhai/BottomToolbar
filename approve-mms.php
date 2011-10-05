<?php include("include/session.php");

	include ("connectdb.php");
 
	$message = $_POST['message'];

    $query = "update mmsmessages set approved = 0 where username = '$session->username' and message = '$message'";
	
	mysql_query($query) or die(mysql_error());
	
?>
