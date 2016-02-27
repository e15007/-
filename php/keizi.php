<?php


//データベース情報の読み込み  require_once 別のファイルの読み込み
require_once("./use.php");
//データベースへ接続、データベース選択
$s=mysql_connect($SERV,$USER,$PASS) or die("失敗しました");
mysql_select_db($DBNM);

//スレッドグループ番号(gu)を取得し$gu_dに代入
$gu_d=$_GET["gu"];

//$gu_dに数字以外が含まれていたら処理中止
if(preg_match("/[^0-9]/",$gu_d)){
print <<<HTM
	不正な値が入力されています。<br>
	<a href="top.php" title="">ここをクリックしてスレッド一覧に戻ってください</a>
HTM;
//↓正常な値の処理	
}elseif(preg_match("/[0-9]/",$gu_d)){
	//名前とメッセージを取得してタグを無効化
$na_d=isset($_GET["na"])?htmlspecialchars($_GET["na"]):null;
$me_d=isset($_GET["me"])?htmlspecialchars($_GET["me"]):null;
//ipアドレスを取得
$ip=getenv("REMOTE_ADDR");

//スレッドグループ番号(gu)に一致するレコードを表示
$re=mysql_query("select sure from tb0 where guru='$gu_d'");
$kekka=mysql_fetch_array($re);

//スレッド内容の表示文字列$sure_comを作成
$sure_com=" $gu_d 「$kekka[0]」";

//スレッド表示のタイトル等書き出し
print <<<HTM2

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>仮想化掲示板</title>
</head>
<body>
<header>
<font size="7">
$sure_com スレッド!
</font>
</header><!-- /header -->
	<br><br>
	<main>
<font size="5">
$sure_com  のメッセージ 
</font><br>
注意:レスは３０件まで!
<br>
HTM2;


 // $ar = array_count_values($exit);
//名前($na_d)が入力されていればtb1にレコード挿入
if (array_key_exists('res',$_GET)){
	if($errors2=errors()){
$i=0;
		while(array_key_exists($i,$errors2)){
			print $errors2[$i];
			$i++;
		}
	}else{
mysql_query("insert into tb1 values (0,'$na_d','$me_d',now(),'$gu_d','$ip')");
	}
}


//区切り線

print "<hr>";

//日時の順にレスデータを表示
$re=mysql_query("select * from tb1 where guru=$gu_d order by niti");

$i=1;//
while($kekka=mysql_fetch_array($re)){
	print"($i):<u>$kekka[1]</u>:$kekka[3] <br>"; //$kekka[0]
	print nl2br($kekka[2]);
	print "<br><br>";

	// if($i==5){
	// 	break;
	// }
	 $i++;
}

//データベース切断
mysql_close($s);

print<<<HTM3

<hr>
<font size="5">
$sure_com にメッセージを書くときはここにどうぞ
</font>

<form action="keizi.php" method="get" >
	名前<input type="text" name="na"><br>
メッセージ<br>
<textarea name="me" rows="10">

</textarea>
<br>
<input type="hidden" name="gu" value="$gu_d">
<input type="hidden" name="res" value=""> 
<input type="submit" name="" value="送信">
</form>
<hr>
<a href="top.php" title="">スレッド一覧に戻る</a>
</main>
</body>
<footer>
	
</footer>
</html>

HTM3;
//$gu_dに数字以外も、数字も含まれていないときの処理
}else{
 print "スレッドを選択してください。<br>";
 print "<a href='top.php' >ここをクリックして下さい</a>";
}



function errors( ){
	
	$errors= array();
	$ta= mysql_query("select * from tb1 where guru=$GLOBALS[gu_d]"); // １工夫
$exit=  mysql_num_rows ($ta);   // ２クエリーの行数を得る


	if($exit >= 30){            //３サイトを見づらくするのを防ぐため
$errors[]= "<font size='5'>新しいスレを作成してください</font><br>";
}

	if (! strlen(trim($GLOBALS['na_d']))) {
        $errors[] = "<font size='5'>名前を入力してください!!</font><br>";
    }

    if(! strlen(trim($GLOBALS['me_d']))){
    	$errors[] = "<font size='5'>メッセージを入力してください!!</font><br>";
    }
return $errors;
}




?>