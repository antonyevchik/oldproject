<?php
//include "phpqrcode/qrlib.php"; //QRcode library including
//echo $_SERVER['REMOTE_ADDR'];

echo "<div id='appWinStyle'>";

//echo "<hr>";



if(!empty($_GET['idn'])&&!empty($_GET['nn'])) 
{
	$category = $_GET['category'];
	$idn = $_GET['idn'];
	$nn = $_GET['nn'];
	$aPath = $rootPath."news/".$category."/".$idn;
	$msgPath = $rootPath."messages/messages_news.php";
	
	
	$queryDesc="SELECT Description_en, Description_ru FROM \"$category\" WHERE Id='$idn'";
	$resultDesc=mysql_query($queryDesc);
	if(!$resultDesc) die('database access error'. mysql_error());	
	$rowDesc = mysql_fetch_row($resultDesc);
		
	echo "<h3>".$_GET['category']; if(isset($_GET['nn'])) {echo "&nbsp;>&nbsp;".$_GET['nn']."</h3>";}

	echo "<div id='mScrsht'>";
	include ($aPath."/mScrnsht_".$idn.".php");
	echo "</div>"; 
/*	echo "<div id='mInfo'>";
	include ($aPath."/mInfo_".$lg."_".$app.".php");
	include ($rootPath."rating/rating.php");
	echo "</div>";
	echo "<div id='qr'><b>$qrCode_lg &nbsp;</b><br>";
	include ($aPath."/qr_".$app.".php");
	echo "</div>";
	echo "<div id='Links'><b>$additLink_lg</b>";
	include ($aPath."/links_".$app.".php");
	echo "</div>";
*/
	echo "<br>";

//	echo "<p><h3>$Description_lg</h3></p>";
//	echo "<h2>".$nn."</h2>";
	echo "<div id='Desc'>";
	//include ($aPath."/dscrpt_".$lg."_".$idn.".php");
	if($lg=='en') echo $rowDesc[0];
	if($lg=='ru') echo $rowDesc[1];
	echo "</div><br>";
	echo "<div id='vk_like'><script type='text/javascript'>VK.Widgets.Like('vk_like', {type: 'mini'});</script></div>";
	echo "
	<!-- Place this tag where you want the +1 button to render. -->
	<div class='g-plusone'></div>

	<!-- Place this tag after the last +1 button tag. -->
	<script type='text/javascript'>
  	(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  	})();
	</script>";
	echo "<div class='fb-like' data-send='true' data-layout='button_count' data-width='450' data-show-faces='true' data-font='lucida grande'></div>";

	echo "<br>";
/*	echo "<p><h3>$Screenshots_lg</h3></p>";
	echo "<div id='scrnShts'>";
	include ($aPath."/scrnshts_".$app.".php");
	echo "</div>";
	*/
	echo "<p><h3>$Messages_lg</h3></p>";
	include ($msgPath); 
//echo "</div>";
}
echo "</div>";
//header('Location: index.php');
?>