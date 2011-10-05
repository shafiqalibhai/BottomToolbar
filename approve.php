<?
include("include/session.php");
include ("connectdb.php");
?>
<?php include"header.php"; ?>
<?php include "menu.php" ?>
<script type="text/javascript">

jQuery(document).ready(function() {										
$('#table1').each(function()
{
  message = $(this).find("td").eq(1).html();
});
$('#table2').each(function()
{
  mmsmessage = $(this).find("td").eq(1).html();
});
	
$("#approvesms").click(function () {

					$.ajax({
						type: "POST",
						url: "approve-sms.php",
						data: "message="+ message,
						success: function(){
							location.reload(true);
											}
										}).responseText;
});
$("#approvemms").click(function () {

					$.ajax({
						type: "POST",
						url: "approve-mms.php",
						data: "message="+ mmsmessage,
						success: function(){
							location.reload(true);
											}
										}).responseText;
});
$("#deletemms").click(function () {
						alert(mmsmessage);

					$.ajax({
						type: "POST",
						url: "delete-mms.php",
						data: "message="+ mmsmessage,
						success: function(){
							location.reload(true);
											}
										}).responseText;
});
$("#deletesms").click(function () {
					$.ajax({
						type: "POST",
						url: "delete-sms.php",
						data: "message="+ message,
						success: function(){
							location.reload(true);
											}
										}).responseText;
});
});

</script>

<div id="content">
<div class="left"> 

<h2>
<a href=""></a>

</h2>
<div class="articles">

<?php if($session->logged_in){ ?>



<?php


// Performing SQL query
$query1 = 'SELECT id, message FROM smsmessages where username = "'.$session->username.'" and duration < 0';
$result = mysql_query($query1) or die('Query failed: ' . mysql_error());



// Printing results in HTML
echo '<br /><br />Unapproved SMS messages :<br /><table border="0" id="table1" class="tablesorter">';
echo "<thead><tr><th scope=\"col\">";
echo "id</th><th scope=\"col\">Message</th><th scope=\"col\">Action</th><tbody>";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td id='asd'>$col_value</td>\n";
    }
			echo '<td><a href="#" id="approvesms">Approve</a> / <a href="#" id="deletesms">Delete</a></td>';
    echo "\t</tr>\n";
}
echo "</tbody></table>\n";
?>


<?php


// Performing SQL query
$query1 = "SELECT id, message FROM mmsmessages where username = '$session->username' and approved < 0";
$result = mysql_query($query1) or die('Query failed: ' . mysql_error());



// Printing results in HTML
echo '<br /><br />Unapproved MMS messages :<br /><table border="0" id="table2" class="tablesorter">';
echo "<thead><tr>";
echo "<th scope=\"col\">id</th><th scope=\"col\">Message</th><th scope=\"col\">Action</th><tbody>";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";

    }
			echo '<td><a href="#" id="approvemms">Approve</a> / <a href="#" id="deletemms">Delete</a></td>';

    echo "\t</tr>\n";
}
echo "</tbody></table>\n";
?>



<?php } ?>
</div>
</div>

<?php include "rightnav.php" ?>


<div style="clear: both;"> </div>
</div>

<?php include "footer.php" ?>