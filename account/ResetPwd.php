<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(0);

?>
<!DOCTYPE html>
<html>
<head>
	<title>忘記密碼 &middot; PROGAMER</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">

	<script type="text/javascript" src="/js/customize.js"></script>
	
</head>
<body>
	<?php include_once(dirname(dirname(__FILE__))."/bar.php"); ?>

	<div class="container" style="margin:0 auto;">
		<div class="panel panel-success">
			<div class="panel-heading">忘記密碼 Forgot Password</div>
			<div class="panel-body">
				<div class="container">
					<div class="row text-center">
						<h3>我們將會寄送Email到您的信箱，請您重新設定一組新的密碼。</h3>
					</div>
					<div class="row text-center">
						<form action="/email.php" method="POST">
							<input type="submit" class="btn btn-lg btn-primary" value="重設密碼">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>