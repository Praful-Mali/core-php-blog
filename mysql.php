<?php
global $conn ;

$conn = mysqli_connect('localhost','root','');
mysqli_select_db($conn ,'ci_blog');


function mysql_safe_string($value) {
	$conn = mysqli_connect('localhost','root','');
	$value = trim($value);
	if(empty($value))			return 'NULL';
	elseif(is_numeric($value))	return $value;
	else						return "'".mysqli_real_escape_string($conn,$value)."'";
}

function mysql_safe_query($query) {
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn ,'ci_blog');
	$args = array_slice(func_get_args(),1);
	$args = array_map('mysql_safe_string',$args);
	
	return mysqli_query($conn, vsprintf($query,$args));
}

function redirect($uri) {
	header('location:'.$uri);
	exit;
}




