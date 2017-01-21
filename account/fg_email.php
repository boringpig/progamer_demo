<?php 
	session_start();
	$to = $_SESSION['email'];
	$subject = "重設您的密碼 Reset Your Password";
	$message = "請重新設定您的密碼";
	$from = "progamer@progamer.tw";
	$headers = "From: Progamer客服中心<$from>";
	mail($to,$subject,$message,$headers);
	echo "已經寄信到您的信箱";
?>