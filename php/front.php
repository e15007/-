<?php
//データベース情報の読み込み  require_once 別のファイルの読み込み
require_once("/var/www/data/use.php");
 
//データベースへ接続、データベース選択

$s=mysql_connect($SERV,$USER,$PASS) or die("失敗しました");
mysql_select_db($DBNM);
//タイトルを表示

print <<<HTM

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>仮想掲示板</title>
</head>
<body>
<header>
<h1>
<font size="7" color="">	
仮想化に関する掲示板
</font>
</h1>
<br><br>
</header><!-- /header -->
<main>
見たいスレッド番号をクリックしてください

<hr>
<font size="5">
(スレッド一覧)
</font>
<br>
HTM;
//クライアントのipアドレスを取得
$ip=getenv("REMOTE_ADDR");
/*スレッドのタイトル(su)にデータがあればtb0に挿入
issetで変数がセットされているか確認
htmlspecialchars関数でhtmlタグなどの特殊文字列を文字列に変換
POSTに値がセットされていなければ$su_dにnullを代入
*/
$su_d=isset($_GET["su"])? htmlspecialchars($_GET["su"]):null;
if($su_d<>""){
	mysql_query("INSERT INTO tb0 (sure,niti,aipi) VALUES ('$su_d',now(),'$ip')");
}


//tb0の全データ抽出
 $re=mysql_query("select * from tb0");
 while($kekka=mysql_fetch_array($re)){
  print <<<HTM2
 	<a href="keizi.php?gu=$kekka[0]">$kekka[0] $kekka[1] </a>
 	<br>
 	$kekka[2]作成<br><br>
HTM2;
 }

 //データベース切断

mysql_close($s);

//スレッド名入力用表示、トップ等へのリンク

print <<<HTM3

<hr>
<font size="5">
(スレッド作成)
</font>
<br>
新しいスレッドを作るときは、ここへどうぞ!
 <br>
<form action="top.php" method="get" >
     新しく作るスレッドのタイトル
	<input type="text" name="su" size="50">
	<br>
	<input type="submit"  value="作成">
</form>
<hr>
<font size="5">
(メッセージ検索)
 </font>
 <a href="search.php" >検索するときはここをクリック</a>
 <hr>
</main>	
<footer>
	
</footer>
</body>
</html>
HTM3;

?>


















	 