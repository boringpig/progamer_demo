<?php
	require_once(dirname(dirname(__FILE__))."/vendor/autoload.php");
	require_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	isLogin();

	//Facebook login
	$fb = new Facebook\Facebook([
		'app_id' => '926101500780205',
		'app_secret' => '6b0ab9cde5e109427010649d4bc6c15d',
		'default_graph_version' => 'v2.4',
	]);
	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email','user_birthday']; // optional
	$loginUrl = $helper->getLoginUrl('http://progamer.tw/account/fb_auth.php', $permissions);

?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>登入 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script> <!--reCAPTCHA-->

	<style type="text/css">
		body {
			background-color: #eee;
			font-family: "Microsoft JhengHei";
		}

		.form-signin {
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
		}
		.form-signin .form-control {
			position: relative;
			height: auto;
			-webkit-box-sizing: border-box;
		       -moz-box-sizing: border-box;
					box-sizing: border-box;
			padding: 10px;
			font-size: 16px;
		}
		.form-signin .form-control:focus {
			z-index: 2;
		}
		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
	<div class="container" style="margin-top:20px;margin-bottom:20px;">
		<img style="height:200px;margin:0 auto;" class="img-responsive" alt="Brand" src="/img/logo.png">
		<h2 class="text-center" style="margin:0px;">探索PROGAMER的無限樂趣</h2>
		<form class="form-signin" action="auth.php" method="post" role="form">
			
			<h4 class="text-center" style="margin:0;">登入帳戶繼續使用PROGAMER</h4>
			<div class="form-group">
				<input name="email" type="email" class="form-control" placeholder="輸入您的電子郵件" autofoucus required autocomplete="off">
			</div>
			<div class="form-group">
				<input name="pwd" type="password" class="form-control" placeholder="密碼" required>
			</div>
			<div class="form-group">
				<div class="g-recaptcha" data-sitekey="6Lc59AsTAAAAAEmotsE8ulTtZBRX--XdVS4hZYJR"></div>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">進入PROGAMER</button>
			<a href="<?php echo $loginUrl;?>" class="btn btn-lg btn-primary btn-block">Facebook</a>
			<p></p>
			<a href="registration.php" class="btn btn-success pull-left">建立帳戶</a>
			<a href="#" class="btn btn-info pull-right">需要協助</a>
		</form>

		<?php
			if (isset($_GET['e'])){
				if($_GET['e']<= 7){
		?>
			<!-- Modal -->
				<div class="modal fade" id="Error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<?php
									if (strcmp($_GET['e'],"7")== 0) {
										echo "<h3 class=\"modal-title\">請重新登入</h3>";
									} else {
										echo "<h3 class=\"modal-title\">錯誤!</h3>";
									}
								?>
							</div>
							<div class="modal-body">
		<?php
				if (strcmp($_GET['e'],"1")== 0) {
					echo "<p>抱歉，請輸入正確的帳號及密碼</p>";
				}
				if (strcmp($_GET['e'],"2")== 0) {
					echo "<p>Facebook 登入錯誤</p>";
				}
				if (strcmp($_GET['e'],"3")== 0) {
					echo "<p>驗證機器人錯誤</p>";
				}
				if (strcmp($_GET['e'],"4")== 0) {
					echo "<p>密碼錯誤</p>";
				}
				if (strcmp($_GET['e'],"5")== 0) {
					echo "<p>查無此帳號，請重新輸入或<a href=\"account/registration.php\" class=\"btn btn-success\">建立帳戶</a></p>";
				}
				if (strcmp($_GET['e'],"6")== 0) {
					echo "<p>Facebook連結成功，請重新登入</p>";
				}
				if (strcmp($_GET['e'],"7")== 0) {
					echo "<p>註冊成功，請重新登入</p>";
				}
		?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
		<?php
			echo "<script type='text/javascript'>$('#Error').modal('show');</script>";
				}
			}
		?>
	</div> <!-- /container -->
</body>
</html>