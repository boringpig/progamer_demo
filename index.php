<?php 
	include_once("checkauth.php"); 
		echo authaccess(0);
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<title>專業遊戲人 &middot; PROGAMER</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="description" content="progamerfree">
	<meta name="keywords" content="free tutorials,free java,yuntech,progamer">
	<meta name="author" content="Yuntech_PROGAMER_TEAM">
	<script type="text/javascript" src="http://s3.amazonaws.com/codecademy-content/courses/hour-of-code/js/alphabet.js"></script>
	<style>
		#toTop{
			position: fixed;
			bottom: 10px;
			right: 10px;
			cursor: pointer;
			display: none;
		}
	</style>
</head>
<body>
	<?php require("bar.php"); ?>
	<style type="text/css">
		.boxs{
			box-shadow:0px 5px 26px 0px #ADADAD;
		}
	</style>
	<div style="background-color:#eee;"><div class="container" style="margin:0 auto;">
		<div id="Slide" class="carousel slide center-block" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#Slide" data-slide-to="0" class="active"></li>
				<li data-target="#Slide" data-slide-to="1"></li>
				<li data-target="#Slide" data-slide-to="2"></li>
			</ol>

			<!-- Carousel items -->
			<div class="carousel-inner clearfix" role="listbox" >
				<div class="active item">
					<canvas id="myCanvas"></canvas>
					<script type="text/javascript" src="http://s3.amazonaws.com/codecademy-content/courses/hour-of-code/js/bubbles.js"></script>
					<script type="text/javascript" src="js/main.js"></script>
					
					<div class="container">
						<div class="carousel-caption">
							<!--標題-->
						</div>
					</div>
				</div>
				<div class="item">
					<a href="#">
						<img src="img/cover_1.png" alt="Happy" />
					</a>
					<div class="container">
						<div class="carousel-caption">
							<!--標題-->
						</div>
					</div>
				</div>
				<div class="item">
					<a href="https://www.facebook.com/progamer.tw/" target="blank">
						<img src="img/cover_2.png" alt="PROGRAMER" />
					</a>
					<div class="container">
						<div class="carousel-caption">
							<!--標題-->
						</div>
					</div>
				</div>
			</div>
		</div><!--Slide End-->
	</div></div><!--container End-->

	<div class="container-fluid" style="background-color:#eee;">
		<div class="row text-center boxs" style="height:91px;font-size:24px;background-color:#ddd">
			<a href="#"><div class="col-sm-3 col-md-2" style="padding-top:20px">
				<div class="row">
					<span class="glyphicon glyphicon-tower" aria-hidden="true"></span>
				</div>
				活動
			</div></a>
			<a href="/news/"><div class="col-sm-3 col-md-2" style="padding-top:20px">
				<div class="row">
					<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
				</div>
				消息
			</div></a>
			<a href="/course/"><div class="col-sm-3 col-md-2" style="padding-top:20px">
				<div class="row">
					<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
				</div>
				課程
			</div></a>
			<a href="#"><div class="col-sm-3 col-md-2" style="padding-top:20px">
				<div class="row">
					<span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
				</div>
				遊戲
			</div></a>
			<a href="#"><div class="col-sm-3 col-md-2" style="padding-top:20px">
				<div class="row">
					<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
				</div>
				卡牌
			</div></a>
			<a href="#"><div class="col-sm-3 col-md-2" style="padding-top:20px">
				<div class="row">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				</div>
				客服
			</div></a>
		</div><!--row End-->
		<br>
	</div><!--container End-->

	<div style="background-color:#eee"><div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail boxs">
					<img src="/img/game.jpg" width="400px" height="223px" class="img-responsive" alt="Responsive image">
					<div class="caption">
						<h3>遊戲</h3>
						<p>遊戲測試中...</p>
						<p>
							<a href="#" class="btn btn-primary" role="button">體驗新遊戲</a>
							<a href="#" class="btn btn-default" role="button">遊戲公告</a>
						</p>
					</div>
				</div>
			</div><!--first part-->
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail boxs">
					<img src="/img/java.jpg" width="400px" height="223px" class="img-responsive" alt="Responsive image">
					<div class="caption">
						<h3>課程</h3>
						<p>Java 上線測試</p>
						<p>
							<a href="#" class="btn btn-primary" role="button">體驗Java課程</a> 
							<a href="#" class="btn btn-default" role="button">課程公告</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail boxs">
					<img src="/img/team.jpg" class="img-responsive" alt="Responsive image" style="height:233px">
					<div class="caption">
						<h3>會員中心</h3>
						<p>資料維護、重設密碼、驗證Email...</p>
						<p>
							<a href="#" class="btn btn-primary" role="button">前往會員中心</a> 
							<a href="#" class="btn btn-default" role="button">重設密碼</a>
						</p>
					</div>
				</div>
			</div>
		</div><!--row End-->
	</div></div><!--container End-->

	<?php include_once("footer.html"); ?>

	<script type="text/javascript">
		$('.carousel').carousel();
		$('.carousel').carousel({
			interval: 5000
		})
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('body').append('<div id="toTop" class="btn btn-info"><span class="glyphicon glyphicon-chevron-up"></span> Back to Top</div>');
			$(window).scroll(function () {
				if ($(this).scrollTop() != 0) {
					$('#toTop').fadeIn();
				} else {
					$('#toTop').fadeOut();
				}
			}); 
			$('#toTop').click(function(){
				$("html, body").animate({ scrollTop: 0 }, 600);
				return false;
			});
		});
	</script>
</body>
</html>