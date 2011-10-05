<?php session_start();

// if session is not set redirect the user
if(empty($_SESSION['u_name']))
	header("Location:index.php");	

//if logout then destroy the session and redirect the user
if($_GET['page'] == "Logout")
{
	session_destroy();
	header("Location:index.php");
}	

	//header("Location:index.php");
	include "index.php";
//echo "<a href='secure.php?logout'><b>Logout<b></a>";

?>