<?php

//echo sizeof($rall);

// BEGIN $rall sort by Rate
 for ($n=0; $n<sizeof($rall); $n++)
{
	for ($m=0;$m<sizeof($rall); $m++)
	{
		if($rall[$m][7]<$rall[$n][7])
		{	
			$a=$rall[$n];
			$rall[$n]=$rall[$m];
			$rall[$m]=$a;
		}
	}
	
} 

//END $rall sort by Rate



for($j = $pcObject->get_na(); ($j < ($pcObject->get_na()+$pcObject->naop)); $j++)
{	
	$app = $rall[$j][11];
	$category = $rall[$j][13];



	if(!empty($app))
	{
		echo "<div id=appWinStyle>";
		echo "<table><tr><td>";		
// Begin Main Screenshot
		echo "<div id='mScrsht'><a href='?cnt=ainfo&category=".$category."&app=".$app."&an=".$rall[$j][0]."&l=".$lg." '>";
		include($rootPath."category/".$category."/".$app."/mScrnsht_".$app.".php");
		echo "</a></div>";
/*
	echo "<script type='text/javascript' >
	
var imge=0;
 imge = document.getElementById('mScrsht').getElementsByTagName('img')[0];
var w=imge.width;
var h=imge.height;

if(h>w)
{
	document.getElementById('mScrsht').getElementsByTagName('img')[0].style.width='180px';
}

if(h<w)
{
	document.getElementById('mScrsht').getElementsByTagName('img')[0].style.width='300px';
}
alert('test');

document.write(w);
imge=0;
</script>
";
*/
// End Main Screenshot
		echo "</td><td>";
		echo "<div id='appWinName'> <a href='?cnt=ainfo&category=".$category."&app=".$app."&an=".$rall[$j][0]."&l=".$lg." '><h2>".$rall[$j][0]."</h2></a></div><br/>";
		
// Begin Ratings Stars
		$r = round($rall[$j][7], 1);
		$ir = floor($r);
		$fr = $r-$ir;			
		echo "<img src=\"rating/space.png\" onload=\"getRate($ir ,$fr ,'$app')\" />"; 
//			echo "<script>getRate(".$ir.",".$fr.",'".$app."')</script>";
		echo "<div id='rating'>";
		for($i=1;$i<=5;$i++) 
		{
			echo "<img border='0' hspace='0' src='rating/0.png' id='r$i$app'/>";     
		}
			echo "&nbsp;".$rate_lg." <b>".$r."</b>";
			echo "</div><br>";
// End Rating Stars

// Begin Shot Description
		if($lg=='en') {$shd = $rall[$j][8]; $nl=300;} else {$shd = $rall[$j][9]; $nl=300;}
		$sd = substr($shd,0,$nl);
		echo $sd."...";
// End Shot Description
 
		echo "<br/>";
		echo "<a href='?cnt=ainfo&category=".$category."&app=".$app."&an=".$rall[$j][0]."&l=".$lg."'><b>".$more_lg."...</b></a>";
		echo "</td></tr></table>";
		echo "</div>";
		echo "<hr>";
	}
}


?>

