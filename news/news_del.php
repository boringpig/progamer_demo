<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(3);

	session_start();
	$nid = $_GET['id'];
	

	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");
	$sql = "delete from news where news_id = '$nid'";
	if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
	} else {
		$result = $mysqli->query($sql);
	}
	$mysqli->close();
	header("Location:/news/");
	exit;
?>