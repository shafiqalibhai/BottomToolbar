<?
include ("connectdb.php");
?>

<div class="right"> 
<?php if($session->logged_in){ ?>

<div id="picker"></div>

<?php 
if (isset($_GET[mmscolor])){ 
	echo '<form  method="post" action="viewdemo.php" >
			<input type="hidden" value="" class="viewdemo" name="code" />
			<input class="submit" type="submit" value="View a Demo"/>
		</form>';
}
?>

<?php
	$sql111 = "SELECT closed, online FROM users where username = '$session->username'";
	$result = mysql_query($sql111);
?>

<div id="tooltip2" title="Total number of users who closed the BTB.">
<h2>Total Closed:</h2>
<ul ><li>
<?php 
$line = mysql_fetch_array($result, MYSQL_ASSOC);
echo $line[closed];
?>
</li></ul>
</div>
<div id="tooltip3" title="Total number of online user.">
<h2>Total Online Users:</h2>
<ul>
<li>
<?php echo $line[online]; ?>
</li> 
</ul>
</div>
<?php } ?>
</div>