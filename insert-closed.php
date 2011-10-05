<?php 
include"include/session.php";
include "connectdb.php";
$username=$_POST['username'];
//$firstname = $_POST['firstname'];
//$lastname = $_POST['lastname'];
//$age = $_POST['age'];
//$ip = $_SERVER['REMOTE_ADDR'];

//$result = mysql_num_rows(mysql_query("SELECT * FROM tbl_user WHERE user_name='$username'"));
//if($result == 1)
  //  {
  //  echo '<h1>ERROR!</h1>The username you have chosen already exists!';
  //  }
//else
 //   {
 $sql = "update users set closed = closed+1 where username = '$username'";
	mysql_query($sql);

   // echo '<p>Congratulations! You have successfully registered!</p><p>Click <a href="login.php">here</a> to login.</p>';
//	}
  ?>
