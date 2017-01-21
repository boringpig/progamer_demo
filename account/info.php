<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(0);

	if(isset($_SESSION['uname'])){
		$tname = $_SESSION['uname'];
	}else{
		$tname = "關於我";
	}

	require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL

	//set var
	date_default_timezone_set('Asia/Taipei');
	$time = date("ymdHis");

	$mid = $_SESSION['uid'];
	$sql ="select m_name,m_sex,m_email,m_birthday from member where m_id = '$mid'";
	if(!$mysqli->query($sql)) {
		printf("Error: %s\n", $mysqli->error);
	} else {
		$result = $mysqli->query($sql);
	}
	$mysqli->close();
	for($i=0;$i<1;$i++){$row = mysqli_fetch_assoc($result);}
	$uname = $row['m_name'];
	$usex = $row['m_sex'];
	$uemail = $row['m_email'];
	$ubd = $row['m_birthday'];
?>
<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $tname; ?> &middot; PROGAMER</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
</head>
<body>
	<?php include_once(dirname(dirname(__FILE__))."/bar.php"); ?>

	<div class="container" style="margin:0 auto;">
		<div class="panel panel-primary">
			<div class="panel-heading">修改資料</div>
			<div class="panel-body">
				<div class="container" style="width:40%">
					<form role="form">
						<span class="label label-success">通過驗證</span>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Email</span>
								<input type="text" class="form-control" placeholder="電子信箱" disabled <?php if(isset($uemail)){echo "value='".$uemail."'";}?>>
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">姓名</span>
								<input type="text" class="form-control" placeholder="姓名" <?php if(isset($uname)){echo "value='".$uname."'";}?>>
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">性別</span>
								<select class="form-control">
									<option <?php if(strcmp($usex,"1")==0){echo "selected";}?> >男</option>
									<option <?php if(strcmp($usex,"0")==0){echo "selected";}?> >女</option>
									<?php if(strcmp($usex,"1")>=1){
										echo "<option if(strcmp($usex,\"1\")>=1){echo \"selected\";}?> >錯誤</option>";
									}
									?>
									
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">生日</span>
								<input name="ubd" type="date" class="form-control" placeholder="生日" required <?php if(isset($ubd)){echo "value='".$ubd."'";}?>>
							</div>
						</div>

						<div class="form-group has-success">
							<div class="input-group">
								<span class="input-group-addon">密碼</span>
								<input type="password" class="form-control" placeholder="密碼" required title="輸入密碼繼續...">
							</div>
						</div>
							<button type="submit" class="btn btn-success block-right">更新資料</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>