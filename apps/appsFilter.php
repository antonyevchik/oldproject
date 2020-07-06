<?php
require_once '../constans.php';
echo "<script type='text/javascript' src='".__ROOT_PATH."ckeditor/ckeditor.js'></script>";
echo "<script src='".__ROOT_PATH."jQuery/jquery-2.1.1.js'></script>";
//if(!include (__DOCUMENT_ROOT_PATH."phpqrcode/qrlib.php")) die ("ERROR: qr code inclusion error"); //QRcode library including
if(!include(__DOCUMENT_ROOT_PATH."classes/dbase/dbClass.php")) die ("apps/appsFilter.php: dbClass.php file inclusion error");
$dbObject=new dbClass;


if (!empty($_POST['post'])&&!empty($_POST['filename']))
{
	$dbase='aldb';
	$section='apps';
	$tableRow=array('0','0','0','0','0','0','0','0','0','0','0','0','0');
	$filename=__DOCUMENT_ROOT_PATH.'apps/appsBuffer/'.$_POST['filename'];
	$mId='manualId_'.$_POST['filename'];
	$manualId=$_POST[$mId];

	$fileName=$_POST['filename'];
	$Description=$_POST['editorContent_'.$fileName];
	$authorName=$_POST['authorName'];
	$date=$_POST['date'];
	$authorEmail=$_POST['authorEmail'];
	$appsCategory=$_POST['appsCategory'];
	
	if(!empty($_POST['addCat']))
	{
		$addCat=$_POST['addCat'];
		$cat_array[0]=$appsCategory;
		$cat_array[1]=$addCat;
		$appsCategory=implode(',', $cat_array);
		//echo "SUccess!";
	}
	
	$appName=$_POST['appName'];
	$appVersion=$_POST['appVersion'];
	$OS=$_POST['OS'];
	$appDeveloperLink=$_POST['appDeveloperLink'];
	if(!empty($appDeveloperLink))	$appDeveloper="<a href=\"".$appDeveloperLink."\">".$_POST['appDeveloper']."</a>";
	if(empty($appDeveloperLink))	$appDeveloper=$_POST['appDeveloper'];
	$appDownloadingLink=$_POST['appDownloadingLink'];
	$mainScreenshotLink=$_POST['mainScreenshotLink'];
	$appSize=$_POST['appSize'];
	$shortDescription=$_POST['shortDescription'];
	
	$tableRow[0]=$authorName;
	$tableRow[1]=$date;
	$tableRow[2]=$appName;
	$tableRow[3]=$appVersion;
	$tableRow[4]=$OS;
	$tableRow[5]=$appDeveloper;
	$tableRow[6]=$appSize;
	$tableRow[7]=0;
	$tableRow[8]=0;
	$tableRow[9]=0.0;
	$tableRow[10]=$shortDescription;
	$tableRow[11]=$Description;
	$tableRow[12]=$appsCategory;
	if (empty($manualId))	$tableRow[13]=$dbObject->db_idGenerator($_POST['language']);
	if (!empty($manualId))  $tableRow[13]=$dbObject->db_idGenerator($_POST['language'],$manualId);
	$Id=$tableRow[13];
	for ($j=0;$j<sizeof($langs_array);$j++) {$replaceNeedle[$j]="_".$langs_array[$j];}
	$Id_wl=str_replace($replaceNeedle, '', $Id);  // id without language tail ('_en' or '_ru')
	
	//echo $Id_wl."TEST";
	$dbObject->db_insert_into_table($section, $category, $tableRow);
	
	$appPath=__DOCUMENT_ROOT_PATH."apps/appstore/".$Id_wl;
	$appPath_HTML=__ROOT_PATH."apps/appstore/".$Id_wl;
	
	mkdir($appPath);
	mkdir($appPath."/screenshots");
	$mainScreenshotLinkInfo=pathinfo($mainScreenshotLink);
	//$mainScreenshotLinkExten=".".$mainScreenshotLinkInfo['extension'];
	$mainScreenshotLinkExten="";
	copy($mainScreenshotLink, $appPath."/screenshots/mainScrnsht_".$Id_wl.$mainScreenshotLinkExten);
	
	$mscrnshtSize=getimagesize($appPath."/screenshots/mainScrnsht_".$Id_wl.$mainScreenshotLinkExten);
	if($mscrnshtSize[0]>$mscrnshtSize[1]) $idname="scrnshtSetWidth";
	if($mscrnshtSize[0]<=$mscrnshtSize[1]) $idname="scrnshtSetHeight";
	$mScrnsht="<img border='0' id='".$idname."' src='".$appPath_HTML."/screenshots/mainScrnsht_".$Id_wl.$mainScreenshotLinkExten."' />";
	
	$fo_mScrnsht = fopen($appPath."/screenshots/mScrnsht_".$Id_wl.".php","w") or die("appsFilter.php: file mScrnsht_".$Id_wl.".php was not created!");
	$fw_mScrnsht=fwrite($fo_mScrnsht,$mScrnsht);
	flock($fo_mScrnsht,LOCK_UN);
	fclose($fo_mScrnsht);
	
	$scrnshts='';
	for($i=1;$i<=5;$i++)
	{
		if(!empty($_POST["screenshot_$i"]))
		{
			$scrnshtLinkInfo=pathinfo($_POST["screenshot_$i"]);
			//$scrnshtLinkExten=".".$scrnshtLinkInfo['extension'];
			$scrnshtLinkExten="";
			$scrnshtPath=$appPath_HTML."/screenshots/screenshot_".$i."_".$Id_wl.$scrnshtLinkExten;
			
			copy($_POST["screenshot_$i"], $appPath."/screenshots/screenshot_".$i."_".$Id_wl.$scrnshtLinkExten);
			
			//$scrnshtSize=getimagesize($scrnshtPath); 
			//if($scrnshtSize[0]>$scrnshtSize[1]) $Id_wlname="scrnshtSetWidth";
			//if($scrnshtSize[0]<$scrnshtSize[1]) $Id_wlname="scrnshtSetHeight";
			$scrnshts="<img border='0'  src='".$scrnshtPath."' />";
			
			$fo_scrnshts = fopen($appPath."/screenshots/screenshots_".$i."_".$Id_wl.".php","w") or die("appsFilter.php: file screenshots_".$Id_wl.".php could not be created!");
			$fw_scrnshts=fwrite($fo_scrnshts,$scrnshts);
			flock($fo_scrnshts,LOCK_UN);
			fclose($fo_scrnshts);
		//			$scrnshtLinks[$i]=$_POST["screenshot_$i"];
		//			echo $scrnshtLinks[$i];
		}
	}
		
	if(!empty($appDownloadingLink))
	{
		$appPathInfo=pathinfo($appDownloadingLink);
		$appName=$appPathInfo['basename'];
		
		if (!empty($_POST['check_put_downld_lnk']))
		{
			$pathToFile=$appDownloadingLink;
		}
		else 
		{
			copy($appDownloadingLink, $appPath."/".$appName);
			$pathToFile=$appPath_HTML."/".$appName;
		}
	
		
		$fo_dl=fopen($appPath.'/downloadlink_'.$Id_wl.'.php','w');
		$fw_dl=fwrite($fo_dl, $pathToFile);
		flock($fo_dl,LOCK_UN);
		fclose($fo_dl);
		
		$qr='<?php $fullappPath=file_get_contents(\''.$appPath.'/downloadlink_'.$Id_wl.'.php\'); $fullappPath=str_replace(" ","%20", $fullappPath); QRcode::png($fullappPath,\''.$appPath.'/qr_'.$Id_wl.'.png\',\'L\', 3,1);  echo "<a href=".$fullappPath."><img border=\'0\' src=\''.$appPath_HTML.'/qr_'.$Id_wl.'.png\' /></a>"; ?>';
		$fo_qr = fopen($appPath.'/qr_'.$Id_wl.'.php','w') or die("appsFilter.php: file qr_".$Id_wl.".php was not created!"); 
		$fw_qr=fwrite($fo_qr,$qr);
		flock($fo_qr,LOCK_UN);
		fclose($fo_qr);		
	}
	
//	$filename=$_POST['filename'];
//	unlink(__DOCUMENT_ROOT_PATH.'apps/appsBuffer/'.$fileName.".php");
}

if (!empty($_POST['delete'])&&!empty($_POST['filename']))
{
	$filename=$_POST['filename'];
	unlink(__DOCUMENT_ROOT_PATH.'apps/appsBuffer/'.$filename.".php");
}

include (__DOCUMENT_ROOT_PATH.'apps/appsBuffer.php');


if (!empty($_POST['submitClearBuffer'])&&$_POST['submitClearBuffer']=='true')
{
	$postBufferFile=fopen(__DOCUMENT_ROOT_PATH.'apps/appsBuffer.php','w') or die("appsFilter.php: appsBuffer.php opening file error");
	fwrite($postBufferFile, "");
	fclose($postBufferFile);
}

echo "<hr style='margin-top: 30px;'>
	  <form  name='clearBuffer' action='' method='post'>
	  <input type='hidden' name='submitClearBuffer'  value='true'>
	  <input type='submit'  value='CLEAR BUFFER'> 
	  </form>
	 ";

?>
