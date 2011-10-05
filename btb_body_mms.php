<?php

	include("include/session.php");
	$color2=$_GET['mmscolor'];

?>
	<style>
	img {
		vertical-align: top;
		border: none;
}

	body { background-color: <?php echo $color2 ?>; }
	</style>
<?php
	include ("connectdb.php");
 
	$sql = 'SELECT message FROM `mmsmessages` where username = "'.$_GET[username].'" and approved = 0 ORDER BY `id` DESC LIMIT 0, 1 ';	
	
	$result = mysql_query($sql) or die(mysql_error());
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	//echo mysql_insert_id();
	
	if ( mysql_num_rows($result) > 0 )
	echo mysql_result($result,0);
	
	//return mysql_result($result,0);
	//print_r($row = mysql_fetch_array($result));
	
	//while($row = mysql_fetch_array($result))
	 // {
	 // echo $row['message'];
	//  echo "<br />";
	//  }

?>