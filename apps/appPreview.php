<?php
if(!empty($_POST['authorName'])&&!empty($_POST['appName'])&&!empty($_POST['appVersion'])&&!empty($_POST['OS'])&&!empty($_POST['appDeveloper'])
		&&!empty($_POST['appDownloadingLink'])&&!empty($_POST['editorContent']))
{
	$authorName=$_POST['authorName'];
	$authorEmail=$_POST['authorEmail'];
	$appsCategory=$_POST['appsCategory'];
	$appName=$_POST['appName'];
	$appVersion=$_POST['appVersion'];
	$OS=$_POST['OS'];
	$appDeveloper=$_POST['appDeveloper'];
	$appDeveloperLink=$_POST['appDeveloperLink'];
	$appSize=$_POST['appSize'];
	$appDownloadingLink=$_POST['appDownloadingLink'];
	$mainScreenshotLink=$_POST['mainScreenshotLink'];
	$shortDescription=$_POST['shortDescription'];
	$editorContent=$_POST['editorContent'];
	$postDate=date('d.m.Y H:i');
//	$firstScreenshotLink=$_POST['firstScreenshotLink'];
	
	
	// main screenshot block
	echo "<br>";
	echo "<div style='float: left; margin-left:5px; margin-right:5px;'>";
	$mscrnshtSize=getimagesize($mainScreenshotLink);
	if($mscrnshtSize[0]>$mscrnshtSize[1]) $idname="scrnshtSetWidth";
	if($mscrnshtSize[0]<$mscrnshtSize[1]) $idname="scrnshtSetHeight";
	echo "<img border='0' id='$idname' src='".$mainScreenshotLink."'/>";
	//include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid."/screenshots/mScrnsht_".$itemid.".php";
	echo "</div>";
	
	// app info block
	echo "<div style='float: left; margin-left:5px; margin-right:5px;'>";
	echo "<h2>".$appName."</h2><br>";
	echo "<b>".__POSTEDBY_LG." </b>".$authorName."<br>";
	echo "<b>".$postDate_lg."</b><br> ".$postDate."<br><br>";
	echo "<b>".__VERSION_LG." </b>".$appVersion."<br>";
	echo "<b>".__OS_LG." </b>".$OS."<br>";
	echo "<b>".__ADDAPP_DEVELOPER_LG." </b><a href='".$appDeveloperLink."'>".$appDeveloper."</a><br>";
	echo "<b>".__SIZE_LG." </b>".$appSize."<br>";
	echo "<br>";
	echo "</div>";
	
	// QR-code and dowload link block
	if(!empty($appDownloadingLink))
	{
		$appPath=__DOCUMENT_ROOT_PATH."tmp";
		$appPath_HTML=__ROOT_PATH."tmp";
		$appPathInfo=pathinfo($appDownloadingLink);
		//$appName=$appPathInfo['basename'];
	
		//copy($appDownloadingLink, $appPath."/".$appName);
	
		$fo_dl=fopen($appPath.'/downloadlink_'.$appName.'.php','w');
		$fw_dl=fwrite($fo_dl, $appDownloadingLink);
		flock($fo_dl,LOCK_UN);
		fclose($fo_dl);
	
		$qr='<?php $fullappPath=file_get_contents(\''.$appPath.'/downloadlink_'.$appName.'.php\');  QRcode::png($fullappPath,\''.$appPath.'/qr_'.$appName.'.png\',\'L\', 3,1);  echo "<a href=".$fullappPath."><img border=\'0\' src=\''.$appPath_HTML.'/qr_'.$appName.'.png\' /></a>"; ?>';
		$fo_qr = fopen($appPath.'/qr_'.$appName.'.php','w') or die("appPreview.php: file qr_".$appName.".php was not created!");
		$fw_qr=fwrite($fo_qr,$qr);
		flock($fo_qr,LOCK_UN);
		fclose($fo_qr);
	}
	
	echo "<div style='float: left; margin-top: 20px; margin-left:5px; margin-right:5px; text-align: center;'>";
	echo "<b>".__QRCODE_LG.":</b><br>";
	include $appPath."/qr_".$appName.".php";
	echo "<br><br>";
	echo "<a href='"; include $appPath."/downloadlink_".$appName.".php"; echo "'> <b>DOWNLOAD</b> </a>";
	echo "<br><br>";
	//if(include $appPath."/olddownloadlink_".$appName.".php")
		echo "<br><br>";
	echo "</div>";
	
	// Description block
	echo "<div style='position: relative; clear: both; top: 20px;'>";
	echo "<h3>Description</h3>";
	echo "<div id='post_description_Content'>";
	echo $editorContent;
	echo "</div>";
	echo "</div>";
	
	//Screenshots block
	echo "<div style='position: relative; clear: both; top: 20px;'>";
	echo "<h3>Screenshots</h3>";
	echo "<br>";
	echo "<div id='ss_container'>";
	echo "<div id='slideshow'>";
	for ($i=1;$i<=5; $i++)
	{
		//echo "<br>";

		if(!empty($_POST["screenshot_$i"]))
		{
			$scrnshtSize=getimagesize($_POST["screenshot_$i"]); 
			if($scrnshtSize[0]>$scrnshtSize[1]) $idname="scrnshtSetWidth";
			if($scrnshtSize[0]<$scrnshtSize[1]) $idname="scrnshtSetHeight";
			$scrnshts="<img border='0' id='$idname' src='".$_POST["screenshot_$i"]."' />";
			echo $scrnshts;
		//include __DOCUMENT_ROOT_PATH."apps/appstore/".$itemid."/screenshots/mScrnsht_".$itemid.".php";
		
		}
	
		
		$filepath=__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid."/screenshots/screenshots_".$i."_".$itemid.".php";
		if (file_exists($filepath))
			include $filepath;
	}
	
	echo "</div>";
	echo "</div>";
	echo "</div>";
	
	
	$scrnshtLinks='';
	for($i=1;$i<=5;$i++)
	{
		if(!empty($_POST["screenshot_$i"]))
		{
			$scrnshtLinks=$scrnshtLinks."<input type='hidden' name='screenshot_$i' value='".$_POST["screenshot_$i"]."' />";
		}
	}
	echo "<br style='clear:both;'>";
	echo "<br>";
	echo "<br><hr style='height: 3px; border: 0px; background-color:black;'><br>";
	echo   "<input style='float: left;' type='button' onclick='history.back()' value='$editPost_lg'><br><br>";
	
	echo "<form style='float: left;' id='aprev' name='aprev' method='post' action='../apps/?cnt=asubm&l=".$lg."'>";
	echo recaptchaClass::recaptchaClass_recaptcha_get_html();
	echo "
	<input type='hidden' name='authorName' value='$authorName'/>
	<input type='hidden' name='authorEmail' value='$authorEmail'/>
	<input type='hidden' name='appsCategory' value='$appsCategory'/>
	<input type='hidden' name='appName' value='$appName'/>
	<input type='hidden' name='appVersion' value='$appVersion'/>
	<input type='hidden' name='OS' value='$OS'/>
	<input type='hidden' name='appDeveloper' value='$appDeveloper'/>
	<input type='hidden' name='appDeveloperLink' value='$appDeveloperLink'/>
	<input type='hidden' name='appDownloadingLink' value='$appDownloadingLink'/>
	<input type='hidden' name='mainScreenshotLink' value='$mainScreenshotLink'/>
	".$scrnshtLinks."
<!--	<input type='hidden' name='screenshotLinks' value='$scrnshtLinks'/>
	<input type='hidden' name='secondScreenshotLink' value='$secondScreenshotLink'/>
	<input type='hidden' name='thirdScreenshotLink' value='$thirdScreenshotLink'/>
	<input type='hidden' name='fourthScreenshotLink' value='$fourthScreenshotLink'/> -->
	<input type='hidden' name='appSize' value='$appSize'/>
	<input type='hidden' name='shortDescription' value='$shortDescription'/>
	<input type='hidden' name='editorContent' value='$editorContent'/>
	<input type='submit' value='$submitPost_lg'>
	</form>
	";
}
else echo "<br>".__REQUIRED_FIELDS_LG."<br><br><input type='button' onclick='history.back()' value='$editPost_lg'>";

?>