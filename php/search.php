<?php

//データベース情報の読み込み  require_once 別のファイルの読み込み
require_once("/var/www/data/use.php");
//データベースへ接続、データベース選択
$s=mysql_connect("$SERV","$USER","$PASS") or die("失敗しました");
mysql_select_db($DBNM);

// タイトル等の表示

print <<<HTM

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>仮想化掲示板</title>
</head>
<body>
<header>
</header><!-- /header -->
<main>
	
	<hr>
	<font size="5">
	(検索結果はこちら)
	</font>
	<br>
HTM;

//検索文字を取得してタグを無効化
$se_d=isset($_GET["se"])?htmlspecialchars($_GET["se"]):null;

//検索文字列($se_d)にデータがあれば検索処理

if($se_d<>""){
	//検索のSQL文 テーブルtb1にtb0を結合
	$str=<<<sql
select tb1.bang,tb1.nama,tb1.mess,tb0.sure 
from tb1 join tb0 
on 
tb1.guru=tb0.guru
where tb1.mess like "%$se_d%"
sql;

//検索クエリを実行
$re=mysql_query($str);
$i=0;
while($kekka=mysql_fetch_array($re)){
	print "$kekka[0] : $kekka[1] : $kekka[2] ($kekka[3])";
	print "<br><br>";


}
}
//データベース切断
mysql_close($s);

//検索文字列入力用表示、トップへのリンク
print <<<HTM2
<hr>
メッセージに含まれる文字を入力してください!
<br>
<form action="search.php" method="get">
	検索する文字列
	<input type="text" name="se">
	<br>
	<input type="submit"  value="検索">
</form>
<br>
<a href="top.php" >スレッド一覧に戻る</a>

</main>
	<footer>
		
	</footer>
</body>

</html>
HTM2;
?>