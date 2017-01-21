<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(0);
	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
	$sql ="select news_id,news_title,news_datetime from news where news_type = '3' order by news_datetime desc";
	if(!$mysqli->query($sql)) {
		printf("Error: %s\n", $mysqli->error);
	} else {
		$result = $mysqli->query($sql);
		$total_records=mysqli_num_rows($result);  // 取得記錄數
	}
	if ($total_records>5) {
		$total_records=5;
	}
	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>課程 Course &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">

	<link rel="stylesheet" type="text/css" href="/css/customize.css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<style type="text/css">
		.datetd{
			width:100px;
		}
	</style>
</head>
<body>
	<?php include_once(dirname(dirname(__FILE__))."/bar.php"); ?>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<img class="img-responsive" style="" src="/img/Java_logo.png" alt="">
					<div class="intro-text">
						<h1 class="name"><i class="fa fa-code"></i> Java 課程</h1>
						<hr class="star-light">
						<div class="skills">
							<p>誠摯地邀請您在 2015年11月28日 與PROGAMER見面</p>
							<p><strong>11/28日 正式上線測試</strong></p>
							<p><a href="learn.php" class="btn btn-default btn-lg">開始上課</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<!--第一段-->
		<div class="row" >
			<div class="container" style="height:90vh;">
				<div class="row" style="position: relative;top:50%;transform:translateY(-50%);">
					<div class="col-md-6">
						<div class="thumbnail">
							<div class="caption text-center">
								課程消息
							</div>
								<table class="table table-responsive">
									<tbody>
										<?php
											for ($i=0;$i<$total_records;$i++) {
												$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
												$time = strtotime($row['news_datetime']);
												$time = date("Y-m-d",$time);
												$title = htmlspecialchars($row['news_title']);
										?>
										<tr>
											<td style="width:20%"><span style="color:orange"> <?php echo $time; ?><span></td>
											<td style="width:80%"><a href="/news/article.php?nid=<?php echo $row['news_id'];?>" style="color:black" alt="前往" target="blank"><?php echo $title; ?></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
						</div>
					</div>
					<div class="col-md-6">
						<div class="thumbnail">
							<div class="caption text-center">
								新手教學
							</div>
							<div>
								<div class="embed-responsive embed-responsive-4by3">
									<iframe class="embed-responsive-item" width="560" height="150" src="https://www.youtube.com/embed/0oqDD87Hn1g" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row"></div>
			</div>
		</div>
		<!--第二段-->
		<div class="row" style="background-image:url(/img/c_bg.jpg);background-size:contain">
			<div class="container" style="height:90vh;color:white;" >
				<div class="col-md-9" style="position: relative;top:50%;transform:translateY(-50%);">
					<div class="row">
						<span style="font-size:50px"><strong>一段奇妙的故事</strong></span>
						<h3>-<strong>關於王子與公主之間的愛情</strong>-</h3>
					</div>
				</div>
				<div class="col-md-3" style="position: relative;top:50%;transform:translateY(-50%);">
					<img class="img-responsive" src="/img/prince_white.png">
				</div>
			</div>
		</div>
	</div>
	<?php include_once(dirname(dirname(__FILE__))."/footer.html"); ?>
</body>
</html>