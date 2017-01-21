<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(3);
	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>會員 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
	<link href="/css/simple-sidebar.css" rel="stylesheet">
	<script src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<?php include_once(dirname(dirname(__FILE__))."/bar.php"); ?>
	<!--Content-->
	<div class="container-fluid">
		<div id="wrapper">
			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand">
						<a href="#">
							會員管理
						</a>
					</li>
					<li>
						<a href="#overview" data-toggle="tab">會員總覽</a>
					</li>
					<li>
						<a href="#register" data-toggle="tab">註冊</a>
					</li>
					<li>
						<a href="#fogetpwd" data-toggle="tab">忘記密碼</a>
					</li>
					<li>
						<a href="#editinfo" data-toggle="tab">修改個人資訊</a>
					</li>
					<li>
						<a href="#membercenter" data-toggle="tab">會員中心</a>
					</li>
					<li>
						<a href="#record" data-toggle="tab">登入紀錄</a>
					</li>
					<li>
						<a href="#" data-toggle="tab">#其他(保留)</a>
					</li>
				</ul>
			</div>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
							<hr>
							<!-- Tab panes -->
							<div class="tab-content">
								<?php
								//Member Overview
								function randword($l)	{
									$word_len = $l;
									$rw = '';
									// remove o,0,1,l
									$word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQORSTUVWXYZ0123456789';
									$len = strlen($word);
									for ($i = 0; $i < $word_len; $i++) {
										$rw .= $word[rand() % $len];
									}
									return $rw;
								}
								$sql = "select m.m_name,m.m_auth,m.m_fbuid,m.m_enable,
												m.m_id,m.m_verify,m.m_regdatetime, lr.state, lr.dt
												from member as m
												left join (select max(datetime) as dt,state,m_id from login_record group by m_id) as lr
												on m.m_id = lr.m_id
												order by m.m_regdatetime";
								if(!$mysqli->query($sql)) {
									printf("Error: %s\n", $mysqli->error);
									exit;
								} else {
									$result = $mysqli->query($sql);
									$total_records=mysqli_num_rows($result);  // 取得記錄數
								}
								?>
								<div role="tabpanel" class="tab-pane active" id="overview">
									<h1 class="text-center"> 會員總覽 </h1>
									<div style="width:90%;margin:0 auto;">
										<table class="table">
											<thead>
												<th width="15%">狀態</th>
												<th width="20%">姓名</th>
												<th width="15%">權限</th>
												<th width="10%">Facebook</th>
												<th width="20%">最近一次登入</th>
												<th width="10%">修改資料</th>
												<th width="10%">停用會員</th>
											</thead>
											<tbody>
												<?php 
													for($i=0;$i<$total_records;$i++){
														$row = mysqli_fetch_assoc($result);

														$id = randword(3).$row['m_id'];
														/*會員狀態 設定
														** 0 --> 尚未驗證
														** 1 --> 以驗證
														*/
														switch ($row['m_verify']) {
															case '1':
																$state = "<span class=\"label label-success\">已驗證</span>";
																break;
															
															default:
																$state = "<span class=\"label label-danger\">尚未驗證</span>";
																break;
														}
														//姓名設定
														$name = $row['m_name'];
														//權限設定
														if ($row['m_auth']>$_SESSION['auth']) {
															$sysauth = $_SESSION['auth'];
														} else {
															$sysauth = $row['m_auth'];
														}
														switch ($sysauth) {
															case 1:
																$auth = "測試人員";
																break;
															case 2:
																$auth = "管理員";
																break;
															case 3:
																$auth = "系統管理員";
																break;
															case 4:
																$auth = "Super Adminstrator";
																break;
															default:
																$auth = "一般使用者";
																break;
														}

														 //Facebook 是否有連結
														if (strcmp($row['m_fbuid'],"none")==0) {
															$fb = "<i class=\"fa fa-unlock fa-2x\"></i>";
														} else {
															$fb = "<i class=\"fa fa-lock fa-2x\"></i>";
														}
														//修改會員
														if ($row['m_auth']<$_SESSION['auth']) { //如果自己的權限跟自己一樣或大於自己 則不能修改
															$edit = "<a href=\"editm.php?m=$id\" class=\"btn btn-info\"><i class=\"fa fa-pencil-square-o fa-lg\"></i> 修改</a>";
														} else {
															if (strcmp($_SESSION['uid'],$row['m_id']) == 0) { //是不是自己的
																$edit = "<a href=\"editm.php?m=$id\" class=\"btn btn-info\"><i class=\"fa fa-pencil-square-o fa-lg\"></i> 修改</a>";
															} else {
																$edit = "";
															}	
														}

														if ($row['m_auth']<$_SESSION['auth']) { //如果自己的權限跟自己一樣或大於自己 則不能停用
															$enable = $row['m_enable'];
															if ($enable) {
																//如果已經啟動了，則顯示關閉
																$unable = "<a href=\"enable.php?m=$id&e=0\" class=\"btn btn-danger\"><i class=\"fa fa-stop fa-lg\"></i> 停用</a>";
															}else{
																$unable = "<a href=\"enable.php?m=$id&e=1\" class=\"btn btn-success\"><i class=\"fa fa-play fa-lg\"></i> 啟動</a>";
															}
														} else {
															if (strcmp($_SESSION['uid'],$row['m_id']) == 0) { //是不是自己的
																if ($enable) {
																	//如果已經啟動了，則顯示關閉
																	$unable = "<a href=\"enable.php?m=$id&e=0\" class=\"btn btn-danger\"><i class=\"fa fa-stop fa-lg\"></i> 停用</a>";
																}else{
																	$unable = "<a href=\"enable.php?m=$id&e=1\" class=\"btn btn-success\"><i class=\"fa fa-play fa-lg\"></i> 啟動</a>";
																}
															} else {
																$unable = "";
															}
														}
														
														if (empty($row['dt']) ) {
															$time = "註冊後尚未登入";
														} else {
															$time = $row['dt'];
														}

												?>
												<tr>
													<td><?php echo $state; ?></td>
													<td><?php echo $name; ?></td>
													<td><?php echo $auth; ?></td>
													<td><?php echo $fb; ?></td>
													<td><?php echo $time; ?></td>
													<td><?php echo $edit; ?></td>
													<td><?php echo $unable; ?></td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
								</div><!--Overview End-->
								
								<div role="tabpanel" class="tab-pane" id="register">
									<h1 class="text-center"> 註冊頁面 </h1>
									<div style="width:90%;margin:0 auto;">
										<iframe src="<?php echo "/account/registration.php"?>" frameborder="0" width="90%" height="460px"></iframe>
									</div>
								</div><!--Register End-->
								<div role="tabpanel" class="tab-pane" id="fogetpwd">
									<h1 class="text-center"> 忘記密碼 </h1>
									<div style="width:70%;margin:0 auto;">
									</div>
								</div><!--Forget Password End-->
								<div role="tabpanel" class="tab-pane" id="editinfo">
									<h1 class="text-center"> 修改個人資訊 </h1>
									<div style="width:90%;margin:0 auto;">
										<iframe src="<?php echo "/account/info.php"?>" frameborder="0" width="90%" height="400px"></iframe>
									</div>
								</div><!--Edit personal infomation End-->
								<div role="tabpanel" class="tab-pane" id="membercenter">
									<h1 class="text-center"> 會員中心 </h1>
									<div style="width:70%;margin:0 auto;">
									</div>
								</div><!--Edit personal infomation End-->
								<?php
								//登入紀錄顯示
								$sql = "select lr.datetime,lr.m_id,m.m_name,lr.state,lr.reason from login_record as lr
												left join (select m_id,m_name from member) as m
												on lr.m_id = m.m_id
												order by lr.datetime desc";
								if(!$mysqli->query($sql)) {
									printf("Error: %s\n", $mysqli->error);
									exit;
								} else {
									$result = $mysqli->query($sql);
									$total_records=mysqli_num_rows($result);  // 取得記錄數
								}
								?>
								<div role="tabpanel" class="tab-pane" id="record">
									<h1 class="text-center"> 登入紀錄 </h1>
									<div style="width:70%;margin:0 auto;">
										<table class="table">
											<thead>
												<th width="15%">用戶</th>
												<th width="15%">時間</th>
												<th width="10%">登入狀態</th>
												<th width="20%">登入訊息</th>
											</thead>
											<tbody>
												<?php
													for($i=0;$i<30;$i++){
														$row = mysqli_fetch_assoc($result);
														$dt = $row['datetime'];
														$name = $row['m_name'];
														if ($row['state'] == 0) {
															$state = "<span class=\"label label-danger\">登入失敗</span>";
														} else {
															$state = "<span class=\"label label-success\">登入成功</span>";
														}
														$msg = $row['reason'];

												?>
												<tr>
													<td><?php echo $name;?></td>
													<td style="color:orange"><?php echo $dt;?></td>
													<td><?php echo $state;?></td>
													<td><?php echo $msg;?></td>
												</tr>
												<?php 
													}
													$mysqli->close(); 
												?>
											</tbody>
										</table>
									</div>
								</div><!--login records infomation End-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /#page-content-wrapper -->
		</div>
	</div>
	<script>
		$("#menu-toggle").click(function(e) {
				//e.preventDefault();
				$("#wrapper").toggleClass("toggled");
		});
	 </script>
</body>
</html>