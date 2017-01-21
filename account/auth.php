<?php
	header("Content-Type:text/html; charset=utf-8");
	session_start();


	require_once(dirname(dirname(__FILE__))."/recaptcha/src/autoload.php");

	$siteKey = '6Lc59AsTAAAAAEmotsE8ulTtZBRX--XdVS4hZYJR';
	$secret = '6Lc59AsTAAAAAKIbpZdEzWC7dsFORIZTvh7jTSOM';
	
	$gRecaptchaResponse = $_POST['g-recaptcha-response'];
	$remoteIp = $_SERVER['REMOTE_ADDR'];
	$recaptcha = new \ReCaptcha\ReCaptcha($secret);
	$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
	if ($resp->isSuccess()) {
		// verified!
	} else {
		echo $resp->getErrorCodes();
		header("Location:/account/?e=3");	//recaptcha 錯誤
		exit;
	}

	
	if (isset($_POST['email']) and isset($_POST['pwd'])) {
		$email =$_POST['email'];
		$password = md5($_POST['pwd']);
		require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
		
		//找帳號
		$sql = "select m_pwd,m_name,m_auth,m_id from member where m_email = '$email'";
		$result = $mysqli->query($sql);
		if(!$result) {
			printf("Error: %s\n", $mysqli->error);
		} else {
			$totalNum = mysqli_num_rows($result);
			for ($i=0;$i<1;$i++) {$row = mysqli_fetch_assoc($result);}
			$uid =$row['m_id'];
		}
		
		//setting datetime
		date_default_timezone_set('Asia/Taipei');
		$time = date("ymdHis");

		if ($totalNum == 0) {	//如果找不到帳號
			header("Location:/account/?e=5");	//無此帳號
			exit;
		} else {
			//取出密碼
			$pwd=$row['m_pwd'];
			session_unset();
			$_SESSION['email'] = $row['m_email'];
			$_SESSION['uname'] = $row['m_name'];
			$_SESSION['auth'] = $row['m_auth'];
			$_SESSION['uid'] = $row['m_id'];
			//比對密碼
			if (strcmp($pwd,$password)==0){ //密碼相符
				$_SESSION["login"]="y"; 
				$sql = "insert into login_record(datetime,m_id,state,reason) values ($time,'$uid','1','帳號密碼登入成功')";
				$result = $mysqli->query($sql);
				if(!$result) {
					printf("Error: %s\n", $mysqli->error);
					exit;
				}
				$mysqli->close();
				header("Location:/");
				exit;
			} else {
				$sql = "insert into login_record(datetime,m_id,state,reason) values ('$time','$uid','0','密碼錯誤！')";
				$result = $mysqli->query($sql);
				if(!$result) {
					printf("Error: %s\n", $mysqli->error);
					exit;
				}
				$mysqli->close();
				header("Location:/account/?e=4");	//密碼錯誤
				exit;
			}
		}

	} else {
		$sql = "insert into login_record(datetime,m_id,state,reason) values ('$time','$uid','0','其他錯誤！')";
		$result = $mysqli->query($sql);
		if(!$result) {
			printf("Error: %s\n", $mysqli->error);
			exit;
		}
		$mysqli->close();
		header("Location:/account/?e=1");
		exit;
	}
?>