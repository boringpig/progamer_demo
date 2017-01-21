<?php
	require_once(dirname(dirname(__FILE__))."/checkauth.php");
	authaccess(2);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
</head>

<body>
	<?php
		require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL
		if (!isset($_GET[s])) {
			if(!$mysqli->query("select * from news ")) {
				printf("Error: %s\n", $mysqli->error);
			} else {
				$result = $mysqli->query("select * from news order by news_datetime desc");
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
			
			<table class="table table-bordered table-hover table-condensed" cellpadding="1px" >
				<thead>
					<tr class="text-center">
						<th scope="column" width="10%">類別</th>
						<th scope="column" width="55%">標題</th>
						<th scope="column" width="15%">日期</th>
						<th scope="column" width="10%">編輯</th>
						<th scope="column" width="10%">刪除</th>
					</tr>
				</thead>
				<tbody class="text-center">
					
						<?php for ($i=0;$i<$total_records;$i++) {$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引   ?>
						<tr>
							<td style="display:none"><?php echo $row[news_id];?></td>
							<?php

								switch ($row[news_type]) {
									case '1':
										$ntype="System";
										break;
									
									case '2':
										$ntype="Game";
										break;

									case '3':
										$ntype="Course";
										break;	
									default:
										$ntype="Other";
										break;	
								}
							?>
							<td><?php echo $ntype;?></td>
							<td><a href="/news/article.php?nid=<?php echo $row[news_id];?>" target="_blank"><?php echo $row[news_title];?></a></td>
							<td><?php echo date("Y-m-d",strtotime($row[news_datetime]));?></td>
							<td><?php echo "<a href='/news/news_editor.php?nid=$row[news_id]' class='btn btn-info' >編輯<a>"?></td>
							<td><?php echo "<a href='#' class='btn btn-danger'>刪除<a>"?></td>
						</tr>
						<?php
							}
						?>
				</tbody>
			</table>
		</div>
	<?php
		$mysqli->close();
		} else {
			$mysqli = new mysqli($servername,$user,$pwd,$dbname);
			/* check connection */
			if ($mysqli->connect_errno) {
			    printf("Connect failed: %s\n", $mysqli->connect_error);
			    exit();
			}
			$search = $_GET[s];
			if (!strcmp($search,"")==0){
				$q = "select * from news where news_content like '%$search%'";
				if(!$mysqli->query($q)) {
					printf("Error: %s\n", $mysqli->error);
					//echo "</br>";
					//printf($q);
				} else {
					$result = $mysqli->query($q);
					$total_fields=mysqli_num_fields($result); // 取得欄位數
					$total_records=mysqli_num_rows($result);  // 取得記錄數
				}

	?>
		<div class="container">
			<table class="table table-bordered table-hover table-condensed" cellpadding="1px" >
				<tr>
					<td class="text-center" colspan="5">
					<form role="form" class="form-inline">
						<div class="form-group ">
							<input name="s" class="form-control"  type="text" placeholder="Search..." autocomplete="off">
							<button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</form>
					</td>
				</tr>
				<tbody class="text-center">
					<tr class="text-center">
						<th width="10%">類別</th>
						<th width="55%">標題</th>
						<th width="15%">日期</th>
						<th width="10%">編輯</th>
						<th width="10%">刪除</th>
					</tr>
						<?php
						if ($total_records == 0){
						?>
							<tr>
								<td colspan="5">
									找不到任何東西
								</td>
							</tr>
						<?php
						} else {
						for ($i=0;$i<$total_records;$i++) {$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引   ?>
						<tr>
							<td style="display:none"><?php echo $row[news_id];?></td>
							<?php

								switch ($row[news_type]) {
									case '1':
										$ntype="System";
										break;
									
									case '2':
										$ntype="Game";
										break;

									case '3':
										$ntype="Course";
										break;	
									default:
										$ntype="Other";
										break;	
								}
							?>
							<td><?php echo $ntype;?></td>
							<td><?php echo $row[news_title];?></td>
							<td><?php echo date("Y-m-d",strtotime($row[news_datetime]));?></td>
							<td><?php echo "<a href='/news/news_editor.php?nid=$row[news_id]' class='btn btn-info' >編輯<a>"?></td>
							<td><?php echo "<a href='/#' class='btn btn-danger'>刪除<a>"?></td>
							<td style="display:none"><?php echo $row[news_content];?></td>
						</tr>
						<?php
					}
				}
						?>
				</tbody>
			</table>
		</div>
	<?php
	} else {
	?>
		<div class="container">
			<table class="table table-bordered table-hover table-condensed" cellpadding="1px" >
				<tr>
					<td class="text-center" colspan="5">
					<form role="form" class="form-inline">
						<div class="form-group ">
							<input name="s" class="form-control"  type="text" placeholder="Search...">
							<button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</form>
					</td>
				</tr>
				<tbody class="text-center">
					<tr class="text-center">
						<th width="10%">類別</th>
						<th width="55%">標題</th>
						<th width="15%">日期</th>
						<th width="10%">編輯</th>
						<th width="10%">刪除</th>
					</tr>
					<tr>
						<td colspan="5">
							找不到任何東西
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	<?php	
	}
			$mysqli->close();
		}
	?>

</body>
</html>