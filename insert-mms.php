<?php 

	include("include/session.php");

	include ("connectdb.php");
 
	$message = $_POST['message'];

    $query = "INSERT INTO `mmsmessages` (`username`, `message`) VALUES ('$session->username', '$message')";
	
	mysql_query($query) or die(mysql_error());
	
?>
