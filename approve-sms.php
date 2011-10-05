<?php include("include/session.php");

	include ("connectdb.php");
 
	$message = $_POST['message'];

    $query = "update smsmessages set duration = duration * -1 where username = '$session->username' and message = '$message'";
	
	mysql_query($query) or die(mysql_error());
	
?>
