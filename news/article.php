<?php
	session_start(); 
	require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
	if (isset($_GET[nid])){
		$id=mysqli_real_escape_string($mysqli,$_GET[nid]);
		$sql = "select news_id,news_title,news_content,news_datetime from news where news_id = '$id'";
		if(!$mysqli->query($sql)) {
			printf("Error: %s\n", $mysqli->error);
		} else {
			$result = $mysqli->query($sql);
			$total_records=mysqli_num_rows($result);  // 取得記錄數
			for ($i=0;$i<$total_records;$i++) {$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
			}
		}
		$mysqli->close();
	} else {
		header("Location:/");
	}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title><?php echo "$row[news_title]";?> │PROGAMER NEWS</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
</head>
<body>
	<?php require(dirname(dirname(__FILE__))."/bar.php"); 
		$title = $row['news_title'];
	?>
	<div class="container" style="background-color:#f5f5f5;margin:0 auto;width:1140px">
		<!--breadcrumb-->
		<ol class="breadcrumb">
			<li><a href="/">首頁</a></li>
			<li><a href="/news/">最新消息</a></li>
			<li class="active"><?php echo htmlspecialchars($row['news_title']);?></li>
		</ol>
		
		<!--沒有文章-->
		<?php if ($total_records == 0){	?>
		<div class="text-center">
			<h2>無此文章</h2>
		</div>
		<?php } else { ?>
		<!--文章本體-->
		<div style="background-color:#f5f5f5">
			<p class="text-nowrap">
				<h3><?php echo htmlspecialchars($row[news_title]);?>
				<?php 
					if (isset($_SESSION["auth"])){
						if($_SESSION["auth"]>2){
				
				echo "<a class=\"btn btn-sm btn-success\" href=\"news_editor.php?nid=$_GET[nid] \">編輯</a> ";
				echo "<a class=\"btn btn-sm btn-danger\" href=\"news_del.php?id=$_GET[nid]\" onClick=\"return confirm('確定要刪除這篇文章嗎？');\">刪除</a>";
						}
					}
				?>
				</h3>
			</p>
				<h5>│最新發布時間 &nbsp;&nbsp;<?php echo date("Y/m/d  h:i",strtotime($row[news_datetime]));?></h5>
			</br>
			<blockquote>
				<?php echo "$row[news_content]";?>
			</blockquote>
		</div>
		<?php } ?>
	</div>

	<?php include_once(dirname(dirname(__FILE__))."/footer.html"); ?>
</body>
</html>