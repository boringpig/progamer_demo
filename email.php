<?php
session_start();
$to = $_SESSION['email'];
$subject = "重新設定您的密碼 Reset your password";
$message = "重新設定您的密碼 Reset your password";
$from = "progamer@progamer.tw";
$headers = "From: Progamer團隊<$from>";
echo mail($to,$subject,$message,$headers);
echo "Mail Sent.";

?>