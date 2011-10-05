<?php
include("include/session.php");
include ("connectdb.php");

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
	$str = strtolower($_FILES['Filedata']['name']);
	$targetFile =  str_replace('//','/',$targetPath) . $str;
	
	// Uncomment the following line if you want to make the directory if it doesn't exist
	 mkdir(str_replace('//','/',$targetPath), 0755, true);
	
	move_uploaded_file($tempFile,$targetFile);
}
	
echo '1';

?>