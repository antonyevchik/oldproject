<?php

//$recaptcha_answer='false';
$recaptcha_answer=recaptchaClass::recaptchaClass_recaptcha_check_answer();
//echo $recaptcha_answer;
if ($recaptcha_answer=='true')
{

echo "<br>".$afterSubmitMes_lg;
echo "<br><br><input type='button' onclick='history.go(-3)' value='".__BUT_BACK_LG."'>";

if(!empty($_POST['authorName'])&&!empty($_POST['appName'])&&!empty($_POST['appVersion'])&&!empty($_POST['OS'])&&!empty($_POST['appDeveloper'])
		&&!empty($_POST['appDownloadingLink'])&&!empty($_POST['editorContent']))
{
	
	
			
	//	$fileName=str_replace(" ", "_",substr($_POST['appName'],0,15))."_".date('dmHis');
	//	$date=date('Y.m.d');
		
		//$setForm=
		


	$category=$_POST['blogCategory'];

	$authorName=$_POST['authorName'];
	$date=date('d.m.Y H:i');
	if($_POST['authorEmail']) $authorEmail=$_POST['authorEmail'];
	$appsCategory=$_POST['appsCategory'];
	$appName=$_POST['appName'];
	$appVersion=$_POST['appVersion'];
	$OS=$_POST['OS'];
	$appDeveloperLink=$_POST['appDeveloperLink'];
	$appDeveloper=$_POST['appDeveloper'];
	
	$appDownloadingLink=$_POST['appDownloadingLink'];
	$mainScreenshotLink=$_POST['mainScreenshotLink'];
//	$scrnshtLinks=array('0','0','0','0','0');
	$scrnshtLinks='';
	for($i=1;$i<=5;$i++)
	{
		if(!empty($_POST["screenshot_$i"]))
		{
			$scrnshtLinks=$scrnshtLinks."Screenshot $i: <img style='height:100px; width: auto;' src='".$_POST["screenshot_$i"]."'/><input type='text' name='screenshot_$i' value='".$_POST["screenshot_$i"]."' /><br>";
//			$scrnshtLinks[$i]=$_POST["screenshot_$i"];
	//			echo $scrnshtLinks[$i];
		}
	
	}

/*
	$screenshotLinks=$_POST['screenshotLinks'];
	echo $screenshotLinks[0];
	for ($i=0;$i<$_POST['screenshotLinks'];$i++)
	{
		echo $screenshotLinks[$i]."SDFF";
		//$screenshots=$screenshots."<input type='text' name='screenshot_$i' value='".$screenshotLinks[$i]."' /><br>";
	}
*/	
//	$secondScreenshotLink=$_POST['secondScreenshotLink'];
//	$thirdScreenshotLink=$_POST['thirdScreenshotLink'];
//	$fourthScreenshotLink=$_POST['fourthScreenshotLink'];
	if($_POST['appSize'])  $appSize=$_POST['appSize'];
	if($_POST['shortDescription']) $shortDescription=$_POST['shortDescription'];
	if($_POST['editorContent']) $Description=str_replace("'", "\'", $_POST['editorContent']);
	
	/*
	$Description="
				<textarea name='editorContent' id='editorContent' cols='45' rows='5'>
					".$_POST['editorContent']."
				</textarea>
				<script type='text/javascript'>
					CKEDITOR.replace('editorContent');
				</script>
				 ";
	*/
	
	if($_POST['appsCategory']=='Books and Reference') {$BooksReference='selected';}
	if($_POST['appsCategory']=='Business') {$Business='selected';}
	if($_POST['appsCategory']=='Education and Science') {$EducationScience='selected';}
	if($_POST['appsCategory']=='Entertainment') {$Entertainment='selected';}
	if($_POST['appsCategory']=='Finance') {$Finance='selected';}
	if($_POST['appsCategory']=='Health and Medicine') {$HealthMedicine='selected';}
	if($_POST['appsCategory']=='Multimedia') {$Multimedia='selected';}
	if($_POST['appsCategory']=='Office') {$Office='selected';}
	if($_POST['appsCategory']=='Shopping') {$Shopping='selected';}
	if($_POST['appsCategory']=='Social and Communication') {$SocialCommunication='selected';}
	if($_POST['appsCategory']=='Tools') {$Tools='selected';}
	if($_POST['appsCategory']=='Travel') {$Travel='selected';}
	if($_POST['appsCategory']=='Viewers and Readers') {$ViewersReaders='selected';}
	if($_POST['appsCategory']=='Wallpapers') {$Wallpapers='selected';}
	if($_POST['appsCategory']=='Weather') {$Weather='selected';}
	if($_POST['appsCategory']=='Widgets') {$Widgets='selected';}
	if($_POST['appsCategory']=='Other') {$Other='selected';}
	if($_POST['appsCategory']=='3D-games') {$ThreeDgames='selected';}
	if($_POST['appsCategory']=='Arcade and Action') {$ArcadeAction='selected';}
	if($_POST['appsCategory']=='Cards and Casino') {$CardsCasino='selected';}
	if($_POST['appsCategory']=='Logic and Puzzle') {$LogicPuzzle='selected';}
	if($_POST['appsCategory']=='Online') {$Online='selected';}
	if($_POST['appsCategory']=='Sports Games') {$SportsGames='selected';}
	if($_POST['appsCategory']=='Strategy') {$Strategy='selected';}
	if($_POST['appsCategory']=='Shooting') {$Shooting='selected';}
	if($_POST['appsCategory']=='Quests') {$Quests='selected';}
	


	
	$fileName=str_replace(" ", "_",substr($appName,0,15))."_".date("dmHis");	

/*	
	function setForm($fileName)
	{
		global $htmRP,$authorName,$authorEmail,$appName,$appVersion,$OS,$appDeveloper,$appDeveloperLink,$appSize,$appDownloadingLink,$date,
				$mainScreenshotLink,$scrnshtLinks,$shortDescription,$Description,$BooksReference,$BooksReference_lg,$Business,$Business_lg,$EducationScience,$EducationScience_lg,
				$Entertainment,$Entertainment_lg,$Finance,$Finance_lg,$HealthMedicine,$HealthMedicine_lg,$Multimedia,$Multimedia_lg,$Office,$Office_lg,$Shopping,$Shopping_lg,
				$SocialCommunication,$SocialCommunication_lg,$Tools,$Tools_lg,$Travel,$Travel_lg,$ViewersReaders,$ViewersReaders_lg,$Wallpapers,$Wallpapers_lg,$Weather,$Weather_lg,
				$Widgets,$Widgets_lg,$Other,$Other_lg,$ThreeDgames,$ThreeDgames_lg,$ArcadeAction,$ArcadeAction_lg,$CardsCasino,$CardsCasino_lg,$LogicPuzzle,$LogicPuzzle_lg,
				$Online,$Online_lg,$SportsGames,$SportsGames_lg,$Strategy,$Strategy_lg,$Shooting,$Shooting_lg,$Quests,$Quests_lg;
		*/
		$postContent = 
		 '
		<!--	<script>
				$(window).load(function(){
				$("#additionalForm_'.$fileName.'").hide();
					$("#addFormCheckbox_'.$fileName.'").click(function(){
						$("#additionalForm_'.$fileName.'").toggle();
					})
				});
			</script> -->
		<!--
			<script>
				function checkManualId_'.$fileName.'() { var x = document.getElementById(\'miCheck_'.$fileName.'\').checked; document.getElementById(\'manualId_'.$fileName.'\').disabled=!x; }
					</script> -->
					<br>
					<div style=\'width: 1000px; margin-right: auto; margin-left: auto;\'>
	
					<br><br>
					<form style=\' clear:both;\' action=\''.$htmRP.'apps/appsFilter.php\' method=\'post\'>
					<input type=\'hidden\' name=\'filename\' value=\''.$fileName.'\' />
					Author name:<input type=\'text\' name=\'authorName\' value=\''.$authorName.'\' />
					<input type=\'hidden\' name=\'date\' value=\''.$date.'\' />
					Author e-mail:<input type=\'text\' name=\'authorEmail\' value=\''.$authorEmail.'\' /><br>
					Application name:<input type=\'text\' name=\'appName\' value=\''.$appName.'\' />
					Application version:<input type=\'text\' name=\'appVersion\' value=\''.$appVersion.'\' />
					OS:<input type=\'text\' name=\'OS\' value=\''.$OS.'\' /><br>
					Developer:<input type=\'text\' name=\'appDeveloper\' value=\''.$appDeveloper.'\' />
					Developer link:<input type=\'text\' name=\'appDeveloperLink\' value=\''.$appDeveloperLink.'\' /><br>
					Size:<input type=\'text\' name=\'appSize\' value=\''.$appSize.'\' />
					Downloading link:<input type=\'text\' name=\'appDownloadingLink\' value=\''.$appDownloadingLink.'\' />
					Just put downloading link (do not upload file):	<input type=\'checkbox\' name=\'check_put_downld_lnk\' value=\'put_downld_lnk\'/> <br>
					Date:<input type=\'text\' name=\'date\' value=\''.$date.'\' disabled /><br><br>
					Main Screenshot:<input type=\'text\' name=\'mainScreenshotLink\' value=\''.$mainScreenshotLink.'\' /><br>
					'.$scrnshtLinks.'
					<br><br>
					Short description:<br><textarea name=\'shortDescription\' cols=\'45\' rows=\'5\' />'.$shortDescription.'</textarea><br><br>
					Description:<textarea name=\'editorContent_'.$fileName.'\' cols=\'45\' rows=\'5\'>'.$Description.'</textarea>
					<script type=\'text/javascript\'> CKEDITOR.replace(\'editorContent_'.$fileName.'\');</script><br>
	
					Enter manual Id if needed (for example: idn_1234_en):
				  	<!--	<input id=\'miCheck_'.$fileName.'\' type=\'checkbox\' name=\'manualIdcheck_'.$fileName.'\' onclick=\'checkManualId_'.$fileName.'()\'/> -->
				  		<input id=\'manualId_'.$fileName.'\' type=\'text\' name=\'manualId_'.$fileName.'\' size=\'20\' /><br>
				 		Select the language of post:
					 		<select name=\'language\'>
					 		<option value=\'en\'>English</option>
					 		<option value=\'ru\'>Russian</option>
					 		</select>
					 		<br>
					 		<select name=\'appsCategory\' >
								<option value=\'Books and Reference\' '.$BooksReference.'>'.$BooksReference_lg.'</option>
								<option value=\'Business\' '.$Business.'>'.$Business_lg.'</option>
								<option value=\'Education and Science\' '.$EducationScience.'>'.$EducationScience_lg.'</option>
								<option value=\'Entertainment\' '.$Entertainment.'>'.$Entertainment_lg.'</option>
								<option value=\'Finance\' '.$Finance.'>'.$Finance_lg.'</option>
								<option value=\'Health and Medicine\' '.$HealthMedicine.'>'.$HealthMedicine_lg.'</option>
								<option value=\'Multimedia\' '.$Multimedia.'>'.$Multimedia_lg.'</option>
								<option value=\'Office\' '.$Office.'>'.$Office_lg.'</option>
								<option value=\'Shopping\' '.$Shopping.'>'.$Shopping_lg.'</option>
								<option value=\'Social and Communication\' '.$SocialCommunication.'>'.$SocialCommunication_lg.'</option>
								<option value=\'Tools\' '.$Tools.'>'.$Tools_lg.'</option>
								<option value=\'Travel\' '.$Travel.'>'.$Travel_lg.'</option>
								<option value=\'Viewers and Readers\' '.$ViewersReaders.'>'.$ViewersReaders_lg.'</option>
								<option value=\'Wallpapers\' '.$Wallpapers.'>'.$Wallpapers_lg.'</option>
								<option value=\'Weather\' '.$Weather.'>'.$Weather_lg.'</option>
								<option value=\'Widgets\' '.$Widgets.'>'.$Widgets_lg.'</option>
								<option value=\'Other\' '.$Other.'>'.$Other_lg.'</option>
								<option value=\'3D-games\' '.$ThreeDgames.'>'.$ThreeDgames_lg.'</option>
								<option value=\'Arcade and Action\' '.$ArcadeAction.'>'.$ArcadeAction_lg.'</option>
								<option value=\'Cards and Casino\' '.$CardsCasino.'>'.$CardsCasino_lg.'</option>
								<option value=\'Logic and Puzzle\' '.$LogicPuzzle.'>'.$LogicPuzzle_lg.'</option>
								<option value=\'Online\' '.$Online.'>'.$Online_lg.'</option>
								<option value=\'Sports Games\' '.$SportsGames.'>'.$SportsGames_lg.'</option>
								<option value=\'Strategy\' '.$Strategy.'>'.$Strategy_lg.'</option>
								<option value=\'Shooting\' '.$Shooting.'>'.$Shooting_lg.'</option>
								<option value=\'Quests\' '.$Quests.'>'.$Quests_lg.'</option>
								</select><br>
								Additional Category (use , as a separator without space, for example: Books and Reference,Business,Education and Science,...):
								<input type=\'text\' name=\'addCat\' /><br>
								<br>
								<input type=\'submit\' name=\'post\' value=\'POST\'/>
								<input type=\'submit\' name=\'delete\' value=\'DELETE\'/>
						  </form>
						  <br>
					<!--	  <b>Add more forms:</b>	<input id=\'addFormCheckbox_'.$fileName.'\' type=\'checkbox\'/> -->
						  <hr style=\'height: 10px; border: 0px; background-color:black;\'>
			</div>
				<br>
	
									';
		/*			return $postForm;
		} */
	
	
	

	/*
	for ($k=0; $k<sizeof($langs_array)-1;$k++)
	{
		$addFormfileName=str_replace(" ", "_",substr($appName,0,15))."_".date("dmHis")."_".$k;
		$additionalForms=$additionalForms.setForm($addFormfileName);
	}
	$additionFormsCode='
			<div id=\'additionalForm_'.$fileName.'\'>'.$additionalForms.'</div>
	';
	*/
	//$postContent=setForm($fileName); //.$additionFormsCode;
	
	//$postForm=setForm();
	//$postAdditionalForm='';
	//$postContent=$postForm;



//	$Description=$_POST['editorContent']."";
	$postFile=fopen($rootPath.'apps/appsBuffer/'.$fileName.'.php','w') or die("apps/appsBuffer/$fileName: opening file error");
	fwrite($postFile, $postContent."\n");
	fclose($postFile);

	$postBufferContent='<?php include \''.$rootPath.'apps/appsBuffer/'.$fileName.'.php\' ?>';
	$postBufferFile=fopen($rootPath.'apps/appsBuffer.php','a') or die("appSubmitted.php: appsBuffer.php opening file error");
	fwrite($postBufferFile, $postBufferContent."\n");
	fclose($postBufferFile);
	
	// clear tmp derictory
	unlink(__DOCUMENT_ROOT_PATH."tmp/downloadlink_".$appName.".php");
	unlink(__DOCUMENT_ROOT_PATH."tmp/qr_".$appName.".php");
	unlink(__DOCUMENT_ROOT_PATH."tmp/qr_".$appName.".png");

}

}
else
{
	echo "<br>The reCAPTCHA wasn't entered correctly. Go back and try it again.<br><br><input type='button' onclick='history.go(-2)' value='$editPost_lg'>";
}

?>