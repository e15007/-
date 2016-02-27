<?php 

require_once('us.php') ;
session_start();

//DB接続
$mysqli= new mysqli("$db_host","$user","$pass","$_db"); 
//DB接続エラー
if ($mysqli->connect_errno) {
	print "データベース接続に失敗しました".$mysqli->connect_error;
	$mysqli->close();
}

$salt = "mwefCMEP28DjwdW3lwdS239vVS";
$statas="none";


if (isset($_SESSION['username'])) {  //ログイン中の処理(セッション管理がされている場合)
	$statas="login";
}else if(!empty($_POST['username']) && !empty($_POST['password'])){  //ユーザーネームとパスワードが送られてきた時の処理

$option = [
'salt'=> 'mwefCMEP28DjwdW3lwdS239vVS'

];

$passwd = password_hash($_POST['password'],PASSWORD_BCRYPT,$option);

	$stmt=$mysqli->prepare("SELECT username,password from user where username=? and password=?");
	$stmt->bind_param('ss',$_POST['username'],$passwd);
	$stmt->execute();
    $stmt->bind_result($us,$pas);
    $stmt->fetch();
    if($us&&$pas){  //値が存在する場合の処理
		$statas= "ok";
		session_regenerate_id(true);
		$_SESSION['username']=$_POST['username'];
		$mysqli->close();
	}else{
		$statas="faild";
}
}



?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン画面</title>

	
	<script type="text/javascript">
//パスワード表示
		function text(pas){
			document.form1.password.value=pas.value;
			document.form1.passtext.value=pas.value;
		} 

		function button(chk){
			if(chk.checked){
				document.form1.passtext.style.display="inline-block";
				document.form1.password.style.display="none";
		
			}else{
				document.form1.passtext.style.display="none";
				document.form1.password.style.display="inline-block";
		
			}
			chk.blur();
		}	

		function sub() {                            
  			var flag=0;
  
			if (document.form1.username.value.match(/[^0-9A-Za-z]+/) || document.form1.password.value.match(/[^0-9A-Za-z]+/)) {
				flag=1;
			} 

			if (document.form1.username.value.match(/^nu(ll)$/) || document.form1.password.value.match(/^nu(ll)$/)) {

				flag=1;
			}

			if (flag) {
  				alert("null以外の半角英数字で入力して下さい");
 				return false ;
 

			}else{

				return true;

			}

		}





</script>

</head>
<body>
<?php if($statas=="ok"): ?>

<p>ログイン成功!</p>

<a href="keizi_top.php" >掲示板トップへ</a>

<?php elseif($statas=="login"): ?>	
<p>ログイン中です<br><a href="keizi_top.php ">掲示板トップへ</a></p>
<?php else : ?>
<?php if($statas=="faild"): ?>
<p>
ログインに失敗しました。Username,Passwordの入力に誤りがないか確認してください!!
	
</p>

<?php endif; ?>

<form action="rogin.php" method="post" accept-charset="utf-8" name="form1"  onsubmit="return sub()">
<div>
<input type="text" name="username" id="username" value="test1"   >	
</div>
<div>
<input type="password" name="password"   data-prompt-position="inline"  value="test1"    onblur="return text(this)">
<input type="text" name="passtext" value="test1" id="passtext" style="height:14px;display:none;"   onblur="return text(this)"><br>
<input type="checkbox" name="check" onclick="return button(this)"><label for="check">パスワード表示</label>
<input type="submit" name="submit" value="ログイン">
</div>	

</form>
<?php endif; ?>

</body>
</html> 