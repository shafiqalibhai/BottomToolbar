<div id="menu">
<?php if($session->logged_in){ ?>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="sms.php">SMS</a></li>
<li><a href="mms.php">MMS</a></li>
<li><a href="approve.php">Approve Messages</a></li>
<li><a href="btbcodegeneratorform.php">Get BTB Code</a></li>
<li><a href="useredit.php">Edit Account</a></li>
<?php if($session->isAdmin()){   echo "<li><a href=\"admin.php\">Admin Center</a></li>"; } ?>
<li><a href="process.php">Logout</a></li>
</ul>
<?php } else { ?>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="register.php">Register</a></li>
<li><a href="login.php">Login</a></li> 
</ul>
<?php } ?>
</div>
