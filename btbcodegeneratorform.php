<?
include("include/session.php");
include ("connectdb.php");
?>
<?php include"header.php"; ?>
<?php include "menu.php" ?>

	<script type="text/javascript" src="scripts/jquery.beautyOfCode.js"></script>
	<script type="text/javascript" src="scripts/farbtastic.js"></script>
<link rel="stylesheet" href="stylesheets/farbtastic.css" type="text/css" />

	<script type="text/javascript">
		$.beautyOfCode.init({
			brushes: ['Xml', 'JScript', 'CSharp', 'Plain', 'Php'],
			ready: function() {
				$.beautyOfCode.beautifyAll();
				$("#someCode").beautifyCode('javascript', {gutter:false});
			}
		});
		$(document).ready(function() {
		$(".viewdemo").val($(".boc-html-script").text());
		});
	</script>
<link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="stylesheets/template.css" media="screen" />
<style type="text/css">
.stdbtn { width:280px; }
</style>

        <style type="text/css">
            
			/* 
			 * The state classes are a little bit complex, because of the doubble class bug in IE6
			 * The state class looks like this:
			 * 
			 * .ui-radio-state[-checked][-disabled][-hover] or .ui-checkbox-state[-checked][-disabled][-hover]
			 * 
			 * Examples:
			 * 
			 * .ui-radio-state-checked (simply checked) 
			 * .ui-radio-state-checked-hover (checked and hovered/focused)
			 * .ui-radio-state-hover (unchecked and hovered/focused)
			 * 
			 */
			
			.ui-radio-state-disabled,
			.ui-radio-state-checked-disabled,
			.ui-radio-state-disabled-hover,
			.ui-radio-state-checked-disabled-hover {
				color: #999;
			}
			span.ui-checkbox,
			span.ui-radio {
				display: block;
				float: left;
				width: 16px;
				height: 16px;
				background: url(icon_checkbox.png) 0 -40px no-repeat;
			}
			span.ui-helper-hidden {
				display: none;
			}
			label {
				padding: 2px;
				
			}
			span.ui-radio-state-hover,
			span.ui-checkbox-state-hover {
				background-position: 0 -114px;
			}
			
			span.ui-checkbox-state-checked {
				background-position: 0 -1px;
			}
			
			span.ui-checkbox-state-checked-hover {
				background-position: 0 -75px;
			}
			span.ui-radio-state-checked-disabled-hover,
			span.ui-radio-state-checked-disabled,
			span.ui-radio-state-checked {
				background-position: 0 -161px;
			}
			
			
			span.ui-radio-state-checked-hover {
				background-position: 0 -200px;
			}
        </style>
        <script type="text/javascript">
            $(function(){
				
            	$('input').checkBox();
				
				$('#toggle-all').click(function(){
					$('#example input[type=checkbox]').checkBox('toggle');
					return false;
				});
				
				$('#check-all').click(function(){
					$('#example input[type=checkbox]').checkBox('changeCheckStatus', true);
					return false;
				});
				$('#uncheck-all').click(function(){
					$('#example input[type=checkbox]').checkBox('changeCheckStatus', false);
					return false;
				});
				$('#check-2').click(function(){
					$('#example input[type=radio]:eq(1)').checkBox('changeCheckStatus', true);
					return false;
				});
				$('#native').click(function(){
					//native methods
					$('#example input[type=radio]:eq(0)').attr({checked: true, disabled: true})
						//reflect the current state
						.checkBox('reflectUI');
					return false;
				 });
			});
			
			
			    $(document).ready(function() {
    var f = $.farbtastic('#picker');
    var p = $('#picker').css('display', 'none');
    var selected;
    $('.colorwell')
      .each(function () { f.linkTo(this); $(this).css('opacity', 0.75); })
      .focus(function() {
	  $('#picker').css('display', 'inline')
        if (selected) {
          $(selected).css('opacity', 0.75);
        }
        f.linkTo(this);
        p.css('opacity', 1);
        $(selected = this).css('opacity', 1);
      })
      .blur(function() {
          $('#picker').css('display', 'none');
      });
  });

			
			
			
        </script>
		<style>
			form {
				overflow: hidden;
				height: 1%;
				margin: 20px 0;
				color: #fff;
			}
			
			fieldset {
				padding: 10px;
				color: #fff;
				background: #333;
			}
			
			.ui-helper-hidden-accessible {
				position: absolute;
				left: -999em;
			}
			table {
				margin: 10px 0;
				border-collapse: collapse;
				width: 100%;
			}
			caption {
				text-align: left;
			}
			th,
			td {
				border: 1px solid #000;
			}
		</style>
					<link rel="stylesheet" href="uploadify/uploadify.css" type="text/css" />
					<link rel="stylesheet" href="css/uploadify.jGrowl.css" type="text/css" />

					<script type="text/javascript" src="js/jquery.uploadify.js"></script>
					<script type="text/javascript" src="js/jquery.jgrowl_minimized.js"></script>

<script type="text/javascript">

$(document).ready(function() {



	$("#fileUploadgrowl").fileUpload({
		'uploader': 'uploadify/uploader.swf',
		'cancelImg': 'uploadify/cancel.png',
		'script': 'uploadify/upload.php',
		'folder': 'files/<?=$session->username?>',
		'fileDesc': 'Image Files',
		'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
		'multi': false,
		'simUploadLimit': 3,
		'sizeLimit': 10485760,
		onError: function (event, queueID ,fileObj, errorObj) {
			var msg;
			if (errorObj.status == 404) {
				alert('Could not find upload script. Use a path relative to: '+'<?= getcwd() ?>');
				msg = 'Could not find upload script.';
			} else if (errorObj.type === "HTTP")
				msg = errorObj.type+": "+errorObj.status;
			else if (errorObj.type ==="File Size")
				msg = fileObj.name+'<br>'+errorObj.type+' Limit: '+Math.round(errorObj.sizeLimit/1024)+'KB';
			else
				msg = errorObj.type+": "+errorObj.text;
			$.jGrowl('<p></p>'+msg, {
				theme: 	'error',
				header: 'ERROR',
				sticky: true
			});			
			$("#fileUploadgrowl" + queueID).fadeOut(250, function() { $("#fileUploadgrowl" + queueID).remove()});
			return false;
		},
		onCancel: function (a, b, c, d) {
			var msg = "Cancelled uploading: "+c.name;
			$.jGrowl('<p></p>'+msg, {
				theme: 	'warning',
				header: 'Cancelled Upload',
				life:	4000,
				sticky: false
			});
		},
		onClearQueue: function (a, b) {
			var msg = "Cleared "+b.fileCount+" files from queue";
			$.jGrowl('<p></p>'+msg, {
				theme: 	'warning',
				header: 'Cleared Queue',
				life:	4000,
				sticky: false
			});
		},
		onComplete: function (a, b ,c, d, e) {
			var size = Math.round(c.size/1024);
			$.jGrowl('<p></p>'+c.name.toLowerCase()+' - '+size+'KB', {
				theme: 	'success',
				header: 'Upload Complete',
				life:	4000,
				sticky: false
			});
			$('.display_uploaded_image').html('<img src="files/<?=$session->username?>/'+c.name.toLowerCase()+'" style="max-width:260px; max-height:260px;"/><input type="hidden" name="image" id="image" value="files/<?=$session->username?>/'+c.name+'" />');
			$('#fileUploadgrowlUploader').css('display','none');
			$('#startupload').html('');
		}
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

<?php if (isset($_GET[user])){ ?>
	<pre class="code">
		<code class="php boc-html-script">
			&lt;script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js">&lt;/script>

		
			&lt;link href="<?='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])?>/stylesheets/btb_ut_style.css" rel="stylesheet" type="text/css" media="screen" />
			
			
			&lt;script id="btb_ut_script_tag" type="text/javascript" src="<?='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])?>/scripts/btb_ut_script.js?direction=<?=$_GET[direction]?>&seperator=<?='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'/'.strtolower($_GET[image])?>&username=<?=$_GET[user]?>&textdirection=<?=$_GET[langdirection]?>&mmstimeout=<?=$_GET[timeout]?>&confirmcolor=<?=$_GET[confirmcolor]?>&mmscolor=<?=$_GET[mmscolor]?>&smscolor=<?=$_GET[smscolor]?>">&lt;/script>
		</code>
	</pre>


<?php } ?>
<link rel="stylesheet" type="text/css" href="stylesheets/validationEngine.jquery.css" media="screen" />
<script src="scripts/jquery.validationEngine.js" type="text/javascript"></script>

		<form id="formID" class="formular" method="get" action="btbcodegeneratorform.php" name="formID">
			<fieldset>
				<label>
					<span>Confirm Box Color: </span>
					<input class="validate[required],length[0,7]] text-input colorwell" type="text" id="confirmcolor" name="confirmcolor" value="<?php if (isset($_GET[confirmcolor])) { echo $_GET[confirmcolor]; } else { echo "#ffffff"; }?>" title="This is the color of the confirm box." />
				</label>
				<label>
					<span>MMS Box Color: </span>
					<input class="validate[required],length[0,7]] text-input colorwell" type="text" id="mmscolor" name="mmscolor" value="<?php if (isset($_GET[mmscolor])) { echo $_GET[mmscolor]; } else { echo "#ffffff"; }?>" title="This is the color of the MMS box." />
				</label>
				<label>
					<span>SMS Box Color: </span>
					<input class="validate[required],length[0,7]] text-input colorwell" type="text" id="smscolor" name="smscolor" value="<?php if (isset($_GET[smscolor])) { echo $_GET[smscolor]; } else { echo "#ffffff"; }?>" title="This is the color of the SMS box." />
				</label>
				<input type="hidden" name="user" id="user" value="<?=$session->username?>" />
				</fieldset>
			<fieldset>
				<label>
					<span>Text Scroll Direction:</span>
				<select name="direction" id="direction"  class="validate[required]" title="The direction in which the text will scroll.">
					<option value="">Select Text Scroll Direction</option>
					<option value="left"<?=($_GET['direction']== "left")?" selected":"";?>>Right to Left</option>
					<option value="right"<?=($_GET['direction']== "right")?" selected":"";?>>Left to Right</option>
				</select>
				</label>
			</fieldset>
			<fieldset>
				<label>
					<span>Language Direction:</span>
				<select name="langdirection" id="langdirection"  class="validate[required]" title="The base direction of the text content. For example, select rtl for Arabic language.">
					<option value="">Select language Direction</option>
					<option value="rtl" <?=($_GET['langdirection']== "rtl")?" selected":"";?>>Right to Left (rtl) </option>
					<option value="ltr" <?=($_GET['langdirection']== "ltr")?" selected":"";?>>Left to Right (ltr) </option>
				</select>
				</label>
			</fieldset>
			<fieldset>
				<label>
					<span>MMS Message Timeout: </span>
					<input class="validate[required,custom[onlyNumber],length[0,3]] text-input" type="text" name="timeout" id="timeout" value="<?=$_GET[timeout]?>" title="The time after which the MMS message will disappear." />
				</label>
			</fieldset>
			<fieldset>
				<label>
					<span>Upload Message Seperator: </span>
					<br />
				

		<div id="fileUploadgrowl">You have a problem with your javascript</div>
		<div class="display_uploaded_image"><?php if(isset($_GET[image])) { echo '<img src="'.$_GET[image].'"  style="max-width:260px; max-height:260px;"><input type="hidden" name="image" id="image" value="'.$_GET[image].'" />'; }  ?></div>
		<a href="javascript:$('#fileUploadgrowl').fileUploadStart()" id="startupload">Start Upload</a>
				</label>
			</fieldset>
					
					
					<fieldset>
					<input class="submit" type="submit" value="Submit"/>
					</fieldset>
</form>
<?php } ?>
</div>
</div>

<?php include "rightnav.php" ?>


<div style="clear: both;"> </div>
</div>

<?php include "footer.php" ?>