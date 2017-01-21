<?php
	if (isset($_GET['email'])) {
		require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
	 	$mysqli = new mysqli($servername,$user,$pwd,$dbname);
		/* check connection */
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$email = $_GET['email'];
		$sql = "select * from member where m_email = '$email'";
		if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
		} else {
			$result = $mysqli->query($sql);
			$totalNum = mysqli_num_rows($result);
		}
		$mysqli->close();
		if ($totalNum == 0) {
			echo 0;
		} else {
			echo 1;
		}
	} else {
		echo 1;
	}
	
?>