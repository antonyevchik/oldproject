<?php
$rall=dbClass::$rall;
$pp=dbClass::$pp;


if(($pp-$startItem)<$itemAmount) $itemAmount=($pp-$startItem);

for($j=$startItem;$j<$startItem+$itemAmount;$j++)
{
	$item=$rall[$j][2];
	$Developer=$rall[$j][5];
	$rate=$rall[$j][9];
	$shortDescription=$rall[$j][10];

	//$category=$rall[$j][12];
	if (!$_GET['category']) { $cat=explode(',', $rall[$j][12]); $category=$cat[0];}

	$itemid=$rall[$j][13];
	for ($k=0;$k<sizeof($langs_array);$k++) {$replaceNeedle[$k]="_".$langs_array[$k];}
	$itemid_wl=str_replace($replaceNeedle, '', $itemid);  // id without language tail ('_en' or '_ru')
	
	echo "<div id=appWinStyle>";
	echo "<table><tr><td>";
	
	// Begin Main Screenshot
	echo "<div style='float: left; margin-left:5px; margin-right:5px;'><a href='?cnt=iinfo&category=".$category."&appn=".$item."&itemid=".$itemid."&l=".$lg."'>";
	include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/screenshots/mScrnsht_".$itemid_wl.".php";
	echo "</a></div>";
	
	//echo "<div id='mScrsht'><a href='?cnt=iinfo&category=".$category."&appn=".$item."&itemid=".$itemid_wl."&l=".$lg."'>";
	//include($rootPath."category/".$category."/".$item."/mScrnsht_".$item.".php");
	//echo "</a></div>";
	// End Main Screenshot
	echo "</td><td>";
	echo "<div id='appWinName'> <a href='?cnt=iinfo&category=".$category."&appn=".$item."&itemid=".$itemid."&l=".$lg."'><h2>".$item."</h2></a></div><br/>";
	
	// Developer
	echo "<b>".__ADDAPP_DEVELOPER_LG." </b>".$Developer."<br><br>";
	
	// Begin Ratings Stars
	$r = round($rate, 1);
	$ir = floor($r);
	$fr = $r-$ir;
	echo "<img src='".__ROOT_PATH."rating/space.png' onload=\"getRate($ir ,$fr ,'$itemid')\" />";
	//			echo "<script>getRate(".$ir.",".$fr.",'".$item."')</script>";
	echo "<div id='rating'>";
	for($i=1;$i<=5;$i++)
	{
	echo "<img border='0' hspace='0' src='".__ROOT_PATH."rating/0.png' id='r$i$itemid'/>";
	}
	echo "&nbsp;".$rate_lg." <b>".$r."</b>";
	echo "</div><br>";
	// End Rating Stars

	// Begin Shot Description
	if($lg=='en') {$shd = $shortDescription; $nl=300;} else {$shd = $shortDescription; $nl=300;}
	$sd = substr($shd,0,$nl);
	echo $sd."...";
	// End Shot Description

	echo "<br/>";
	echo "<a href='?cnt=iinfo&category=".$category."&appn=".$item."&itemid=".$itemid."&l=".$lg."'><b>".$more_lg."...</b></a>";
	echo "</td></tr></table>";
	echo "</div>";
		echo "<hr>";

}

$pcObject->pageNmbrPrnt($pp,$lg);

?>
