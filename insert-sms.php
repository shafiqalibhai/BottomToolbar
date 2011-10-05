<?php 

	include("include/session.php");

	include ("connectdb.php");
 
	$message = $_POST['message'];
	$duration = $_POST['repeat'];

    $query = "INSERT INTO `smsmessages` (`username`, `message`, `duration`) VALUES ('$session->username', '$message', '$duration')";
	
	mysql_query($query) or die(mysql_error());
	
?>
