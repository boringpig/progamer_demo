<?php
	include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
	authaccess(0);
	include_once(dirname(dirname(__FILE__))."/config/sql_config.php");

	$id = $_SESSION['uid'];

	$sql = "select m_course from member where m_id = '$id' "; //目前的答題
	if(!$mysqli->query($sql)) {
		printf("Error: %s\n", $mysqli->error);
		exit;
	} else {
		$result = $mysqli->query($sql);
	}
	for($i=0;$i<1;$i++){
			$rows = mysqli_fetch_assoc($result);
		}
		//分割字串 關卡題目
	$str = $rows['m_course'];
	$row = explode(",",$str);
	$chap = $row[0];     
	$level = $row[1];    
	$question = $row[2];
	//回傳至 SESSION
	$_SESSION['uid'] = $id;
	$_SESSION['chap'] = $chap;
	$_SESSION['level'] = $level;
	$_SESSION['question'] = $question;
	//左邊題目和對話
	$chat_sql = "select seq,content from course_left where level = '$level' and question = '$question' and chapter = '$chap' order by seq asc"; 
		//右邊程式題數用於progressbar的個數
	$codenum_sql = "select id,description from course_right where chapter = '$chap' AND level = '$level' ";
	$chat = $mysqli->query($chat_sql);
	$codenum = $mysqli->query($codenum_sql);
	$total_num = mysqli_num_rows($chat);  // 取得記錄數
	$total_question = mysqli_num_rows($codenum);  //取得第一章題數


?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>Java 認識變數 &middot; 專業遊戲人</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.css"> 
	<link rel="stylesheet" type="text/css" href="/css/course.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<script type="text/javascript" src="http://coffeedeveloper.github.io/typing.js/javascripts/typing.js"></script>
	<script type="text/javascript">
		function hint(x){
			x++;
			par = "#" + x ;
			$(par).css('display','block');
		}
		function chat(x,y){	//Y 控制是否要開啟右邊Code區域
			par = "#" + x ;
			$(par).remove();
			if (y == 1) {
				$('#disable').css('display','none');
				$('#code_style').css('display','block');
			}
			x++;
			par = "#" + x ;
			$(par).css('display','block');
			par1 = "source" + x;
			par2 = "output" + x;
			var typing = new Typing({
			source: document.getElementById(par1),
			output: document.getElementById(par2),
			delay: 40
			 });
			typing.start();
			$(par1).remove();
		}
	</script>
</head>
<body>
	<?php include_once(dirname(dirname(__FILE__))."/bar.php"); ?>
	<div class="container-fluid" style="background-image:url('/img/course_bg.jpg');background-repeat:no-repeat;background-size:100% 100%;">
		<!--Chat Area Left-->
		<div class="row" style="height:80vh;">
			<div id="question" class="col-xs-12 col-md-7" style="height:100%;overflow:auto;">
			<?php
				for($i=0;$i<$total_num;$i++){
					$row = mysqli_fetch_assoc($chat);
					if ($row['seq']==1) {
						$display = "display:block";
					} else {
						$display = "display:none";
					}
			?>
					<div id="<?php echo $row['seq']; ?>" style="padding:20px;<?php echo $display ; ?>;margin-top:50px;" class="animated fadeIn boxs">
						<?php if($i <> $total_num-1){ ?>
						<div id="source<?php echo $row['seq']; ?>" style="display:none">
						<?php echo $row['content']; ?>
						</div>
						<div id="output<?php echo $row['seq']; ?>"></div>
						<?php }else{
							echo  $row['content'];
						} ?>
					</div>
				
	
					<script type="text/javascript">
					<?php if ($row['seq']==1) { ?>
							var typing = new Typing({
							source: document.getElementById('source1'),
							output: document.getElementById('output1'),
							delay: 40
							 });
							typing.start();
					<?php } ?>
					</script>

			<?php }//for End?> 
			</div><!--Left-->

			<!--Code Area Right-->
			<?php
				$sql = "select code,id from course_right where chapter = '$chap' and level = '$level' and question = '$question' order by id asc";
				if(!$mysqli->query($sql)) {
					printf("Error: %s\n", $mysqli->error);
				} else {
					$result = $mysqli->query($sql);
					$total_num=mysqli_num_rows($result);  // 取得記錄數
				}
				for($i=0;$i<$total_num;$i++){
					$row = mysqli_fetch_assoc($result);}
			?>
			<div class="col-xs-6 col-md-5" style="height:100%;">
				<img id="disable" class="img-responsive"  alt="Disable" src="/img/disable.png" style="display:block">
				<div id="code_style" class="code" style="display:none;height:425px;">
					<form id="code" autocomplete="off">
						<?php 
							echo $row['code']; 
							$mysqli->close();
						?>
					</form>
					<div class="text-right" style="margin-top:120px;">
						<input type='button' id="submit" class='btn btn-success animated fadeIn' value="提交">
					</div>
					
				</div>	
			</div><!--Right-->
		</div>

				<!--Progress Bar-->
		<div class="row" style="height:12.4vh">
			<div class="levelprogress">
				<?php 
							for($i=0;$i<$total_question;$i++){
						$coderow = mysqli_fetch_assoc($codenum);
				?>
				<div id="C<?php echo $i; ?>" class="circle">
					<span class="title"><?php echo $coderow['description']; ?></span>
				</div>
				<? } ?>
						</div>
		</div>
		<div id="hidden"></div>
	</div>
	<!--以下function要寫註解-->
	<script type="text/javascript">
	$(function() {
		$('#submit').on('click',function(){ 
				$.ajax({
					type: 'POST',
					url: 'check_ans.php',
					data: $('#code').serialize(),
				success: function(data){
					$('#hidden').html(data);
					 }
				});
				return false;
		});
	});

	$(function(){
		<?php 
			 $num = (int)$question-1;
		?>
		for(i=0;<?php echo "i<".$num; ?>;i++){
			str = "#C"+i;
			$(str).addClass('done1');
		}
	});
	</script> 

</body>
</html> 