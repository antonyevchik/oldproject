<?php

$rall=dbClass::$rall;
$pp=dbClass::$pp;


if(($pp-$startItem)<$itemAmount) $itemAmount=($pp-$startItem);

for($j=$startItem;$j<$startItem+$itemAmount;$j++)
{
	$item=$rall[$j][2];
	$itemid=$rall[$j][9];
	echo "<div id=appWinStyle>";
	echo "<table><tr><td>";
	// Begin Main Screenshot
	echo "<div id='mScrsht'><a href='?cnt=ainfo&category=".$category."&app=".$item."&an=".$rall[$j][2]."&l=".$lg." '>";
	//include($rootPath."category/".$category."/".$item."/mScrnsht_".$item.".php");
	echo "</a></div>";
	// End Main Screenshot
	echo "</td><td>";
	echo "<div id='appWinName'> <a href='?cnt=ainfo&category=".$category."&app=".$item."&an=".$rall[$j][2]."&l=".$lg." '><h2>".$rall[$j][2]."</h2></a></div><br/>";

	// Begin Ratings Stars
	$r = round($rall[$j][8], 1);
	$ir = floor($r);
	$fr = $r-$ir;
	echo "<img src='../..".__ROOT_PATH."rating/space.png' onload=\"getRate($ir ,$fr ,'$itemid')\" />";
	//			echo "<script>getRate(".$ir.",".$fr.",'".$item."')</script>";
	echo "<div id='rating'>";
	for($i=1;$i<=5;$i++)
	{
	echo "<img border='0' hspace='0' src='../..".__ROOT_PATH."rating/0.png' id='r$i$itemid'/>";
	}
	echo "&nbsp;".$rate_lg." <b>".$r."</b>";
	echo "</div><br>";
	// End Rating Stars

	// Begin Shot Description
	if($lg=='en') {$shd = $rall[$j][3]; $nl=300;} else {$shd = $rall[$j][3]; $nl=300;}
	$sd = substr($shd,0,$nl);
	echo $sd."...";
	// End Shot Description

	echo "<br/>";
	echo "<a href='?cnt=iinfo&category=".$category."&postn=".$item."&itemid=".$itemid."&l=".$lg."'><b>".$more_lg."...</b></a>";
	echo "</td></tr></table>";
	echo "</div>";
		echo "<hr>";

}

$pcObject->pageNmbrPrnt($pp,$lg);

?>