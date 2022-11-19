<?php
	global $db;
	$server = 'localhost';
	$user = 'root';
	$pass = 'root';
	$dbname = 'syba_db';
	$db = mysqli_connect($server,$user,$pass,$dbname);
	if(!$db) {
		exit("connection string failed");
	}
?>

