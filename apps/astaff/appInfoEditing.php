<?php


if($_GET['appn']) {$appn=$_GET['appn']; $itemTitle=$_GET['appn'];}
if($_GET['rate']) $rate=$_GET['rate'];
if($_GET['itemid']) $itemid=$_GET['itemid'];
for ($j=0;$j<sizeof($langs_array);$j++) {$replaceNeedle[$j]="_".$langs_array[$j];}
$itemid_wl=str_replace($replaceNeedle, '', $itemid);  // id without language tail ('_en' or '_ru')

$appPath=__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl;

$rall=dbClass::db_get_item_allinfo($section, $itemid);
$authorName=$rall[0];
$postDate=$rall[1];
$appName=$rall[2];
$appVersion=$rall[3];
$OS=$rall[4];
$appDeveloper=$rall[5];
$appSize=$rall[6];
$Description=$rall[11];

$link=__ROOT_PATH.$section."/?cnt=iinfo&category=$category&appn=$appn&itemid=$itemid&l=$lg";


echo "<script>
				function checkActivity(checkPermit,changeBox) { var x = document.getElementById(checkPermit).checked; document.getElementById(changeBox).disabled=!x; }
	  </script>";

echo "<br>";

// begin editing form
echo "<form style=' clear:both;' action='".__ROOT_PATH."apps/astaff/saveChanges.php' method='post' enctype='multipart/form-data'>";

// main screenshot block
echo "<div style='float: left; margin-left:5px; margin-right:5px;'>";
include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/screenshots/mScrnsht_".$itemid_wl.".php";
echo "<br>";

echo "<div >";
echo "Change main screenshot using URL:<br><input id='checkText_mainScrnsht' type='checkbox' name='mainScrnsht' onclick='checkActivity(\"checkText_mainScrnsht\",\"changeText_mainScrnsht\")'>";
echo "<input id='changeText_mainScrnsht' type='text' name='mainScreenshotLink'  disabled>";
echo "<br>";
echo "or upload image file:<br><input id='checkFile_mainScrnsht' type='checkbox' name='mainScrnsht' onclick='checkActivity(\"checkFile_mainScrnsht\",\"changeFile_mainScrnsht\")'>";
echo "<input id='changeFile_mainScrnsht' type='file' name='mainScreenshotLink'  disabled>";
echo "</div>";
echo "</div>";

// app info block
echo "<div style='float: left; margin-left:5px; margin-right:5px;'>";
echo "<b>".__ADDAPP_APPNAME_LG." </b><input type='text' name='appName' value='$appName'/><br>";
echo "<b>".__VERSION_LG." </b> <input type='text' name='appVersion' value='$appVersion'/><br>";
echo "<b>".__OS_LG." </b><input type='text' name='OS' value='$OS'/><br>";
echo "<b>".__ADDAPP_DEVELOPER_LG."</b><input type='text' name='appDeveloper' value='$appDeveloper'/><br>";
echo "<b>".__SIZE_LG." </b><input type='text' name='appSize' value='$appSize'/><br>";
echo "<br>";
//dbClass::db_set_rating($section, $rate, $fixipPerm, $itemid, $link, $rate_lg, $votes_lg);

/*
// like widgets (vk.com, facebook.com, g+) block
echo "<div id='vk_like'><script type='text/javascript'>VK.Widgets.Like('vk_like', {type: 'mini'});</script></div> <br>";
echo "<div style='margin-left:10px;'>
	<!-- Place this tag where you want the +1 button to render. -->
	<div class='g-plusone' ></div>

	<!-- Place this tag after the last +1 button tag. -->
	<script type='text/javascript'>
  	(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  	})();
	</script>
	</div>
		<br>";
echo "<div class='fb-like' data-send='true' data-layout='button_count' data-width='450' data-show-faces='true' data-font='lucida grande'></div> <br>";
*/

echo "</div>";

// QR-code and dowload link block
echo "<div style='float: left; margin-top: 20px; margin-left:5px; margin-right:5px; '>";
echo "<b>".__QRCODE_LG.":</b><br>";
include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/qr_".$itemid_wl.".php";
echo "<br><br>";

echo "<a href='"; include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/downloadlink_".$itemid_wl.".php"; echo "'> <b>DOWNLOAD</b> </a>";
echo "<br><br>";


	echo  "General link(Put URL to copy as is	): <br><input type='text' name='editdownloadlink' /><br>";


if (file_exists($appPath.'/olddownloadlink_'.$itemid_wl.'.php')) 
{
	$oldDownloadingLink=file_get_contents($appPath.'/olddownloadlink_'.$itemid_wl.'.php');
	echo  "Additional links: <br><textarea name='olddownloadlink'>".$oldDownloadingLink."</textarea>";
}
echo "<br><br>";

echo "<div >";
echo "Download file using URL:<br><input id='checkText_downloadFile' type='checkbox' name='mainScrnsht' onclick='checkActivity(\"checkText_downloadFile\",\"changeText_downloadFile\")'>";
echo "<input id='changeText_downloadFile' type='text' name='appDownloadingLink' disabled>";
echo "<br>";
echo "or upload file:<br><input id='checkFile_downloadFile' type='checkbox' name='' onclick='checkActivity(\"checkFile_downloadFile\",\"changeFile_downloadFile\")'>";
echo "<input id='changeFile_downloadFile' type='file' name='appDownloadingLink' disabled>";
echo "</div>";
echo "<input type='radio' name='driveFile' value='overwriteFile' checked/> Overwrite existing file";
echo "<input type='radio' name='driveFile' value='additionalFile'/> Add as an additional file";

echo "</div>";

//echo "<b>".$AuthorName_lg."</b>&nbsp".$rall[0].";&nbsp&nbsp<b>".$postDate_lg."</b>&nbsp".$rall[1];
echo "<br><br>";

// Description block
echo "<div style='position: relative; clear: both; top: 20px;'>";
echo "<h3>Description</h3>";
echo "<br><textarea name='description' style='max-width: 660px; min-width:660px; min-height: 300px;'>".$Description."</textarea>
		<script type='text/javascript'>
			CKEDITOR.replace('description');
		</script>";
echo "<br></div>";

//Screenshots block
echo "<div style='position: relative; clear: both; top: 20px;'>";
echo "<h3>Screenshots</h3>";
echo "<div id='scrnShts'>";


echo "</div>";
for ($i=1; $i<=5; $i++)
{
	echo "<div style='float: left; padding: 5px 5px;'>";
	include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/screenshots/screenshots_".$i."_".$itemid_wl.".php";
	echo "<br><b>screenshot #$i</b><br>";
	echo "Change screenshot #$i using URL:<br><input id='checkText_Scrnsht_$i' type='checkbox' name='Scrnsht_$i' onclick='checkActivity(\"checkText_Scrnsht_$i\",\"changeText_Scrnsht_$i\")'>";
	echo "<input id='changeText_Scrnsht_$i' type='text' name='screenshot_$i'  disabled>";
	echo "<br>";
	echo "or upload image file:<br><input id='checkFile_Scrnsht_$i' type='checkbox' name='Scrnsht_$i' onclick='checkActivity(\"checkFile_Scrnsht_$i\",\"changeFile_Scrnsht_$i\")'>";
	echo "<input id='changeFile_Scrnsht_$i' type='file' name='screenshot_$i'  disabled>";
	echo "</div>";
}
echo "<br style='clear: both;'><br>";
echo "</div>";
echo "<input type='hidden' name='itemid' value='".$itemid."'/>";
echo "<br><hr style='height: 3px; border: 0px; background-color:black;'>
	  <br><input type='submit' name='save' value='Save changes'/>";

echo "</form>";

//Messages block
$mesPath=__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl."/";
$mesBufferPath=__DOCUMENT_ROOT_PATH."messages/app_mes_files/";

echo "<div style='position: relative; clear: both; top: 20px;'>";
echo "<h3>Comments</h3>";
echo "<br>";
messagesClass::messages($itemTitle, $mesPath, $mesBufferPath, $itemid_wl);
echo "</div>";

?>