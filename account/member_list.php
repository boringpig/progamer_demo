<?php
	require_once(dirname(dirname(__FILE__))."/checkauth.php");
	authaccess(2);
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
	require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
	$sql = "select m.m_name,m.m_auth,m.m_fbuid,m.m_enable,
					m.m_id,m.m_verify, lr.state, lr.dt
					from member as m
					left join (select max(datetime) as dt,state,m_id from login_record group by m_id) as lr
					on m.m_id = lr.m_id ";
	if(!$mysqli->query($sql)) {
		printf("Error: %s\n", $mysqli->error);
		exit;
	} else {
		$result = $mysqli->query($sql);
		$total_records=mysqli_num_rows($result);  // 取得記錄數
	}
	  
?>
<!DOCTYPE html>
<html>
<head>
	<title>會員列表 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/customize.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
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
							$edit = "<a href=\"editm.php?m=$id\" class=\"btn btn-success\"><i class=\"fa fa-pencil-square-o fa-lg\"></i> 修改</a>";
						} else {
							if (strcmp($_SESSION['uid'],$row['m_id']) == 0) { //是不是自己的
								$edit = "<a href=\"editm.php?m=$id\" class=\"btn btn-success\"><i class=\"fa fa-pencil-square-o fa-lg\"></i> 修改</a>";
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
					$mysqli->close();
				?>
			</tbody>
		</table>
	</div>
</body>
</html>