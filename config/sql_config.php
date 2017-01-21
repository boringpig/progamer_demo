<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$servername = "localhost";
	$user = "progame8_devin";
	$pwd = "b10123007";
	$dbname = "progame8_progamer";

	$mysqli = new mysqli($servername,$user,$pwd,$dbname);
	
	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	$mysqli->query("set names 'UTF8'");
?>