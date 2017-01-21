<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(3);
	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>課程 &middot; PROGAMER</title>
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
							課程管理
						</a>
					</li>
					<li>
						<a href="#overview" data-toggle="tab">課程總覽</a>
					</li>
					<li>
						<a href="#addchat" data-toggle="tab">新增對話</a>
					</li>
					<li>
						<a href="#addcode" data-toggle="tab">新增練習題</a>
					</li>
					<li>
						<a href="#editchat" data-toggle="tab">修改對話</a>
					</li>
					<li>
						<a href="#editcode" data-toggle="tab">修改練習題</a>
					</li>
					<li>
						<a href="#cnews" data-toggle="tab">新增課程公告</a>
					</li>
					<li>
						<a href="/course/" target="blank" onclick="return confirm('您確定要前往「課程首頁」?');">前往課程首頁</a>
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
								<div role="tabpanel" class="tab-pane active" id="overview">
									<h1>Simple Sidebar</h1>
									<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
									<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
								</div><!--Overview End-->
								
								<div role="tabpanel" class="tab-pane" id="addchat">
									<h1 class="text-center"> 新增對話 </h1>
									<div style="width:70%;margin:0 auto;">
										<table class="table">
											<thead>
												<th style="width:20%"></th>
												<th style="width:80%"></th>
											</thead>
											<tbody>
												<form id="add_chat">
													<tr><!--章節-->
														<td class="text-right"><i class="fa fa-book"></i> 章節</td>
														<div class="form-group"><td><input type="text" class="form-control" name="chap"></td></div>
													</tr>
													<tr><!--關卡-->
														<td class="text-right"><i class="fa fa-bookmark"></i> 關卡</td>
														<div class="form-group"><td><input type="text" class="form-control" name="level"></td></div>
													</tr>
													<tr><!--題目-->
														<td class="text-right"><i class="fa fa-question"></i> 題目</td>
														<div class="form-group"><td><input type="text" class="form-control" name="question"></td></div>
													</tr>
													<tr><!--順序-->
														<td class="text-right"><i class="fa fa-sort-numeric-asc"></i> 次序</td>
														<div class="form-group"><td><input type="text" class="form-control" name="seq"></td></div>
													</tr>
													<tr><!--內容-->
														<td class="text-right"><i class="fa fa-pencil-square-o"></i> 對話內容</td>
														<div class="form-group"><td><textarea rows="6" class="form-control" name="content"></textarea></td></div>
													</tr>
													<tr><!--備註描述-->
														<td class="text-right"><i class="fa fa-sticky-note-o"></i> 備註描述</td>
														<div class="form-group"><td><input type="text" class="form-control" name="desc"></td></div>
													</tr>
													<tr>
														<td colspan="2" class="text-center"><input type="submit" class="btn btn-default" value="+ 新增"></td>
													</tr>
												</form>
											</tbody>
										</table>
									</div>
								</div>
								<script type="text/javascript">
										$('#add_chat').submit(function(){
											$.ajax({
												type:'POST',
												url:'asn.php',
												data:$('#add_chat').serialize(),
											success:function(){
												swal({title:"新增成功",closeOnConfirm:false,type:"success"});
											},
											error:function(){
												swal({title:"新增錯誤",closeOnConfirm:false,type:"error"});
											}
											});
											return false;
										});
								</script>
								<!--New Chat End-->

								<div role="tabpanel" class="tab-pane" id="addcode">
									<h1 class="text-center"> 新增練習題 </h1>
									<div style="width:70%;margin:0 auto;">
										<table class="table">
											<thead>
												<th style="width:20%"></th>
												<th style="width:80%"></th>
											</thead>
											<tbody>
												<form>
													<tr><!--章節-->
														<td class="text-right"><i class="fa fa-book"></i> 章節</td>
														<div class="form-group"><td><input type="text" class="form-control"></td></div>
													</tr>
													<tr><!--關卡-->
														<td class="text-right"><i class="fa fa-bookmark"></i> 關卡</td>
														<div class="form-group"><td><input type="text" class="form-control"></td></div>
													</tr>
													<tr><!--題目-->
														<td class="text-right"><i class="fa fa-question"></i> 題目</td>
														<div class="form-group"><td><input type="text" class="form-control"></td></div>
													</tr>
													<tr><!--內容-->
														<td class="text-right"><i class="fa fa-pencil-square-o"></i> Code內容</td>
														<div class="form-group"><td><input type="text" class="form-control"></td></div>
													</tr>
													<tr><!--備註描述-->
														<td class="text-right"><i class="fa fa-sticky-note-o"></i> 備註描述</td>
														<div class="form-group"><td><input type="text" class="form-control"></td></div>
													</tr>
													<tr>
														<td colspan="2" class="text-center"><input type="submit" class="btn btn-default" value=" + "></td>
													</tr>
												</form>
											</tbody>
										</table>
									</div>
								</div><!--New Code End-->

								<div role="tabpanel" class="tab-pane" id="editchat">
									<h1 class="text-center"> 修改對話 </h1>
									<div style="width:80%;margin:0 auto;">
										<table class="table" style="table-layout: fixed;width: 100%;">
											<thead>
												<th style="width:10%" class="text-center">章節</th>
												<th style="width:10%" class="text-center">關卡</th>
												<th style="width:10%" class="text-center">課程</th>
												<th style="width:10%" class="text-center">順序</th>
												<th style="width:10%" class="text-center">備註</th>
												<th style="width:40%" class="text-center">Html碼</th>
												<th style="width:10%" class="text-center">修改</th>
											</thead>
											<tbody>
												<?php
													$sql = "select * from course_left order by chapter,level,question,seq";
													if(!$mysqli->query($sql)) {
														printf("Error: %s\n", $mysqli->error);
														exit;
													} else {
														$result = $mysqli->query($sql);
														$total_records=mysqli_num_rows($result);  // 取得記錄數
													}
													for ($i=0;$i<$total_records;$i++) {
														$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
														$chap = $row['chapter'];
														$level = $row['level'];
														$q = $row['question'];
														$seq = $row['seq'];
														$htmlc = htmlspecialchars($row['content']);
														$des = $row['description'];
														$edit_btn = "<input type=\"button\" class=\"btn btn-default\" value=\"修改\">";
												?>
												<tr>
													<td class="text-center"><?php echo $chap?></td>
													<td class="text-center"><?php echo $level?></td>
													<td class="text-center"><?php echo $q?></td>
													<td class="text-center"><?php echo $seq?></td>
													<td><?php echo $des?></td>
													<td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $htmlc?></td>
													<td class="text-center"><?php echo $edit_btn?></td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
								</div><!--Edit Chat End-->

								<div role="tabpanel" class="tab-pane" id="editcode">
									<h1 class="text-center"> 修改練習題 </h1>
									<div style="width:80%;margin:0 auto;">
										<table class="table" style="table-layout: fixed;width: 100%;">
											<thead>
												<th style="width:10%" class="text-center">章節</th>
												<th style="width:10%" class="text-center">關卡</th>
												<th style="width:10%" class="text-center">課程</th>
												<th style="width:10%" class="text-center">備註</th>
												<th style="width:40%" class="text-center">Code</th>
												<th style="width:10%" class="text-center">答案</th>
												<th style="width:10%" class="text-center">修改</th>
											</thead>
											<tbody>
												<?php
													$sql = "select * from course_right order by chapter,level,question";
													if(!$mysqli->query($sql)) {
														printf("Error: %s\n", $mysqli->error);
														exit;
													} else {
														$result = $mysqli->query($sql);
														$total_records=mysqli_num_rows($result);  // 取得記錄數
													}
													for ($i=0;$i<$total_records;$i++) {
														$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
														$chap = $row['chapter'];
														$level = $row['level'];
														$q = $row['question'];
														$ans = htmlspecialchars($row['ans']);
														$code = htmlspecialchars($row['code']);
														$des = $row['description'];
														$edit_btn = "<input type=\"button\" class=\"btn btn-default\" value=\"修改\">";
												?>
												<tr>
													<td class="text-center"><?php echo $chap?></td>
													<td class="text-center"><?php echo $level?></td>
													<td class="text-center"><?php echo $q?></td>
													<td><?php echo $des?></td>
													<td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $code?></td>
													<td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?php echo $ans?></td>
													<td class="text-center"><?php echo $edit_btn?></td>
												</tr>
												<?php
													}
													$mysqli->close();
												?>
											</tbody>
										</table>
									</div>
								</div><!--Edit Code End-->

								<div role="tabpanel" class="tab-pane" id="cnews">
									<h1 class="text-center"> 新增公告 </h1>
									<div style="width:70%;margin:0 auto;">
										<table class="table">
											<thead>
												<th style="width:20%"></th>
												<th style="width:80%"></th>
											</thead>
											<tbody>
												<form>
													<?php
														date_default_timezone_set('Asia/Taipei');
														$nid = date("ymdHis");
													?>
													<tr><!--公告號碼-->
														<td class="text-right"><i class="fa fa-book"></i> 公告號碼</td>
														<div class="form-group"><td><input type="text" class="form-control" readonly name="chap" value="<?php echo $nid?>"></td></div>
													</tr>
													<tr><!--關卡-->
														<td class="text-right"><i class="fa fa-bookmark"></i> 標題</td>
														<div class="form-group"><td><input type="text" class="form-control" name="level"></td></div>
													</tr>
													<tr><!--內容-->
														<td class="text-right"><i class="fa fa-pencil-square-o"></i> 內容</td>
														<div class="form-group"><td><textarea class="form-control" name="ct_post" rows="8" cols="50" placeholder="Enter content" required></textarea></div>
														<script>CKEDITOR.replace( 'ct_post' );	</script>
													</tr>
													<tr>
														<td colspan="2" class="text-center"><input type="submit" class="btn btn-default" value="+ 新增"></td>
													</tr>
												</form>
											</tbody>
										</table>
									</div>
								</div><!--Add Course News End-->
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