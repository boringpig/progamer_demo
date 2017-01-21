<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(3);

	session_start();
	$nid = $_SESSION['newsid'];
	unset($_SESSION['newsid']);

	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");
	$sql = "select news_id from news where news_id = '$nid'";
	if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
	} else {
		$result = $mysqli->query($sql);
		$total_records=mysqli_num_rows($result);  // 取得記錄數
	}
	if ($total_records == 0) { //如果找不到
		echo "Not found";
		//header("Location:/news/")
	} else {
		$sql ="update news set news_title = '$_POST[ntitle]',news_content = '$_POST[nct]',news_type = '$_POST[type]'   where news_id = '$nid'";
		$result = $mysqli->query($sql);
		echo "Success";
		header("Location:/news/");
	} 
?>