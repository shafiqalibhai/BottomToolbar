<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BTB Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="stylesheets/template.css" media="screen" />
<!--<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>-->
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>-->
  <script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.draggable.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.resizable.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.dialog.js"></script>

<script type="text/javascript" src="scripts/webtoolkit.scrollabletable.js"></script>
<link rel="stylesheet" href="stylesheets/screen.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/jquery.tooltip.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/jquery.alerts.css" type="text/css" />
<script type="text/javascript" src="scripts/ui.core.js"></script>
<!--<script type="text/javascript" src="scripts/jquery.bind.js"></script>-->
<script type="text/javascript" src="scripts/ui.checkbox.js"></script>
<script type="text/javascript" src="scripts/jquery.tooltip.js"></script>
<script type="text/javascript" src="scripts/jquery.alerts.js"></script>
<link type="text/css" href="http://jqueryui.com/latest/themes/base/ui.all.css" rel="stylesheet" />


 <script type="text/javascript">

  $(function() {		
		$("#table1").tablesorter({sortList:[[0,1]]});
	});	
  $(function() {		
		$("#table2").tablesorter({sortList:[[0,1]]});
	});	
	
		jQuery(document).ready(function() {
				jQuery('table').Scrollable(300, 530);
			});
			
  $(function() {		

$('#tooltip1').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#tooltip2').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#tooltip3').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#website').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#confirmcolor').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#mmscolor').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#smscolor').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#direction').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#langdirection').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});
$('#timeout').tooltip({ 
    track: false, 
    delay: 500, 
    showURL: false, 
    showBody: " - ", 
    fade: 300 
});


			});

			
			
			
	</script>
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