<?php	include ("connectdb.php");
?>
<div id="content">
<div class="left"> 

<h2>
<a href=""></a>

</h2>
<div class="articles">
<div id="dialog" title="Select target Website" style="display:none">

<?php
$query="SELECT username FROM users";

/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$result = mysql_query ($query);
echo "<select name=websites value='Select target Website' id=\"twebsite\">Websites</option>";
// printing the list box select command

while($nt=mysql_fetch_array($result)){//Array or records stored in $nt
if($nt[username] != "admin") 
echo "<option value=$nt[username]>$nt[username]</option>";
/* Option values are added by looping through the array */
}
echo "</select>";// Closing of list box 
?>

</div>

<script type="text/javascript" src="jquery.editable-1.3.3.js"></script>
<div style="border: solid thin gray; padding:5px; text-align:center;">
<div class="myeditable"><b> Click here to send a SMS as guest ! </b></div>
</div>
<script type="text/javascript">
    $('.myeditable').editable(
            {
           type:'textarea',
		   onSubmit:function submitData(content){
               //alert(content.current)
			   
			   //$('#timeval').load('insert-sms.php?message='+ content.current);

			   jPrompt('Number of times to display this message:', '', '', function(r) {
					if( r ) {
					
					
							//$.ui.dialog.defaults.bgiframe = true;
							$(function() {
								$("#dialog").dialog({autoOpen: false,  buttons: { "Ok": function() { $(this).dialog("close"); } },
beforeclose: function(event, ui) {
var twebsite = $("#twebsite").val();

					$.ajax({
						type: "POST",
						url: "insert-sms-guest.php",
						data: "message="+ content.current+"&repeat="+ r+"&twebsite="+twebsite,
						success: function(){
							//$(".myipwe").html("Message Successfully Submitted. <br /> <br /> Click here to add another message. ");
							location.reload(true);
											}
										}).responseText;




 }
 
								});
								  $('#dialog').dialog('open'); 
							});



				
							} else { jAlert('You did not enter number of times to display the message.'); }
				});

			   
			   		
           },	
           submit:'save'
            })

</script>

<br />

<script type="text/javascript" src="fckeditor/fckeditor.js"></script>

<script type="text/javascript" src="jquery.editable.wysiwyg-1.3.3.1.js"></script>


<form id="submit" method="post">

<div style="border: solid thin gray; padding:5px; text-align:center;">
<div  class="myipwe"><b>Click here to send a MMS as guest !</b> </div>
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
			   
			   //$('#timeval').load('insert-sms.php?message='+ content.current);

				
							//$.ui.dialog.defaults.bgiframe = true;
							$(function() {
								$("#dialog").dialog({autoOpen: false,  buttons: { "Ok": function() { $(this).dialog("close"); } },
beforeclose: function(event, ui) {
var twebsite = $("#twebsite").val();

					$.ajax({
						type: "POST",
						url: "insert-mms-guest.php",
						data: "message="+ content.current+"&twebsite="+twebsite,
						success: function(){
							//$(".myipwe").html("Message Successfully Submitted. <br /> <br /> Click here to add another mms message. ");
							location.reload(true);
											}
										});


							

 }
 
								});
								  $('#dialog').dialog('open'); 
							});


		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   

		   
		   
		   
		   
		   
           },	
           submit:'save'
            });
					   
</script>

</div>
</div>

<?php include "rightnav.php" ?>


<div style="clear: both;"> </div>
</div>
