<?php 

//データベース情報等の読み込み
require_once("./use.php");

//データベースへ接続,データベース選択
$s=mysql_connect($SERV,$USER,$PASS) or die("失敗しました");
mysql_select_db($DBNM);
//タイトル,画像等の表示

echo 'Ok!';

print <<<eot1


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" >
    <title>SQLカフェのページ</title>
</head>
<body bgcolor='lightsteelblue'>
    <img src="pic/oya.gif" alt="">
    <FONT size="7" color="indigo">
        SQLカフェ掲示板だよ〜
    </FONT>
        <br><br>
        見たいスレッドの番号をクリックして下さい
        <hr>
        <FONT size='5'>
            (スレッド一覧)
        </FONT>
        <br>
eot1;
//クライアントIPアドレス取得
$ip=getenv("REMOTE_ADDR");

//スレッドのタイトル(su)にデータがあればtbj0に挿入
$su_d=isset($_GET["su"])? htmlspecialchars($_GET["su"]):null;
if($su_d<>""){
    mysql_query("INSERT INTO tb0 (sure,niti,aipi) values
    ('$su_d',now(),'$ip') ");
} 


// tbj0の全データ抽出
$re=mysql_query('select * from tb0');
while($kekka=mysql_fetch_array($re)){
    print <<<eot2
    <a href="keizi.php?gu=$kekka[0]">$kekka[0] $kekka[1] </a>
    <br>
    $kekka[2]作成<br><br>
eot2;
}



// データベース切断
mysql_close($s);

// スレッド名入力用表示,トップ等へのリンク
print <<<eot3
<hr>
<FONT size="5">
(スレッド作成)
    </FONT>
    <br>
    新しくスレッドを作るときは,ここでどうぞ!
    <br>
    <form action="keizi_top.php" method="get" >
        新しく作るスレッドのタイトル
        <input type="text" name="su" size="50">
        <br>
        <input type="submit" value="作成">
    </form>
    <hr>
    <FONT SIZE="5">
    (メッセージの検索)
    </FONT>
    <a href="keizi_search.php">検索するときはここをクリック</a>
    <hr>
eot3;
     print '</body>';
     print '</html>';
 ?>
