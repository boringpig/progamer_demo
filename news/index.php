<?php
	session_start();
	require_once(dirname(dirname(__FILE__))."/config/sql_config.php");	//connect SQL

	 // 判斷Page傳來指定的頁數，以決定本頁顯示的資料
    if (isset($_GET['page']))
        $page = $_GET['page'];
    
    if (!isset($page)) 
        $page = 1;

    // 判斷pern傳來的值，以決定顯示的資料筆數
    
    $perNum = 6;  // 每頁顯示 5 筆（每次取5筆資料）


	if(!$mysqli->query("select * from news ")) {
		printf("Error: %s\n", $mysqli->error);
	} else {
		$result = $mysqli->query("select * from news");
		list($totalNum) = mysqli_fetch_row($result);
		$totalNum = mysqli_num_rows($result);
	}

  
    //開始起始指標
    $startId = ($page - 1)* $perNum;
  
    //該頁實際顯示資料筆數目
    if(($startId+$perNum)>$totalNum) {
        $realPerNum = $totalNum - $startId;
    }else{
        $realPerNum = $perNum;
    }
  	
  	//若資料庫中無任何資料
	if($totalNum == 0){
		$hideerror = '<tr><td class="text-center">沒有資料</td></tr>'; 
	}
    //總頁數
    if($totalNum % $perNum == 0){
        $totalPage = $totalNum / $perNum;
    }else{
        $totalPage = intval($totalNum / $perNum)+1;
    }
  
    //第一頁
    $firstPage=1;
  	//下一頁
  	$nextpage = $page + 1;
  	//上一頁
  	$backpage = $page - 1;
    //最後一頁
    $lastPage = $totalPage;  
  
    
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>最新 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
</head>
<body>
	<?php require(dirname(dirname(__FILE__))."/bar.php"); ?>
	<div class="container" style="background-color:#f5f5f5;margin:0 auto;width:1140px">
		<!--breadcrumb-->
		<ol class="breadcrumb">
			<li><a href="/">首頁</a></li>
			<li class="active">最新消息</li>
		</ol>

		<div class="text-center">
			<h3>最新</h3>
		</div>
		
		<div style=";margin:0 auto;width:740px">
			<table class="table table-hover table-condensed">
				<thead>
					<tr align='center'>
						<th width="15%"></th>
						<th width="65%"></th>
						<th width="20%"></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$result = $mysqli->query("select news_id,news_title,news_datetime,news_type from news order by news_datetime desc limit $startId,$perNum");
						echo $hideerror;
						date_default_timezone_set('Asia/Taipei');
						for($i=$startId;$i<$startId+$realPerNum;$i++){
							mysqli_data_seek($result,$i);
							list($news_id ,$news_title ,$news_datetime,$news_type) = mysqli_fetch_row($result);
							switch ($news_type) {
								case '1':
									$type="系統";
									break;
								case '2':
									$type="遊戲";
									break;
								case '3':
									$type="課程";
									break;	
								default:
									$type="其他";
									break;	
							}
							$length = 15; //顯示字串的長度
							if (mb_strlen($news_title,"utf-8")>=$length) {
								
								$len=mb_strlen($news_title,"utf-8");
								$tlen = -($len-$length);
								$title = mb_substr($news_title,0,$tlen,"utf-8")."...";
							} else {
								$title = $news_title;
							}
					?>
					<tr>
						<?php echo $hideerror;?>
						<td class="text-right"><h4><span class="label label-success"><?php echo $type;?></span></h4></td>
						<td><a href="article.php?nid=<?php echo $news_id; ?>"><h4><?php echo $title;?></h4></a></td>
						<td><h4><?php echo date("Y-m-d",strtotime($news_datetime)); ?></h4></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="text-center">
			<form>
				<nav>
					<ul class="pagination">
						<?php
					 		if($page == $firstPage){
					 			echo "<li class=\"disabled\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
					 		}else{
					 			echo "<li><a href=\"?page=$backpage\"><span aria-hidden=\"true\">&laquo;</span><span class=\"sr-only\">Previous</span></a></li>";
					 		}
					 	
						
							//echo "$totalNum";
							for ($i=1; $i <= $totalPage; $i++) { 
								if ($i == $page){
									echo "<li class=\"active\"><a href=\"?page=$page\">$i</a></li>";
								} else {
									echo "<li><a href=\"?page=$i\">$i</a></li>";
								}
							}
						
							if ($page == $lastPage){
								echo "<li class=\"disabled\"><span aria-hidden=\"true\">&raquo;</span></li>";
							} else {
								echo "<li><a href=\"?page=$nextpage\"><span aria-hidden=\"true\">&raquo;</span><span class=\"sr-only\">Next</span></a></li>";
							}
						?>
					</ul>
				</nav>
	        </form>
		</div>
		
	</div>
</body>

</html>
