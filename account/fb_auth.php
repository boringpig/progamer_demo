<?php
	//fb_auth
	session_start();
	require_once (dirname(dirname(__FILE__))."/vendor/autoload.php");
	$fb = new Facebook\Facebook([
		'app_id' => '926101500780205',
		'app_secret' => '6b0ab9cde5e109427010649d4bc6c15d',
		'default_graph_version' => 'v2.4',
	]);
	$helper = $fb->getRedirectLoginHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	if (isset($accessToken)) {
		
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		// Now you can redirect to another page and use the
		// access token from $_SESSION['facebook_access_token']
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		try {
			$response = $fb->get('/me?fields=id,name,picture{url},email,gender,birthday',$_SESSION['facebook_access_token']);
			$graphNode = $response->getGraphNode();
			$userNode = $response->getGraphUser();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		echo "<a href=\"/logout.php\">登出</a>";
		//$uname = $graphNode->getField('name');
		//$_SESSION['uname'] = $uname;

		$uid = $graphNode->getField('id');
		$_SESSION['uid'] = $uid;
		$email = $graphNode->getField('email');
		$_SESSION['email'] =$email;
		
		$pic = $graphNode->getField('picture')->getField('url');
		//$_SESSION['upic'] = $pic;

		$sex = $graphNode->getField('gender');
		$_SESSION['sex'] = $sex;

		$birthday =$graphNode->getField('birthday');
		$user_birthday = date_format($birthday,'Y-m-d');
		$_SESSION['birthday'] = $user_birthday;
 		
 		//check ismemeber
 		require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
		//檢查是否為會員
		$sql = "select * from member where m_email = '$email'";
	 	if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
		} else {
			$result = $mysqli->query($sql);
			$email_num=mysqli_num_rows($result);  // 取得記錄數

			$sql = "select * from member where m_fbuid = '$uid'";
			$result = $mysqli->query($sql);
			$fb_num=mysqli_num_rows($result);  // 取得記錄數
		}

		if ($email_num == 1){	//如果已經是會員則連結FB
			if ($fb_num == 0 ){
				header("Location:fbconnect.php");
				$mysqli->close();
				exit();
			}
		} else {
			if ($fb_num == 0) {
				header("Location:registration.php");
	 			$mysqli->close();
	 			exit();
			}
		}

		date_default_timezone_set('Asia/Taipei');
		$time = date("ymdHis");
 		// Logged in!
 		session_unset();
		$_SESSION["login"]="y";
		for($i=0;$i<1;$i++){$row = mysqli_fetch_assoc($result);}
		$_SESSION['email'] = $row['m_email'];
		$_SESSION['auth'] = $row['m_auth'];
		$_SESSION['uid'] = $row['m_id'];
		$_SESSION['uname'] = $row['m_name']; //bar need
		$uid = $row['m_id'];
		$sql = "insert into login_record(datetime,m_id,state,reason) values ($time,$uid,'1','從Facebook登入')";
		$result = $mysqli->query($sql);
		if(!$result) {
			printf("Error: %s\n", $mysqli->error);
			exit;
		}
		$mysqli->close();
		header("Location:/");
		exit;
	}
	header("Location:/account/?e=2");
?>
