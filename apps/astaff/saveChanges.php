<?php

echo "<script type='text/javascript' src='../ckeditor/ckeditor.js'></script>";
if (!include '../../constans.php') die("apps/astaff/saveChanges.php: constans.php file inclusion error");
//if(!include (__DOCUMENT_ROOT_PATH."phpqrcode/qrlib.php")) die ("ERROR: qr code inclusion error"); //QRcode library including
if(!include(__DOCUMENT_ROOT_PATH."classes/dbase/dbClass.php")) die ("apps/astaff/saveChanges.php: dbClass.php file inclusion error");
$dbObject=new dbClass;


if (!empty($_POST['save'])&&!empty($_POST['itemid']))
{
	$dbase='aldb';
	$section='apps';
	$itemid=$_POST['itemid'];
	for ($j=0;$j<sizeof($langs_array);$j++) {$replaceNeedle[$j]="_".$langs_array[$j];}
	$itemid_wl=str_replace($replaceNeedle, '', $itemid);  // id without language tail ('_en' or '_ru')
	$appPath=__DOCUMENT_ROOT_PATH."apps/appstore/".$itemid_wl;
	$appPath_HTML=__ROOT_PATH."apps/appstore/".$itemid_wl;
	//$tableRow=array('0','0','0','0','0','0');
	$tableTitles=array('Name','Version','Android_Version','Developer','Size','Description');

	$tableRow="";
	if (!empty($_POST['appName'])) 			{	$tableRow="Name='".$_POST['appName']."',";						}
	if (!empty($_POST['appVersion'])) 		{	$tableRow=$tableRow."Version='".$_POST['appVersion']."',";		}
	if (!empty($_POST['OS'])) 				{	$tableRow=$tableRow."Android_Version='".$_POST['OS']."',";		}
	if (!empty($_POST['appDeveloper']))		{	$tableRow=$tableRow."Developer='".$_POST['appDeveloper']."',";	}	
	if (!empty($_POST['appSize']))        	{	$tableRow=$tableRow."Size='".$_POST['appSize']."',";			}
	if (!empty($_POST['description']))		{	$tableRow=$tableRow."Description='".$_POST['description']."'";	}
	
	
	if (!empty($_POST['olddownloadlink']))
	{
		$fo_odl=fopen($appPath.'/olddownloadlink_'.$itemid_wl.'.php','w');
		$fw_odl=fwrite($fo_odl, str_replace("\'", "'", $_POST['olddownloadlink']));
		flock($fo_odl,LOCK_UN);
		fclose($fo_odl);
	}
	
	if (!empty($_POST['appDownloadingLink']))	
	{
		$appPathInfo=pathinfo($_POST['appDownloadingLink']);
		$appName=$appPathInfo['basename'];
		//echo $appName;
		copy($_POST['appDownloadingLink'], $appPath."/".$appName);
	}
	if (!empty($_FILES['appDownloadingLink']))
	{
		$appName=$_FILES['appDownloadingLink']['name'];
		move_uploaded_file($_FILES['appDownloadingLink']['tmp_name'], $appPath."/".$appName);
	}	
	if (!empty($_POST['appDownloadingLink'])||!empty($_FILES['appDownloadingLink']))
	{	
		if ($_POST['driveFile']=='overwriteFile')
		{
			$oldDownloadLink=file_get_contents($appPath.'/downloadlink_'.$itemid_wl.'.php');
			unlink($oldDownloadLink);
		}
		if ($_POST['driveFile']=='additionalFile')
		{
			$oldDownloadLink=file_get_contents($appPath.'/downloadlink_'.$itemid_wl.'.php');
			$oldFileInfo=pathinfo($oldDownloadLink);
			$oldappName=$oldFileInfo['basename'];
			$fo_odl=fopen($appPath.'/olddownloadlink_'.$itemid_wl.'.php','a');
			$fw_odl=fwrite($fo_odl, "<a href='".$oldDownloadLink."'>".$oldappName."</a><br>\n");
			flock($fo_odl,LOCK_UN);
			fclose($fo_odl);
		}
		
		$fo_dl=fopen($appPath.'/downloadlink_'.$itemid_wl.'.php','w');
		$fw_dl=fwrite($fo_dl, $appPath_HTML."/".$appName);
		flock($fo_dl,LOCK_UN);
		fclose($fo_dl);
	
		$qr='<?php $fullappPath=file_get_contents(\''.$appPath.'/downloadlink_'.$itemid_wl.'.php\'); $fullappPath=str_replace(" ","%20", $fullappPath);  QRcode::png($fullappPath,\''.$appPath.'/qr_'.$itemid_wl.'.png\',\'L\', 3,1);  echo "<a href=".$fullappPath."><img border=\'0\' src=\''.$appPath_HTML.'/qr_'.$itemid_wl.'.png\' /></a>"; ?>';
		$fo_qr = fopen($appPath.'/qr_'.$itemid_wl.'.php','w') or die("appsFilter.php: file qr_".$itemid_wl.".php was not created!");
		$fw_qr=fwrite($fo_qr,$qr);
		flock($fo_qr,LOCK_UN);
		fclose($fo_qr);
	}
	
	if (!empty($_POST['editdownloadlink']))
	{
		$putAppURL=$_POST['editdownloadlink'];
		$fo_dl=fopen($appPath.'/downloadlink_'.$itemid_wl.'.php','w');
		$fw_dl=fwrite($fo_dl, $putAppURL);
		flock($fo_dl,LOCK_UN);
		fclose($fo_dl);
	}
	
	

	/*
	$tableRow[0]=$appName;
	$tableRow[1]=$appVersion;
	$tableRow[2]=$OS;
	$tableRow[3]=$appDeveloper;
	$tableRow[4]=$appSize;
	$tableRow[5]=$Description;
	*/
	$dbObject->db_update_item_info($section, $itemid, $tableTitles, $tableRow);

	

//	mkdir($appPath);
//	mkdir($appPath."/screenshots");
	if(!empty($_POST['mainScreenshotLink'])||$_FILES['mainScreenshotLink']['name'])
	{
	if (!empty($_POST['mainScreenshotLink']))   
	{
		$mainScreenshotLink=$_POST['mainScreenshotLink'];
		$mainScreenshotLinkInfo=pathinfo($mainScreenshotLink);
		//$mainScreenshotLinkExten=".".$mainScreenshotLinkInfo['extension'];
		$mainScreenshotLinkExten="";
		copy($mainScreenshotLink, $appPath."/screenshots/mainScrnsht_".$itemid_wl.$mainScreenshotLinkExten);	
	}
	if ($_FILES['mainScreenshotLink']['name']) 	
	{ 
		$mainScreenshotLink=$_FILES['mainScreenshotLink']['name'];
		$mainScreenshotLinkInfo=pathinfo($mainScreenshotLink);
		//$mainScreenshotLinkExten=".".$mainScreenshotLinkInfo['extension'];
		$mainScreenshotLinkExten="";
		move_uploaded_file($_FILES['mainScreenshotLink']['tmp_name'], $appPath."/screenshots/mainScrnsht_".$itemid_wl.$mainScreenshotLinkExten); 
	}
	$mscrnshtSize=getimagesize($appPath."/screenshots/mainScrnsht_".$itemid_wl.$mainScreenshotLinkExten);
	if($mscrnshtSize[0]>$mscrnshtSize[1]) $idname="scrnshtSetWidth";
	if($mscrnshtSize[0]<=$mscrnshtSize[1]) $idname="scrnshtSetHeight";
	$mScrnsht="<img border='0' id='".$idname."'  src='".$appPath_HTML."/screenshots/mainScrnsht_".$itemid_wl.$mainScreenshotLinkExten."' />";

	$fo_mScrnsht = fopen($appPath."/screenshots/mScrnsht_".$itemid_wl.".php","w") or die("apps/astaff/saveChanges.php: file mScrnsht_".$itemid_wl.".php was not created!");
	$fw_mScrnsht=fwrite($fo_mScrnsht,$mScrnsht);
	flock($fo_mScrnsht,LOCK_UN);
	fclose($fo_mScrnsht);
	}
	
	echo "TEST02";
	$scrnshts='';
	for($i=1;$i<=5;$i++)
	{
		echo "TEST0";
		if (!empty($_POST["screenshot_$i"])||$_FILES["screenshot_$i"]["name"])
		{
			if(!empty($_POST["screenshot_$i"])) 
			{ 
				$scrnshtLinkInfo=pathinfo($_POST["screenshot_$i"]);
				//$scrnshtLinkExten=".".$scrnshtLinkInfo['extension'];
				$scrnshtLinkExten="";
				$scrnshtPath=$appPath_HTML."/screenshots/screenshot_".$i."_".$itemid_wl.$scrnshtLinkExten;
				//$scrnshtPath_HTML=$appPath_HTML."/screenshots/screenshot_".$i."_".$itemid_wl.".".$scrnshtLinkInfo['extension'];
				copy($_POST["screenshot_$i"], $appPath."/screenshots/screenshot_".$i."_".$itemid_wl.$scrnshtLinkExten); 
			}	
			if($_FILES["screenshot_$i"]["name"]) 
			{ 
				echo "TEST1";
				$scrnshtLinkInfo=pathinfo($_FILES["screenshot_$i"]["name"]);
				//$scrnshtLinkExten=".".$scrnshtLinkInfo['extension'];
				$scrnshtLinkExten="";
				$scrnshtPath=$appPath_HTML."/screenshots/screenshot_".$i."_".$itemid_wl.$scrnshtLinkExten;
				//$scrnshtPath_HTML=$appPath_HTML."/screenshots/screenshot_".$i."_".$itemid_wl.".".$scrnshtLinkInfo['extension'];
				move_uploaded_file($_FILES["screenshot_$i"]["tmp_name"], $appPath."/screenshots/screenshot_".$i."_".$itemid_wl); 
			}
		
			//$scrnshtPath=$appPath."/screenshots/screenshot_".$i."_".$itemid_wl;
			//$scrnshtPath_HTML=$appPath_HTML."/screenshots/screenshot_".$i."_".$itemid_wl;
			//$scrnshtSize=getimagesize($scrnshtPath); 
			//if($scrnshtSize[0]>$scrnshtSize[1]) $idname="scrnshtSetWidth";
			//if($scrnshtSize[0]<$scrnshtSize[1]) $idname="scrnshtSetHeight";
			$scrnshts="<img border='0'  src='".$scrnshtPath."' />";
			
			$fo_scrnshts = fopen($appPath."/screenshots/screenshots_".$i."_".$itemid_wl.".php","w") or die("apps/astaff/saveChanges.php: file screenshots_".$itemid_wl.".php could not be created!");
			$fw_scrnshts=fwrite($fo_scrnshts,$scrnshts);
			flock($fo_scrnshts,LOCK_UN);
			fclose($fo_scrnshts);
		}
	}
	



	//	copy($firstScreenshotLink, __DOCUMENT_ROOT_PATH."apps/appstore/".$Id."/screenshots/firstScrnsht_".$Id);
	//	copy($secondScreenshotLink, __DOCUMENT_ROOT_PATH."apps/appstore/".$Id."/screenshots/secondScrnsht_".$Id);
	//	copy($thirdScreenshotLink, __DOCUMENT_ROOT_PATH."apps/appstore/".$Id."/screenshots/thirdScrnsht_".$Id);
	//	copy($fourthScreenshotLink, __DOCUMENT_ROOT_PATH."apps/appstore/".$Id."/screenshots/fourthScrnsht_".$Id);



	/*
	 $scrnshts = "<?php echo \"
	<img border='0' style='width: ".$fisWidth."; height: ".$fisHeight.";' src='".$afPath."/".$firstScreenshot."' /><img border='0' style='width: ".$sesWidth."; height: ".$sesHeight.";' src='".$afPath."/".$secondScreenshot."' /><br>
	<img border='0' style='width: ".$thsWidth."; height: ".$thsHeight.";' src='".$afPath."/".$thirdScreenshot."' /><img border='0' style='width: ".$fosWidth."; height: ".$fosHeight.";' src='".$afPath."/".$fourthScreenshot."' /><br>
	\";?>";
	
	$fo_scrnshts = fopen($appPath."/screenshots/screenshots_".$Id.".php","a") or die("appsFilter.php: file screenshots_".$Id.".php could not be created!");
	$fw_scrnshts=fwrite($fo_scrnshts,$scrnshts);
	flock($fo_scrnshts,LOCK_UN);
	fclose($fo_scrnshts);


	if(!empty($appDownloadingLink))
	{
		$appPathInfo=pathinfo($appDownloadingLink);
		$appName=$appPathInfo['basename'];

		copy($appDownloadingLink, $appPath."/".$appName);

		$fo_dl=fopen($appPath.'/downloadlink_'.$Id.'.php','a');
		$fw_dl=fwrite($fo_dl, $appPath."/".$appName);
		flock($fo_dl,LOCK_UN);
		fclose($fo_dl);

		$qr='<?php $fullappPath=file_get_contents(\''.$appPath.'/downloadlink_'.$Id.'.php\');  QRcode::png($fullappPath,\''.$appPath.'/qr_'.$Id.'.png\',\'L\', 3,1);  echo "<a href=".$fullappPath."><img border=\'0\' src=\''.$appPath_HTML.'/qr_'.$Id.'.png\' /></a>"; ?>';
		$fo_qr = fopen($appPath.'/qr_'.$Id.'.php','a') or die("appsFilter.php: file qr_".$Id.".php was not created!");
		$fw_qr=fwrite($fo_qr,$qr);
		flock($fo_qr,LOCK_UN);
		fclose($fo_qr);
	}
*/
	//	$filename=$_POST['filename'];
//	unlink(__DOCUMENT_ROOT_PATH.'apps/appsBuffer/'.$fileName.".php");

}

/*
if (!empty($_POST['delete'])&&!empty($_POST['filename']))
{
	$filename=$_POST['filename'];
	unlink(__DOCUMENT_ROOT_PATH.'apps/appsBuffer/'.$filename.".php");
}

include (__DOCUMENT_ROOT_PATH.'apps/appsBuffer.php');
*/


?>