<?php

if($_GET['appn']) {$appn=$_GET['appn']; $itemTitle=$_GET['appn'];}
if($_GET['rate']) $rate=$_GET['rate'];
if($_GET['itemid']) $itemid=$_GET['itemid'];

for ($j=0;$j<sizeof($langs_array);$j++) {$replaceNeedle[$j]="_".$langs_array[$j];}
$itemid_wl=str_replace($replaceNeedle, '', $itemid);  // id without language tail ('_en' or '_ru')
$rall=dbClass::db_get_item_allinfo($section, $itemid);
$authorName=$rall[0];
$postDate=$rall[1];
//$itemTitle=$rall[2];
$appVersion=$rall[3];
$OS=$rall[4];
$appDeveloper=$rall[5];
$appSize=$rall[6];
$Description=$rall[11];

$link=__ROOT_PATH.$section."/?cnt=iinfo&category=$category&appn=$appn&itemid=$itemid&l=$lg";


echo "<br>";

// main screenshot block
echo "<div style='float: left; margin-left:5px; margin-right:5px;'>";
include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/screenshots/mScrnsht_".$itemid_wl.".php";
echo "</div>";

// app info block
echo "<div style='float: left; max-width:190px; margin-left:5px; margin-right:5px;'>";
echo "<h2>".$itemTitle."</h2><br>";
echo "<b>".__POSTEDBY_LG." </b>".$authorName."<br>";
echo "<b>".$postDate_lg."</b><br> ".$postDate."<br><br>";
echo "<b>".__VERSION_LG." </b>".$appVersion."<br>";
echo "<b>".__OS_LG." </b>".$OS."<br>";
echo "<b>".__ADDAPP_DEVELOPER_LG." </b>".$appDeveloper."<br>";
echo "<b>".__SIZE_LG." </b>".$appSize."<br>";
echo "<br>";

echo "</div>";


// QR-code and dowload link block
echo "<div style='float: left; margin-top: 20px; margin-left:5px; margin-right:5px; text-align: center;'>";
echo "<b>".__QRCODE_LG.":</b><br>";
include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/qr_".$itemid_wl.".php";
echo "<br><br>";
echo "<a href='"; include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/downloadlink_".$itemid_wl.".php"; echo "'> <b>DOWNLOAD</b> </a>";
echo "<br><br>";
if(file_exists(__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/olddownloadlink_".$itemid_wl.".php")) include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/olddownloadlink_".$itemid_wl.".php";
	echo "<br><br>";
echo "</div>";



echo "<br style='clear:both; '>";
echo "<div style='margin-top:10px;margin-left: 20px;'>";
dbClass::db_set_rating($section, $rate, $fixipPerm, $itemid, $link, $rate_lg, $votes_lg);
echo "</div>";
echo "<br>";
// like widgets (vk.com, facebook.com, g+) block
//echo "<div style='max-height: 10px;'>";
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
	
//echo "</div>";



//echo "<b>".$AuthorName_lg."</b>&nbsp".$rall[0].";&nbsp&nbsp<b>".$postDate_lg."</b>&nbsp".$rall[1];
echo "<br><br>";

// Description block
echo "<div style='position: relative; clear: both; top: 20px;'>";
echo "<h3 id='mainHeader'>Description</h3>";
echo "<div id='post_description_Content'>";
echo $Description;
echo "</div>";
echo "</div>";

//Screenshots block
echo "<br style='clear: both;'>";

echo "<h3 id='mainHeader'>Screenshots</h3>";
//echo "<div style='max-width:530px; margin-left:20px; margin-right:auto; margin-top:10px; margin-bottom:10px; text-align: center;'>";
echo "<br>";
echo "<div id='ss_container'>";
echo "<div id='slideshow'>";

for ($i=1;$i<=5; $i++)
{
	$filepath=__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/screenshots/screenshots_".$i."_".$itemid_wl.".php";
	if (file_exists($filepath)) include $filepath; 
}
echo "</div>";

echo "</div>";


//echo "</div>";

//Messages block
$mesPath=__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/";
$mesBufferPath=__DOCUMENT_ROOT_PATH."messages/app_mes_files/";

echo "<div style='position: relative; clear: both; top: 20px;'>";
echo "<h3 id='mainHeader'>Comments</h3>";
echo "<br>";
messagesClass::messages($itemTitle, $mesPath, $mesBufferPath, $itemid_wl);
echo "</div>";

?>
