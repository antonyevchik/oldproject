<script type="text/javascript">

function getScrnshtAmnt()
{
	var scrnshtAmnt=document.getElementById('scrnshtAmount').value;
	var i;
	var s='';
	for(i=1;i<=scrnshtAmnt;i++)
	{
		s=s+i+')<input type=\'text\' name=\'screenshot_'+i+'\' size=\'30\' /><br>';
		document.getElementById('scrnshtsLines').innerHTML=s;
	}
}

</script>

<?php
echo "

<br><br>
<form id='addAppform' name='addAppform' method='post' action='../apps/?cnt=aprev&l=".$lg."'>
$userName_lg: <span style='color:red;'>*</span>

<input type='text' name='authorName' size='25' /> 
&nbsp e-mail:
<input id='authorEmail' type='text' size='20'/><br>
<br><br>
".__ADDAPP_APPSCATEGORY_LG."<span style='color:red;'>*</span>

<select name='appsCategory' >
	<option value='Books and Reference'>$BooksReference_lg</option>
	<option value='Business'>$Business_lg</option>
	<option value='Education and Science'>$EducationScience_lg</option>
	<option value='Entertainment'>$Entertainment_lg</option>
	<option value='Finance'>$Finance_lg</option>
	<option value='Health and Medicine'>$HealthMedicine_lg</option>
	<option value='Multimedia'>$Multimedia_lg</option>
	<option value='Office'>$Office_lg</option>
	<option value='Shopping'>$Shopping_lg</option>
	<option value='Social and Communication'>$SocialCommunication_lg</option>
	<option value='Tools'>$Tools_lg</option>
	<option value='Travel'>$Travel_lg</option>
	<option value='Viewers and Readers'>$ViewersReaders_lg</option>
	<option value='Wallpapers'>$Wallpapers_lg</option>
	<option value='Weather'>$Weather_lg</option>
	<option value='Widgets'>$Widgets_lg</option>
	<option value='Other'>$Other_lg</option>
	<option value='3D-games'>$ThreeDgames_lg</option>
	<option value='Arcade and Action'>$ArcadeAction_lg</option>
	<option value='Cards and Casino'>$CardsCasino_lg</option>
	<option value='Logic and Puzzle'>$LogicPuzzle_lg</option>
	<option value='Online'>$Online_lg</option>
	<option value='Sports Games'>$SportsGames_lg</option>
	<option value='Strategy'>$Strategy_lg</option>
	<option value='Shooting'>$Shooting_lg</option>
	<option value='Quests'>$Quests_lg</option>
</select>
<br><br>
<table>
<tr>
<td style='padding-left:0px; padding-right:10px;'>
".__ADDAPP_APPNAME_LG."<span style='color:red;'>*</span><br>
<input type='text' name='appName' size='30' />
<br><br>
".__ADDAPP_DOWNLOADINGLINK_LG."<span style='color:red;'>*</span><br>
<input type='text' name='appDownloadingLink' size='30' />
<br><br>
".__ADDAPP_APPSIZE_LG."<span style='color:red;'>*</span><br>
<input type='text' name='appSize' size='30' />
<br><br>
".__ADDAPP_MAINSCREENSHOTLINK_LG."<span style='color:red;'>*</span><br>
<input type='text' name='mainScreenshotLink' size='30' />
<br><br>
</td>
<td style='padding-left:0px; padding-right:10px;'>
".__ADDAPP_APPVERSION_LG."<span style='color:red;'>*</span><br>
<input type='text' name='appVersion' size='15' />
<br><br>
".__ADDAPP_OS_LG."<span style='color:red;'>*</span><br>
<input type='text' name='OS' size='30' />
<br><br>
".__ADDAPP_DEVELOPER_LG."<span style='color:red;'>*</span><br>
<input type='text' name='appDeveloper' size='30' />
<br><br>
".__ADDAPP_DEVELOPERLINK_LG."<br>
<input type='text' name='appDeveloperLink' size='30' />
<br><br>
</td>
</tr>
</table>
".__ADDAPP_OTHERSCREENSHOTSLINKS_LG."
<select id='scrnshtAmount' name='scrnshtAmount' onchange='getScrnshtAmnt()'>
	<option value='2'>2</option>
	<option value='3'>3</option>
	<option value='4'>4</option>
	<option value='5'>5</option>
</select>:<span style='color:red;'>*</span>
<div id='scrnshtsLines'>
	1)<input type='text' name='screenshot_1' size='30' /><br>
	2)<input type='text' name='screenshot_2' size='30' /><br>
</div>
<br>
		
<!--		
<table>
<tr>
<td style='padding-left:0px; padding-right:10px;'>
".__ADDAPP_FIRSTSCREENSHOTLINK_LG."<span style='color:red;'>*</span><br>
<input type='text' name='firstScreenshotLink' size='30' /><br>
".__ADDAPP_SECONDSCREENSHOTLINK_LG."<br>
<input type='text' name='secondScreenshotLink' size='30' /><br>
</td>
<td>
".__ADDAPP_THIRDSCREENSHOTLINK_LG."<br>
<input type='text' name='thirdScreenshotLink' size='30' /><br>
".__ADDAPP_FOURTHSCREENSHOTLINK_LG."<br>
<input type='text' name='fourthScreenshotLink' size='30' /><br>
</td>
</tr>
</table>
-->

".__SHORTDESCRIPTION_LG.":
<br>
<textarea name='shortDescription' cols='93' rows='5' style='max-width: 660px; min-width:660px; '></textarea>
<br><br>
".__DESCTRIPTION_LG.":<span style='color:red;'>*</span>
<textarea name='editorContent' id='editorContent' cols='45' rows='5'></textarea>
<script type='text/javascript'>
CKEDITOR.replace('editorContent');
</script>
<br>
<input type='submit' value='$Preview_lg'/>
</form>
";

?>