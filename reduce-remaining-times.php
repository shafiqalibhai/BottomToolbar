<?php
include "connectdb.php";
$username=$_POST['username'];

	//$sql0 = "select duration from smsmessages where username = '$username'";
	
	
	$sql1 = "select duration from smsmessages where username = '$username'";
   
   $result = mysql_query($sql1) or die('Query failed: ' . mysql_error());

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
//echo $line[duration];
if( $line[duration] > 0 ) { 
	$sql = "update smsmessages set duration = duration-1 where username = '$username' and duration > 0";
	mysql_query($sql);
}
}


	
?>