<?php
//Connect to database from here
$link = mysql_connect('localhost', 'root', ''); 
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//select the database | Change the name of database from here
mysql_select_db('btb_ut_db'); 
?>
