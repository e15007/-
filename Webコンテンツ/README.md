#ウブンツのipアドレスをＤＨＣＰサーバーによる固定


# interfaces(5) file used by ifup(8) and ifdown(8)
auto lo
iface lo  inet loopback  

#ここから追加 

auto eth0
iface eth0 inet dhcp

#設定を反映させる
sudo /etc/init.d/networking restart
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

##ubuntu15.10にVirtualbox パッケージダウンロード設定

#Virtualboxとは http://jukenki.com/contents/other/virtualbox/about-virtualbox.html

https://www.virtualbox.org/wiki/Linux_Downloads ここからダウンロード

# リポジトリ追加 (より新しい版を手に入れるといった操作を進める際，パッケージ管理システムにリポジトリを登録することで，ソフトウエア・パッケージの格納位置を意識することなく，ソフトウエアを導入・更新できる。パッケージ管理システムに複数のリポジトリを登録しておくことで，正式版，安定版以外のソフトウエア・パッケージを入手できる)

/etc/apt/sources.list に deb http://download.virtualbox.org/virtualbox/debian vivid contrib を追加
システム設定でソフトウェアとアップデートのアイコンをクリックし他のソフトウェアダブで追加をクリックし、APTラインの入力ボックスにdeb http://download.virtualbox.org/virtualbox/debian vivid contrib を追加

#上のリンクからThe Oracle public key for apt-secure can be downloaded here. You can add this key with のhereをクリックし公開鍵を入手 ダウンロードしたファイルはホームディレクトリに置く
sudo apt-key add ファイル名 を実行

#ダウンロードしたパッケージファイル virtualbox-4.1_4.1.8-754676-Ubuntu-oneiric_i386.deb をダブルクリックして、ソフトウェアセンターを開き、「インストール」をクリックしてインストールします。

Unity ランチャーの Dash ホームを開き、アプリケーションの検索で VirtualBox を検索しアイコンをクリックすると VirtualBox 管理画面が起動 






ーーーーーーーーーーーーーーーーーーーー
//仮想OSdebianをインストールするため仮想マシンを構築





# http://cdimage.debian.org/debian-cd/current/amd64/iso-cd/
からdebianのisoファイルをダウンロード (一番上の iso1をダウンロード)




#設定 ストレージ からディスクのアイコンをクリックし右端のディスクアイコンクリックし'仮想光学ディスクファイルを選択'をクリックしisoファイルが保存されているディレクトリからdebian iso を選択し開く。okをクリック

#debian８.２.０をインストール
参考にしたサイト https://sites.google.com/site/hikichin2it/debian600-squeeze/debian600-squeeze-install/debian600-squeeze-installation-procedure-part1
devianを選択し起動ボタンをクリック
画面でインストールを選択し英語を選択
(日本語を選ぶと正常にインストールされない可能性があるため)
locationはotherAsia Japanを選択
次の画面ではUnited Statesを選択
configure the keyboard ではキーボードのレイアウト選択
ホスト名(機器の名前)入力ドメイン名(不明ならlocalhostでもok)はそのままで進める
管理者(root)パスワード設定
あとはユーザー名パスワード追加
ディスクのパーティションフォーマットの指定
ディスク全体を使うことにしました。 
root になり apt update ,apt upgrade,apt install sudoを順番に実行 
 ディスクを  /media/cdrom/ に入れてくださいとメッセージがでたらvirtualboxの 設定のストレージ 仮想光学ドライブにインストールしたdebianのisoイメージを入れ端末でenterを押す
 sudo vi /etc/group を実行しsudo のユーザーを追加
# ホストOSをsshパッケージのインストール
sudo apt install ssh を実行しインストール
ディスクを  /media/cdrom/ に入れてくださいとメッセージがでたらvirtualboxの 設定のストレージ 仮想光学ドライブにインストールしたdebianのisoイメージを入れ端末でenterを押す




#仮想マシンのネットワーク設定

ホストオンリーアダプタをアダプタ２に追加
※追加できない時の対処法 メニューバーのファイル→環境設定→ネットワーク→ホストオンリーネットワーク→右端の+アイコンをクリック
vartiualbox が仮想ルータとなりホストOS ゲストOSだけのネットワークを作る IPV4にゲストosのアドレスを設定
debianの /etc/network/interface をviで編集
auto eth1
iface eth1 inet static
address 192.168.33.10
netmask 255.255.255.0
を追加
sudo  service networking restartを実行


VirtualBoxの管理画面からdevianを選択し設定ボタンをクリック                   






WEBに公開するファイルのパーミッションは基本的には644、ディレクトリは755






