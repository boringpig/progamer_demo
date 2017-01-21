<?php
	session_start();
	require_once(dirname(dirname(__FILE__))."/recaptcha/src/autoload.php");
	$siteKey = '6Lc59AsTAAAAAEmotsE8ulTtZBRX--XdVS4hZYJR';
	$secret = '6Lc59AsTAAAAAKIbpZdEzWC7dsFORIZTvh7jTSOM';
	
	$gRecaptchaResponse = $_POST['g-recaptcha-response'];
	$remoteIp = $_SERVER['REMOTE_ADDR'];
	$recaptcha = new \ReCaptcha\ReCaptcha($secret);
	$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
	if ($resp->isSuccess()) {
	
		require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL

		//set var
		date_default_timezone_set('Asia/Taipei');
		$time = date("ymdHis");
		$mid = (string)(rand(100,999).$time);

		if (isset($_POST['pwd'])){
			$password = $_POST['pwd'];
			$password=md5($password);
		} else {
			header("Location:registration.php?e=2");
			exit;
		}

		if (isset($_POST['email'])){
			$email = $_POST['email'];
		} else {
			header("Location:registration.php?e=2");
			exit;
		}
		
		if (isset($_POST['uname'])){
			$name = $_POST['uname'];
		} else {
			header("Location:registration.php?e=2");
			exit;
		}

		if (isset($_POST['sex'])){
			$sex = $_POST['sex'];
		} else {
			header("Location:registration.php?e=2");
			exit;
		}

		if (isset($_POST['ubd'])){
			$birthday = $_POST['ubd'];
		} else {
			header("Location:registration.php?e=2");
			exit;
		}

		if (isset($_POST['fbid'])){
			$fb = $_POST['fbid'];
		} else {
			$fb = "none";
		}

		$sql = "insert into member(m_id,m_auth,m_pwd,m_name,m_email,m_sex,m_birthday,m_fbuid,m_verify,m_enable,m_gmoney)
							values ('$mid','0','$password','$name','$email','$sex','$birthday','$fb','0','0','0.0')";
		if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
		} 
		$mysqli->close();
		header("Location:/account/?e=7");
	} else {
		header("Location:registration.php?e=1");
	}

	
?>