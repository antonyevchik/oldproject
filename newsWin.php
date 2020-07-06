<?php
// BEGIN $rall sort by Date
 for ($n=0; $n<sizeof($rall); $n++)
{
	for ($m=0;$m<sizeof($rall); $m++)
	{
		if($rall[$m][5]<$rall[$n][5])
		{	
			$a=$rall[$n];
			$rall[$n]=$rall[$m];
			$rall[$m]=$a;
		}
	}
	
} 

//END $rall sort by Date

	
for($j = $pcObject->get_na(); ($j < ($pcObject->get_na()+$pcObject->naop)); $j++)
{	
	$idn = $rall[$j][6];
	$category = $rall[$j][7];
		
		
		if($lg=='en')
		{
			$Name=$rall[$j][1];
		}
		else 
		{
			$Name=$rall[$j][2];
		}
			
			
	if(!empty($idn))
	{
		echo "<div id=appWinStyle>";
		echo "<table><tr><td>";		
// Begin Main Screenshot
		echo "<div id='mScrsht'><a href='?cnt=fnws&category=".$category."&idn=".$idn."&nn=".$Name."&l=".$lg."'>";
		include($rootPath."news/".$category."/".$idn."/mScrnsht_".$idn.".php");
		echo "</a></div>";

// End Main Screenshot
		echo "</td><td>";
		
	
//		echo "<div id='appWinName'> <a href='?cnt=fnws&category=".$category."&idn=".$idn."&nn=".$Name."&l=".$lg."'><h2>".$Name."</h2></a></div><br/>";

// Begin Shot Description
		if($lg=='en') {$shd = $rall[$j][3]; $nl=300;} else {$shd = $rall[$j][4]; $nl=300;}
		$sd = substr($shd,0,$nl);
		echo $sd."...";
// End Shot Description
 
		echo "<br/>";
		echo "<a href='?cnt=fnws&category=".$category."&idn=".$idn."&nn=".$Name."&l=".$lg." '><b>".$more_lg."...</b></a>";
		echo "</td></tr></table>";
		echo "</div>";
		echo "<hr>";
	}
}
?>