<?php include("include/session.php");

	include ("connectdb.php");
 
	$message = $_POST['message'];

    $query = "DELETE FROM `smsmessages` WHERE username = '$session->username' and message = '$message'";
	
	mysql_query($query) or die(mysql_error());
	
?>
