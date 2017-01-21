<?php
	require_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(2);
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
	<title>公告管理 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
	<script src="/ckeditor/ckeditor.js"></script>

</head>
<body>
	<?php include_once(dirname(dirname(__FILE__))."/bar.php"); ?>
	<!--Content-->

	<div class="container">
		<ul class="nav nav-pills nav-tabs nav-justified" id="myTab">
			<li class="active" role="navigation"><a href="#post" data-toggle="tab">最新公告</a></li>
			<li role="navigation"><a href="#new_post" data-toggle="tab">張貼公告</a></li>
			<li role="navigation"><a href="#mgpost" data-toggle="tab">公告管理</a></li>
			<li role="navigation"><a href="#panel3" data-toggle="tab">公告設定</a></li>
		</ul>
	</div>
	<div class="container" >
		<div class="container" style="background-color:#BEBEBE;">
		<div class="tab-content text-center" data-spy="scroll">
			
			<!--Lastest Post-->
			<div class="tab-pane active" id="post" style="height:auto">
				<a href="/news/" target="_blank"><h3>前往分頁</h3></a>
				<iframe src="<?php echo "/news/"?>" frameborder="0" width="90%" height="460px"></iframe>
			</div>

			<!--POST-->
			<div class="tab-pane" id="new_post" style="width:80%;margin:0 auto;height:">
				</br>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form">
						<table class="table table-bordered table-hover table-condensed">
							<tbody>
								<tr>
									<td><h4>公告編號</h4></td>
									<td>					
										<?php
											date_default_timezone_set('Asia/Taipei');
											$nid = date("ymdHis");
											echo "<input name='newsid' class='form-control' type='text' readonly value=$nid>";
										?>
									</td>
								</tr>
								<tr>
									<td><h4>類型</h4></td>
									<td><div>
											<select name="type" class="form-control">
												  <option value="1">系統</option>
												  <option value="2">遊戲</option>
												  <option value="3">課程</option>
												  <option value="4">其他</option>
											 </select>
										</div>
									</td>
								</tr>
								<tr>
									<td><h4>標題</h4></td>
									<td><div class="form-group">
										<input autocomplete="off" class="form-control" name="ntitle" type="text" placeholder="Title" autofocus="autofocus" title="限50字內" maxlength="50" required>
										</div>
									</td>
								</tr>
								<tr>
									<td><h4>內容</h4></td>
									<td>
										<div class="form-group has-feedback">
										<textarea class="form-control" name="ct" rows="8" cols="50" placeholder="Enter content" required></textarea>
										</div>
										<script>
											CKEDITOR.replace( 'ct' );
										</script>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input class="btn" type="reset" value="Clear">
										<input class="btn btn-primary " type="submit" value="POST">
									</td>
								</tr>
							</tbody>
						</table>	
					</form>
			</div>
			<?php
				include(dirname(dirname(__FILE__))."/config/sql_config.php");
				if (isset($_POST[newsid])) {
					$dt =date("ymdHis");
					$sql = "insert into news(news_id,news_title,news_content,news_type,news_datetime) values ('$_POST[newsid]','$_POST[ntitle]','$_POST[ct]',$_POST[type],'$dt')";
					if(!$mysqli->query($sql)) {
						printf("Error: %s\n", $mysqli->error);
					}
					$mysqli->close();
			?>
			<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h3 class="modal-title" id="">Success!</h3>
						</div>
						<div class="modal-body">
							<p>新增成功</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<script>$('#success').modal('show')</script>
			<?php
				}
			?>
			
			<!--Manage-->
			<div class="tab-pane" id="mgpost" style="height:440px">
				<div style="text-align:center;"><strong><h2 style="fonts-color:white"><a href="/news/nlist.php" target="_blank"><i class="icon-pencil"></i>公告管理</a></h2></strong></div>
				<iframe src="<?php echo "/news/nlist.php"?>" frameborder="0" width="90%" height="87%"></iframe>
			</div>

			<div class="tab-pane" id="panel3">
				<p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
			</div>
		</div>
		</div>
	</div>
	
</html>