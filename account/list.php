<?php
	require_once(dirname(dirname(__FILE__))."/checkauth.php");
	authaccess(2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>會員列表 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/customize.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
</head>

<body>
	<?php
		require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
		if (!isset($_GET[s])) {
			$sql = "select * from member order by m_regdatetime desc";
			if(!$mysqli->query($sql)) {
				printf("Error: %s\n", $mysqli->error);
			} else {
				$result = $mysqli->query($sql);
				$total_fields=mysqli_num_fields($result); // 取得欄位數
				$total_records=mysqli_num_rows($result);  // 取得記錄數
			}
	?>
		<div class="container">
			<div class="text-center">
				<form role="form" class="form-inline">
					<div class="form-group ">
						<input name="s" class="form-control"  type="text" placeholder="Search..." autocomplete="off">
						<button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</form>
			</div>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php for ($i=0;$i<$total_records;$i++) {
					$row = mysqli_fetch_assoc($result);
				?>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $i ?>" aria-expanded="true" aria-controls="<?php echo $i ?>">
								<?php echo $row[m_name]; ?>  &middot; <?php echo $row[m_email]; ?>
							</a>
						</h4>
					</div>
					<div id="<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<form role="form">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">註冊日期</span>
										<input type="datetime" class="form-control"  readonly="true" <?php echo "value='".$row[m_regdatetime]."'"; ?>>
									</div>
								</div>

								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">姓名</span>
										<input type="text" class="form-control" placeholder="姓名" value="<?php echo $row[m_name]; ?>" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">權限</span>
										<input type="text" class="form-control" placeholder="權限" value="<?php echo $row[m_auth]; ?>"  required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">生日</span>
										<input name="ubd" type="date" class="form-control" placeholder="生日" required <?php echo "value='".$row[m_birthday]."'"; ?>>
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
										<span class="input-group-addon">Facebook連結</span>
										<input  type="text" class="form-control" placeholder="fb連結" readonly value="<?php if(strcmp($row[m_fbuid],"none")==0){echo "尚未連結";}else{echo "已連結";}?>">
									</div>
								</div>
								<?php if($row[m_auth] < $_SESSION['auth']){?>
								<div class="form-group">
									<a href="edit.php?uid=<?php echo $row[m_id]; ?>" class="btn btn-primary"><span class="fa fa-pencil fa-fw"></span> 更新<a>
									<a href="del.php?uid=<?php echo $row[m_id]; ?>" class="btn btn-danger" onClick="return confirm('確定要刪除這個會員嗎？');"><span class="fa fa-trash-o fa-lg"></span> 刪除會員<a>
								</div>
								<?php }?>
							</form>
						</div>
					</div>
				</div>
				<?php
					}
				?>
				</div>
		</div>
	<?php
		$mysqli->close();
	}
	?>
</body>
</html>