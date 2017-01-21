<?php
  include_once(dirname(dirname(__FILE__))."/checkauth.php"); 
  authaccess(0);
  include_once(dirname(dirname(__FILE__))."/config/sql_config.php");

$question = $_SESSION["question"];
$level = $_SESSION["level"];
$chap = $_SESSION["chap"];
$uid = $_SESSION["uid"];
/*撈資料庫答案*/
$sql = "Select ans from course_right where chapter = '$chap' and level = '$level' and question = '$question' ";
$result = $mysqli->query($sql);
$right_ans = mysqli_fetch_array($result);
$row = explode(",",$right_ans['ans']);
$num = $row[0];

$max = (int)$num;

$count = 0 ;//目前答對題數
for($i=0;$i<$max;$i++){
	$cur = $i+1;
  
	$ans = "ans".(string)$cur;
  //判斷空值
  if($_POST[$ans] == null){
     echo "<script>swal({   title: \"有答案忘記寫哦\",imageUrl: \"/img/disable.png\"})</script>";
  }else{
    if((strcasecmp($_POST[$ans],$row[$cur])==0)){
      $count++;
    }else{
      echo "<script>swal({   title: \"答錯囉\",text: \"請重新作答吧~\", imageUrl: \"/img/disable.png\"})</script>";
    }
  }
}
if($count == $max){
	$next = $question + 1;
  //檢查有無下一題
  $nsql = "Select ans from course_right where chapter = '$chap' and level = '$level' and question = '$next' ";
  $code = $mysqli->query($nsql);
	$code_num = mysqli_num_rows($code); 
  if($code_num>0){
    //有下一題就更新
    $str = $chap.",".$level.",".$next;
    //更新使用者的答題狀態
    $upsql = "UPDATE member SET m_course = '$str' where m_id = '$uid' ";
    $up = $mysqli->query($upsql);
    echo "<script>swal({   title: \"答對囉\",text: \"快點前往下一題吧~\", imageUrl: \"/img/enable.png\"},function(){ location.href = \"learn.php\";});</script>";
  }else{
    //沒有下一題變下一關
    $level++;
    $first = 1;
    $str = $chap.",".$level.",".$first;
    $upsql = "UPDATE member SET m_course = '$str' where m_id = '$uid' ";
    $up = $mysqli->query($upsql);
    echo "<script>swal({   title: \"此關完成囉\",text: \"快點前往下一關吧~\", imageUrl: \"/img/enable.png\"},function(){ location.href = \"learn.php\";});</script>";
  }
}

?>