<?php 

	include("include/session.php");

	include ("connectdb.php");
 
	$message = $_POST['message'];
	$twebsite = $_POST['twebsite'];

    $query = "INSERT INTO `mmsmessages` (`username`, `message`, `approved`) VALUES ('$twebsite', '$message', '-1')";
	
	mysql_query($query) or die(mysql_error());
	
?>
