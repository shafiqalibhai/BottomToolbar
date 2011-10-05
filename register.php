<?php include"include/session.php" ?>
<?php include"header.php" ?>
<?php include "menu.php" ?>

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

<div id="content">
<div class="left"> 

<h2>
<a href=""></a>

</h2>
<div class="articles">
<?
/**
 * The user is already logged in, not allowed to register.
 */
if($session->logged_in){
   echo "<h1>Registered</h1>";
   echo "<p>We're sorry <b>$session->username</b>, but you've already registered. </p>";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else if(isset($_SESSION['regsuccess'])){
   /* Registration was successful */
   if($_SESSION['regsuccess']){
      echo "<h1>Registered!</h1>";
      echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your information has been added to the database. You can login now.</p>";
   }
   /* Registration failed */
   else{
      echo "<h1>Registration Failed</h1>";
      echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
          ."could not be completed.<br>Please try again at a later time.</p>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>
<?
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>

<?php 
//include "connectdb.php";
//$username=htmlspecialchars($_POST['user'],ENT_QUOTES);
//$password=md5($_POST['password']);
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
	//mysql_query("INSERT INTO `tbl_user` (`user_id` ,`user_name` ,`password`) VALUES (NULL ,'$username', '$password')");

   // echo '<p>Congratulations! You have successfully registered!</p><p>Click <a href="login.php">here</a> to login.</p>';
//	}
  ?>
<link rel="stylesheet" type="text/css" href="stylesheets/validationEngine.jquery.css" media="screen" />
<script src="scripts/jquery.validationEngine.js" type="text/javascript"></script>

		<form id="formID" class="formular" method="post" action="process.php">
			<fieldset>
				<label>
					<span>Desired username : </span><? echo $form->error("user"); ?>
					<input class="validate[optional,custom[noSpecialCaracters],length[0,20]] text-input" type="text" name="user" id="user" value="<? echo $form->value("user"); ?>" />
				</label>
				</fieldset>
				<!--<label>
					<span>First name : </span>
					<input class="validate[required,custom[onlyLetter],length[0,100]] text-input" type="text" name="firstname" id="firstname" />
				</label>
				<label>
					<span>Last name : </span>
					<input class="validate[required,custom[onlyLetter],length[0,100]] text-input" type="text" name="lastname" id="lastname" />
				</label>
				<div>
					<span>Radio Groupe : <br /></span>
					<span>radio 1: </span>
					<input class="validate[required] radio" type="radio"  name="radiogoupe"  id="radio1"  value="5">
					<span>radio 2: </span>
					<input class="validate[required] radio" type="radio" name="radiogoupe"  id="radio2"  value="3"/>
					<span>radio 3: </span>
					<input class="validate[required] radio" type="radio" name="radiogoupe"  id="radio3"  value="9"/>
				</div>
				<div>
					<span>Max 2 checkbox : <br /></span>
				
					<input class="validate[minCheckbox[2]] checkbox" type="checkbox"  name="checkboxgroupe" id="maxcheck1" value="5">
					
					<input class="validate[minCheckbox[2]] checkbox" type="checkbox" name="checkboxgroupe" id="maxcheck2"  value="3"/>
				
					<input class="validate[minCheckbox[2]] checkbox" type="checkbox" name="checkboxgroupe" id="maxcheck3"  value="9"/>
				</div>
				<label>
					<span>Date : (format YYYY-MM-DD)</span>
					<input class="validate[required,custom[date]] text-input" type="text" name="date"  id="date" />
				</label>
				<label>
					<span>Favorite sport 1:</span>
				<select name="sport" id="sport"  class="validate[required]"  id="sport"  >
					<option value="">Choose a sport</option>
					<option value="option1">Tennis</option>
					<option value="option2">Football</option>
					<option value="option3">Golf</option>
				</select>
				</label>
				<label>
					<span>Favorite sport 2:</span>
				<select name="sport2" id="sport2" multiple class="validate[required]"  id="sport2"  >
					<option value="">Choose a sport</option>
					<option value="option1">Tennis</option>
					<option value="option2">Football</option>
					<option value="option3">Golf</option>
				</select>
				</label>
				<label>
					<span>Age : </span>
					<input class="validate[required,custom[onlyNumber],length[0,3]] text-input" type="text" name="age"  id="age" />
				</label>
					
				<label>
					<span>Telephone : </span>
					<input class="validate[required,custom[telephone]] text-input" type="text" name="telephone"  id="telephone" />
				</label>
			</fieldset> -->
			<fieldset>
				<label>
					<span>Password : </span><? echo $form->error("pass"); ?>
					<input class="validate[required,length[6,11]] text-input" type="password" name="pass"  id="password"  />
				</label>
				<label>
					<span>Confirm password : </span>
					<input class="validate[required,confirm[password]] text-input" type="password" name="password2"  id="password2" />
				</label>
			</fieldset>
			<fieldset>
				<label>
					<span>Email address : </span><? echo $form->error("email"); ?>
					<input class="validate[required,custom[email]] text-input" type="text" name="email" id="email"  value="<? echo $form->value("email"); ?>" />
				</label>
				<label>
					<span>Confirm email address : </span>
					<input class="validate[required,confirm[email]] text-input" type="text" name="email2"  id="email2" />
				</label>
			</fieldset>
			<!-- 
			<fieldset>
				<label>
					<span>Comments : </span>
					<textarea class="validate[required,length[6,300]] text-input" name="comments" id="comments" /> </textarea>
				</label>

			</fieldset>
			-->
			<fieldset>
				<div class="infos">Checking this box indicates that you accept terms of use. If you do not accept these terms, do not use this website : </div>
				<label>
					<span class="checkbox">I accept terms of use : </span>
					<input class="validate[required] checkbox" type="checkbox"  id="agree"  name="agree"/>
				</label>
			</fieldset>
			<input type="hidden" name="subjoin" value="1">
			<input class="submit" type="submit" value="Submit"/>
<hr/>
</form>

<?
}
?>

</div>
</div>
<?php include "rightnav.php" ?>
<div style="clear: both;"> </div>
</div>
<?php include "footer.php" ?>