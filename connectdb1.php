<?php
//Connect to database from here
$link = mysql_connect('localhost', 'uniquete', 'uTech1357'); 
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//select the database | Change the name of database from here
mysql_select_db('uniquete_btbutdb'); 
?>
