<?
include("include/session.php");
include ("connectdb.php");
?>
<?php include"header.php"; ?>
<?php include "menu.php" ?>
<div id="content">
<div class="left"> 

<h2>
<a href=""></a>

</h2>
<div class="articles">

<?php if($session->logged_in){ ?>

<!-- 
<script type="text/javascript" src="jquery.editable-1.3.3.js"></script>
<div style="border: solid thin gray; padding:5px;">
<div class="myeditable"><b> Click me! I am editable!!! </b></div>
</div>
<script type="text/javascript">

    $('.myeditable').editable(
            {
           type:'text',
           submit:'save'
            })

</script>
-->

<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<!--
<script type="text/javascript">
window.onload = function()
{
var oFCKeditor = new FCKeditor( 'MyTextarea' ) ;
oFCKeditor.BasePath = "./fckeditor/" ;
oFCKeditor.ReplaceTextarea() ;

        //alert(document.getElementById("MyTextarea").innerHTML)
}
</script>

<textarea id="MyTextarea" name="MyTextarea">Look at me, I am <b>WYSIWYG!</b></textarea>-->





<script type="text/javascript" src="jquery.editable.wysiwyg-1.3.3.1.js"></script>


<form id="submit" method="post">

<div style="border: solid thin gray; padding:5px; text-align:center;">
<div  class="myipwe"><b>Click here to enter an mms message</b> </div>
</div>
	</form>


<script type="text/javascript">
    //set all the FCKeditor configuration here and pass it to the editable
    var oFCKeditor = new FCKeditor( 'editor1') ;
    oFCKeditor.BasePath = "./fckeditor/" ;
            
    $('.myipwe').editable(
            {
           type: 'wysiwyg',
           editor: oFCKeditor,
           onSubmit:function submitData(content){
               //alert(content.current)
			   
			   //$('#timeval').load('insert-mms.php?message='+ content.current);
			   
			   		$.ajax({
			type: "POST",
			url: "insert-mms.php",
			data: "message="+ content.current,
			success: function(){
				//$('form#submit').hide();
				//$('div.success').fadeIn();
				//alert( "Data Saved: " + content.current );
				//$(".myipwe").html("Message Successfully Submitted. <br /> <br /> Click here to add another message. ");
				location.reload(true);
								}
							}).responseText;
           },	
           submit:'save'
            });
</script>
<script type="text/javascript">
/*
$(document).ready(function(){
	$("form#submit").submit(function() {
 
	// we want to store the values from the form input box, then send via ajax below
	var fname     = $('#fname').attr('value');
	var lname     = $('#lname').attr('value'); 
 
		$.ajax({
			type: "POST",
			url: "ajax.php",
			data: "fname="+ fname +"& lname="+ lname,
			success: function(){
				$('form#submit').hide();
				$('div.success').fadeIn();
			}
		});
	return false;
	});
});
*/
</script>

<?php


// Performing SQL query
$query1 = 'SELECT id, message FROM mmsmessages where username = "'.$session->username.'"';
$result = mysql_query($query1) or die('Query failed: ' . mysql_error());



 if($session->logged_in){ 
// Printing results in HTML
echo '<br /><br /><table border="0" id="table1" class="tablesorter">';
echo "<thead><tr>";
echo "<th scope=\"col\">id</th><th scope=\"col\">message</th><tbody>";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</tbody></table>\n";
}
?>



<?php } ?>


</div>
</div>

<?php include "rightnav.php" ?>


<div style="clear: both;"> </div>
</div>

<?php include "footer.php" ?>