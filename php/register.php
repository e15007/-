


<?php 
require_once './us.php';
 $salt = "mwefCMEP28DjwdW3lwdS239vVS";


$mysqli = new mysqli("$db_host","$user","$pass","$_db");  //データベース接続

if($mysqli->connect_errno){    //データベース接続エラーの場合の処理
	print "接続に失敗しました".$mysqli->connect_error;
	exit();
}
$statas = "none";

//↓送信されたフォームに値がセットされていた場合の処理
 if(!empty($_POST['username']) && !empty($_POST['password'])&&!preg_match("/[^A-Za-z0-9]\s/",$_POST['username'] )&&!preg_match("/[^A-Za-z0-9]\s/",$_POST['password'] )){

$option = [
'salt'=> 'mwefCMEP28DjwdW3lwdS239vVS'

];

$passwd = password_hash($_POST['password'],PASSWORD_BCRYPT,$option);


$regist = $mysqli->prepare("INSERT INTO user(username,password) value(?,?)");

$regist->bind_param( 'ss',$_POST['username'],$passwd ) ;
if($regist->execute()){
$statas  = "ok";

}else {
	$statas = "faild";
}

}
 ?>






 <!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>アカウント登録画面</title>
	<style type="text/css" >
		h1 {
			text-align: center;
		}

		p {
			text-align: center;
		}
		div {
			text-align:center;
		}
	</style>
	<meta http-equiv='Content-Style-Type' content='text/javascript'>
	
 

	<script type="text/javascript"  >
      
	 	function check(){
     		var flag=0;
     		var flag2=0;
     		
         
     		if(document.form1.username.value==""||document.form1.password.value==""){
     			flag=1;
     		}

     		if (document.form1.username.value.match(/[^A-Za-z0-9]+/)|| document.form1.password.value.match(/[^A-Za-z0-9]+/)) {
            	flag=1;

     		}
     		if(document.form1.username.value.match(/null/)|| document.form1.password.value.match(/null/)){
     			flag2=1;
     		}



			if(flag){
			
     			window.alert('必須項目に誤りがありました\n半角英数字で入力してください');
     			return false;
			
     	 	}else{
     	 		if(flag2){
                	window.alert("必須項目に誤りがありました\nnullは使えません");
                	return false;
     	 		}else{
					return true;
     	 		}
     	 	}
     	}

      function passSync(pas){
         document.form1.password.value=pas.value;
         document.form1.passtxt.value=pas.value;

      }

      function tex(chk){
      	if(chk.checked){
      		document.form1.password.style.display="none";
      		document.form1.passtxt.style.display="inline-block";
      	}else{
      		document.form1.password.style.display="inline-block";
      		document.form1.passtxt.style.display="none";
      	}	
         	chk.onblur
      	}

      jQury(document).ready(function(){

       



      })

 </script>


	
</head>
<body>

<?php if ($statas=="ok"): ?>
<p>登録完了</p>
 
 
 	
 <?php elseif($statas=="faild"): ?>


<p>すでに存在するユーザーです</p>
<a href="register.php" >前の画面に戻る</a>
 

<?php else: ?>



	

<form action="register.php" method="post" accept-charset="utf-8" name="form1" onsubmit="return check()">
		<h1>アカウント登録画面</h1>
			<p>半角英数字で入力してください。(記号、スペースは使えません)</p>
		<p>ユーザー名: <input type="text" name="username" value="null" >
		<p>(必須 スペース使えません)</p><br>
		<p>パスワード:<input type="password" name="password" value="null"  size="10" style="height:14px;" onblur="passSync(this)">
		            <input type="text" name="passtxt" value="null" size="10" style="height:14px;display:none;" onblur="passSync(this)"></p>
		<p>(必須 スペース、使えません)</p>
		            <div>
		            	
		            <input type="checkbox" name="word" onclick="tex(this)" checkesd><label for="word">
		            	パスワードを表示する
		            </label>
		            </div>
		<div>
		<input type="submit" name="登録" >		
		</div>
			
		</p>
	</form>
<?php endif; ?>
	

</body>
</html>

