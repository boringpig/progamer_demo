<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(3);

	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");
	if (isset($_GET[nid])) { //判斷有沒有設定文章編號
		$id=mysqli_real_escape_string($mysqli,$_GET[nid]);
		$sql = "select news_id,news_title,news_content,news_type from news where news_id = '$id'";
		if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
		} else {
			$result = $mysqli->query($sql);
			$total_records=mysqli_num_rows($result);  // 取得記錄數
			for ($i=0;$i<$total_records;$i++) {$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
			}

			if ($total_records==0) {
				$error = "找不到這篇文章";
			} else {
				$_SESSION['newsid'] = $row[news_id];
			}
		}
		$mysqli->close();
	} else {
		header("Location:/news/");
	}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>PROGAMER ::公告編輯器</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
	<script src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<?php require(dirname(dirname(__FILE__))."/bar.php"); ?>
	<div class="container" style="width:740px;margin:0 auto;">
		<div class="row text-center" style="font-size:15px"><h3>公告編輯器</h3></div>
		<div class="row">
			<?php
				if ($total_records==0) {
					echo $error;
				} else {
			?>
			<form action="edit_handler.php" method="post" role="form">
				<input class="btn btn-danger pull-right" type="submit" value="確認修改">
				<table class="table table-hover table-condensed">
					<thead>
						<tr align='center'>
							<th width="20%"></th>
							<th width="80%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-right">公告編號 | </td>
							<td>
								<div class="form-group">
									<input name="newsid" class="form-control" type="text" readonly value="<?php echo $row[news_id];?>">
								</div>
							</td>
						</tr>
						<tr>
							<td class="text-right">類別 | </td>
							<td>
								<div class="form-group">
									<select name="type" class="form-control">
										<option value="1" <?php if($row[news_type]==1){echo "selected";}?>>系統</option>
										<option value="2" <?php if($row[news_type]==2){echo "selected";}?>>遊戲</option>
										<option value="3" <?php if($row[news_type]==3){echo "selected";}?>>課程</option>
										<option value="4" <?php if($row[news_type]==4){echo "selected";}?>>其他</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="text-right">標題 | </td>
							<td>
								<div class="form-group">
									<input autocomplete="off" class="form-control" name="ntitle" type="text" placeholder="Title" autofocus="autofocus" title="限50字內" maxlength="50" required value="<?php echo $row[news_title];?>">
								</div>
							</td>
						</tr>
						<tr>
							<td class="text-right">內容 | </td>
							<td>
								<div class="form-group has-feedback">
									<textarea class="form-control" name="nct" rows="8" cols="50" placeholder="Enter content" required><?php echo "$row[news_content]";?></textarea>
								</div>
								<script>
									CKEDITOR.replace( 'nct' );
								</script>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php } //假如沒有文章?>
		</div><!--row table-->
	</div><!--container-->
</body>
</html>