<?php
	require_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	isLogin();
	if (isset($_SESSION['email'])) {
		$pwd = substr(md5(rand()),0,6);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<title>帳戶申請 &middot; PROGAMER</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Devin">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
	<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script> <!--reCAPTCHA-->
	<script type="text/javascript" src="/js/customize.js"></script>

	<style type="text/css">
		body { padding-top: 60px;
			   font-family: "Microsoft JhengHei";
		}
	</style> 

</head>
<body style="background-color:#f5f5f5;">
	<!--Bar-->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">
					PROGAMER 
				</a>
	    	</div>
	    </div>
	</div>

	<div class="container">
		<div style="margin:0 auto;width:90%">
			<h2>註冊</h2>
			<form class="form-horizontal form" role="form" action="reg_member.php" method="post">
				<div id="femail" class="form-group form-group-lg col-md-12 row">
					<input name="email" id="email" type="email" class="form-control " placeholder="Email電子信箱" onkeyup="ckemail()" onblur="ckemail()" required <?php if(isset($_SESSION['email'])){echo "value='".$_SESSION['email']."' readonly";}?>>
					<span id="msg"></span>
					<p class="help-block">電子信箱將做為您的帳號</p>
				</div>
				<div id="fpwd" class="form-group form-group-lg col-md-12 row" <?php if(isset($pwd)){echo "style=display:none";}?>>
					<input name="pwd" id="pwd" type="password" class="form-control" placeholder="PROGAMER 密碼" required onkeyup="ckpwd()" <?php if(isset($pwd)){echo "value='".$pwd."' readonly=\"true\"";}?>>
					<span id="pwdmsg"></span>
					<p class="help-block">密碼必須超過6位數，及英文字母</p>
				</div>
				<div class="form-group form-group-lg col-md-12 row">
					<div class="col-xs-6" style="padding-left: 0px;">
						<input name="uname" type="text" class="form-control" placeholder="姓名" required <?php if(isset($_SESSION['uname'])){echo "value='".$_SESSION['uname']."'";}?>>
					</div>
					<div class="input-group form-group-lg col-xs-6 " style="padding-left: 0px;">
						<span class="input-group-addon">生日</span>
						<input name="ubd" type="date" class="form-control" placeholder="生日" required <?php if(isset($_SESSION['birthday'])){echo "value='".$_SESSION['birthday']."'";}?>>
					</div>
				</div>
				<div class="form-group form-group-lg col-md-12 row">
					<label class="radio-inline">
						<input type="radio" name="sex" id="male" value="1" <?php if(isset($_SESSION['sex'])){if(strcmp($_SESSION['sex'],"male")==0){echo "checked";}}?>> 男性
					</label>
					<label class="radio-inline">
						<input type="radio" name="sex" id="female" value="0" <?php if(isset($_SESSION['sex'])){if(strcmp($_SESSION['sex'],"female")==0){echo "checked";}}?>> 女性
					</label>
				</div>
				<div class="form-group form-group-lg col-md-12 row">
					<div class="g-recaptcha" data-sitekey="6Lc59AsTAAAAAEmotsE8ulTtZBRX--XdVS4hZYJR"></div>
				</div>
				<?php
					if (isset($_SESSION['uid'])) {
				?>
				<div class="form-group form-group-lg ">
					<input name="fbid" type="text" class="form-control" style="display:none" readonly="true" value="<?php echo $_SESSION['uid'];?>">
				</div>
				<?php } ?>

				<div class="form-group col-md-12 row">
					<div class="btn-group" role="group">
						<button type="submit" class="btn btn-primary btn-lg">建立帳號</button>
					</div>
				</div>
			</form>
		</div>
	</div><!--container-->

	<?php
			if (isset($_GET['e'])){
				if($_GET['e']<= 2){
		?>
			<!-- Modal -->
				<div class="modal fade" id="Error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h3 class="modal-title" id="">錯誤!</h3>
							</div>
							<div class="modal-body">
		<?php
				if (strcmp($_GET['e'],"1")== 0) {
					echo "<p>驗證機器人錯誤</p>";
				}
				if (strcmp($_GET['e'],"2")== 0) {
					echo "<p>請輸入完整資訊</p>";
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
</body>
</html>