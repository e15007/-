<?php 
$omikuji = array('小吉','大吉','中吉','末吉','凶','もう一度');
$result= $omikuji[mt_rand(0,5)];
if(array_key_exists('RAND',$_POST)){
	$random = $_POST['RAND'];
}
?>
<!DOCTYPE html>
<html lang = ja>
<head>
<meta charset="utf-8" >
	<title>おみくじ</title>
</head>
<body>
<h1> おみくじ</h1>

<p>今日の運勢は「<?php
if(isset($random)){echo $result;} ?>」です!</p>
<form action="omikuji.php" method="post" >
	<input type="hidden" name="RAND" value="">
	<input type="submit" name="" value="omikuji ">
	
</form>
<p><a href=" omikuji.php">もう一度</a></p>
</body>
</html>