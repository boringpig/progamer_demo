<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
	body { 
		padding-top: 49px;
		
		font-family: "Microsoft JhengHei";
	}
	.navbar-default {
		background-color: #9D9D9D;
		border-color: #eee;
		color:#eee;
	}
	.navbar-default  .navbar-nav> li > a {
		color:#eee;
	}
</style> 
<!--TOP Bar -->
<?php
	if (isset($_SESSION['auth'])){
		$isAdmin= $_SESSION['auth']>=2 ;
	}
?>
<nav class="navbar navbar-default navbar-fixed-top <?php if(isset($isAdmin)){if($isAdmin){echo "navbar-inverse";}} ?>" role="navigation" >
	<div class="container">
		<div class="navbar-header">
				<a class="navbar-brand" href="/" style="padding-top:0px">
					<img style="width:50px" class="img-responsive"  alt="Brand" src="/img/logo.png"> 
				</a>
		</div>
	    <div class="collapse navbar-collapse" id="bar"> 
			<?php
				if (isset($_SESSION['auth'])){
					if($isAdmin){
			?>
			<!--LEFT Admin-->
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="fa fa-navicon" aria-hidden="true"></span>
						Administrator
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/management/news_manager.php">公告</a></li>
						<li><a href="/management/member_manager.php">會員</a></li>
						<li><a href="/management/course_manager.php">課程</a></li>
						<li><a href="#">#Game</a></li>
						<li><a href="#">#設定</a></li>
						<li class="divider"></li>
						<li><a href="/account/registration.php">註冊</a></li>
					</ul>
				</li>
			</ul>
			<?php
				}
			}
			?>
			<!--Right User-->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						<?php
							if (isset($_SESSION['uname'])) {
								echo $_SESSION['uname'];
							} else {
								echo "User";
							}
						?>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/news/">最新消息</a></li>
						<li><a href="/game/">開始遊戲</a></li>
						<li><a href="/course/">課程學習</a></li>
						<li class="divider"></li>
						<li><a href="/account/info.php">個人資訊</a></li>
						<li><a href="/account/ResetPwd.php">重設密碼</a></li>
					</ul>
				</li>
				<li><a href="/logout.php">
					<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
					登出
					</a></li>
			</ul>
		</div>
	</div>
</nav>
