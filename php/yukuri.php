<?php 

 

 if(isset($_POST['kouyaku'])){ //フォームで送信されたか確認



	$arr =array(24,34,56,78,97,100);//最大公約数を求めるための値を格納


 	for($i=0,$j=1;array_key_exists($j,$arr);$i++,$j++){//数字を一個づつずらして最大公約数をもとめる

    	$l  =$arr[$i];
    	$s  =$arr[$j];  
		$a;
 		while($l!=$s){

			if($l>$s){
				$l= $l-$s;
			}else if($l<$s){
				$s = $s-$l;
			} 
			if($l==$s) {
				$a = $l;
				break;
			}
		}


 		print $arr[$i].'と'.$arr[$j].'の最大公約数は'.$a.' '.'最小公倍数は';

		print"<br><br>";

	}	

	print "<a href='yukuri.php '>元のページに戻る</a>";
 


 }elseif(isset($_POST['nyuryoku'])){//フォームで送信されたか確認
	$a;
	// $b;
	$l= htmlspecialchars($_POST['fi']);//htmlタグを無効
	$s= htmlspecialchars($_POST['sec']);//htmlタグを無効
	$evar = array();
	if(!empty($l)&&!empty($s)){
		if(preg_match("/^[0-9]*$/",$l)&&preg_match("/^[0-9]*$/",$s)){
            $b=$l*$s;

			if($l>$s){
           		while($l%$s!=0){
           
           			$t=$s;
           			$s=$l%$s;
           			$l=$t;

           		}  
         		$a=$s;
			}elseif($l<$s){
           		while($s%$l!=0){
           
           			$t=$l;
           			$l=$s%$l;
           			$s=$t;
          
         		}

           			$a=$l;
        	}   


        //    $b= $l*$s;最小公倍数を求めるため２つの値をかける
			     // $b = $b/$a;
                   $b= $b/$a;
			print '最大公約数は'.$a.'<br>';
			print '最小公倍数は'.$b;

			print "<a href='yukuri.php' >前のページに戻る</a>";
		}else if(!preg_match("/^[0-9]*$/",$l)||!preg_match("/^[0-9]*$/",$s)){

 	   		 print '数字を入力してください!!';
		}
//↑ここまでが2つの値が存在する場合の処理
     }else{ //↓2つの値が存在しない場合のエラー処理

     		if(empty($l)&&!empty($s)){
				$evar[]='1つめを入力してください!!<br>';
			}

			if(!empty($l)&&empty($s)){
			$evar[]='2つめを入力してください!!<br>';
			}
             
            if(empty($l)&&empty($s)){
            $evar[]='数字を入力してください!!<br>';
            }

			foreach($evar as $ev){
				print $ev;
			}

	 }    		                  
    



 }else{

print<<<htm
 <strong>24,34,56,78,97,100の数字の中から左から順に数字を1個ずつ右にずらして2つの数字の最大
 公約数をもとめます。<br>
 ↓のボタンを押してください!!</strong>
<form action=" yukuri.php" method ="post">


<input type="submit" name= "kouyaku" value="最大公約数">
 

</form><br><br><br>
htm;

print<<<htm2

<form action="yukuri.php" method="post" accept-charset="utf-8">
	一つ目の数字<br>
	<input type="text" name="fi" value=""><br><br>
	2つ目の数字<br>
	<input type="text" name="sec" value=""><br><br>
	<input type="submit" name="nyuryoku" value="最大公約数">
</form>

htm2;
}




//最大公倍数を求める（ユークリッドの互除法）
function gcd($m, $n) {
while ($m % $n != 0) {
$temp = n;
$n = $m % $n;
$m = $temp;
}
return $n;
}

//最小公倍数を求める
function lcm($m, $n) {
return $m * $n / gcd($m, $n); 
}





?>