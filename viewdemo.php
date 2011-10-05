<?
include("include/session.php");
include ("connectdb.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BTB Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php if($session->logged_in){ ?>

<?php if (isset($_POST[code])) echo stripcslashes($_POST[code]) ?>

<?php } ?>
<link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="stylesheets/template.css" media="screen" />
<style type="text/css">
.stdbtn { width:280px; }
</style>

</head>
<body>
<div id="wrap">
<div id="header">
<h1><a href="index.php">BTB Admin</a></h1>
<h2>Welcome <b><?=$session->username?></b></h2>
</div>
<div id="top"></div>
<?php include "menu.php" ?>


<div id="content">
<div class="left"> 

<h2>
<a href=""></a>

</h2>
<div class="articles">
<?php if($session->logged_in){ ?>

		<form id="formID" class="formular" method="get" action="viewdemo.php" name="formID">
			<input class="submit" type="button" value="Go Back" ONCLICK="history.go(-1)" />
		</form>

            <script type="text/javascript">
                for( i=0; i<90; i++){document.write('<p>Line: '+ i +'</p>');}
            </script>

<?php } ?>
</div>
</div>

<?php include "rightnav.php" ?>


<div style="clear: both;"> </div>
</div>

<?php include "footer.php" ?>