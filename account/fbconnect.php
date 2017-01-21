<?php
	session_start();
	require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
	
	$email = $_SESSION['email'];
	$sql = "select m_name from member where m_email = '$email'";
	if(!$mysqli->query($sql)) {
		printf("Error: %s\n", $mysqli->error);
	} else {
		$result = $mysqli->query($sql);
		for($i=0;$i<1;$i++){
			mysqli_data_seek($result,$i);
			list($name) = mysqli_fetch_row($result);
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Facebook 連結 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Devin">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
	<style type="text/css">
		body {
			padding-top: 40px;
			background-color: #eee;
		}
	</style>

	<script src='https://www.google.com/recaptcha/api.js?hl=zh-TW'></script> <!--reCAPTCHA-->
</head>
<body>
	<div class="container">
		<div class="text-center">
			<div class="jumbotron">
				<div class="container">
					<h1>Hi! <?php echo $name;?></h1>
					<p>連結Facebook到您的帳戶</p>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form">
						<input name="y" type="hidden">
						<p><button type="submit" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Facebook</button> </p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
		if (isset($_POST['y'])){
			$uid = $_SESSION['uid'];
			$mail = $_SESSION['email'];
			$sql = "update member set m_fbuid = '$uid' where m_email = '$mail' ";
			if(!$mysqli->query($sql)) {
				printf("Error: %s\n", $mysqli->error);
			} else {
				header("Location:/progamer/account/?e=6");
				$mysqli->close();
				exit();
			}
		}
		$mysqli->close();
	?>
</body>
</html>