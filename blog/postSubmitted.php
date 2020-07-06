
<?php

$recaptcha_answer=recaptchaClass::recaptchaClass_recaptcha_check_answer();
if ($recaptcha_answer=='true')
{

echo "<br>".$afterSubmitMes_lg;
echo "<br><br><input type='button' onclick='history.go(-3)' value='".__BUT_BACK_LG."'>";


if(!empty($_POST['authorName'])&&!empty($_POST['postTitle'])&&!empty($_POST['editorContent']))
{
	
	
	$category=$_POST['blogCategory'];
	
	if($category=='General') $General_sel='selected';
	if($category=='AndroidOS') $AndroidOS_sel='selected';
	if($category=='AndroidDevices') $AndroidDevices_sel='selected';
	if($category=='Developing') $Developing_sel='selected';
	if($category=='Games') $Games_sel='selected';
	if($category=='Applications') $Applications_sel='selected';

	$fileName=str_replace(" ", "_",substr($_POST['postTitle'],0,15))."_".date('dmHis');
	$authorName=$_POST['authorName'];
	$date=date('d.m.Y H:i');
	$postTitle=$_POST['postTitle'];
	$shortDescription=$_POST['shortDescription'];
	if($_POST['editorContent']) $Description=str_replace("'", "\'", $_POST['editorContent']);
	//$postFile=fopen($rootPath.'blog/postsBuffer/'.$fileName,'w') or die("postPreview.php: opening file error");
	
	$postContent='
			<script>
				function checkManualId_'.$fileName.'() { var x = document.getElementById(\'miCheck_'.$fileName.'\').checked; document.getElementById(\'manualId_'.$fileName.'\').disabled=!x; }
			</script>
			<br>
			<div style=\'width: 1000px; margin-right: auto; margin-left: auto;\'>
				<?php
				if(!empty($_POST[\'post\'])&&($_POST[\'filename\']==\''.$fileName.'\'))
					{$fp=fopen(\''.$rootPath.'blog/postsBuffer/'.$fileName.'\',\'a\'); fwrite($fp, \'<h1>POSTED</h1>\'); fclose($fp);}
				if($fileContent=file_get_contents(\''.$rootPath.'blog/postsBuffer/'.$fileName.'\'))
					{echo $fileContent;}
				?>
				<br>
					<form style=\' clear:both;\' action=\''.$htmRP.'blog/postsFilter.php\' method=\'post\'>
						<input type=\'hidden\' name=\'filename\' value=\''.$fileName.'\' />
						<input type=\'hidden\' name=\'authorName\' value=\''.$authorName.'\' />
						<input type=\'hidden\' name=\'date\' value=\''.$date.'\' />		
					<!--	<input type=\'hidden\' name=\'postTitle\' value=\''.$postTitle.'\' />  -->
						<input type=\'hidden\' name=\'shortDescription\' value=\''.$shortDescription.'\' />

						Title: <input type=\'text\' name=\'postTitle\' size=\'70\' value=\''.$postTitle.'\'  /><br><br>
						Author Name: <b>'.$authorName.'</b><br><br>
								
						Post Content:<textarea name=\'editorContent_'.$fileName.'\' cols=\'45\' rows=\'5\'>'.$Description.'</textarea>
						<script type=\'text/javascript\'> CKEDITOR.replace(\'editorContent_'.$fileName.'\');</script><br>
								
				  <!--  <input type=\'hidden\' name=\'category\' value=\''.$category.'\' /> -->
				  		Enter manual Id if needed (for example: idn_1234_en):	
				  		<input id=\'miCheck_'.$fileName.'\' type=\'checkbox\' name=\'manualIdcheck_'.$fileName.'\' onclick=\'checkManualId_'.$fileName.'()\'/>
				  		<input id=\'manualId_'.$fileName.'\' type=\'text\' name=\'manualId_'.$fileName.'\' size=\'20\' disabled/><br>
				 		Select the language of post:	
				  		<select name=\'language\'>
				  		<option value=\'en\'>English</option>
				  		<option value=\'ru\'>Russian</option>
				  		</select>
				  		<br>
						<select name=\'category\' >
						<option value=\'General\' '.$General_sel.'>General</option>
						<option value=\'AndroidOS\' '.$AndroidOS_sel.'>AndroidOS</option>
						<option value=\'AndroidDevices\' '.$AndroidDevices_sel.'>AndroidDevices</option>
						<option value=\'Developing\' '.$Developing_sel.'>Developing</option>
						<option value=\'Games\' '.$Games_sel.'>Games</option>
						<option value=\'Applications\' '.$Applications_sel.'>Applications</option>
						</select><br>
						Additional Category (use , as a separator without space, for example: General,AndroidOS,AndroidDevices,Developing,Games,Applications): 
								<input type=\'text\' name=\'addCat\' /><br>
						<br>
						<input type=\'submit\' name=\'post\' value=\'POST\'/>
						<input type=\'submit\' name=\'delete\' value=\'DELETE\'/>
					  </form>
				<hr style=\'height: 10px; border: 0px; background-color:black;\'>
			</div>
				<br>
			';
	
	
	
	//$postFileContent=$_POST['editorContent']."";
	//fwrite($postFile, $postFileContent);
	//fclose($postFile);
	/*
	$postBufferContent=$postContent."\n";
	$postBufferFile=fopen($rootPath.'blog/postsBuffer.php','a') or die("postPreview.php: postsBuffer.php opening file error");
	fwrite($postBufferFile, $postBufferContent);
	*/
	
	$postFile=fopen($rootPath.'blog/postsBuffer/'.$fileName.'.php','w') or die("blog/postsBuffer/$fileName: opening file error");
	fwrite($postFile, $postContent."\n");
	fclose($postFile);
	
	$postBufferContent='<?php include \''.$rootPath.'blog/postsBuffer/'.$fileName.'.php\' ?>';
	$postBufferFile=fopen($rootPath.'blog/postsBuffer.php','a') or die("postSubmitted.php: postsBuffer.php opening file error");
	fwrite($postBufferFile, $postBufferContent."\n");
	fclose($postBufferFile);

}

}
else
{
	echo "<br>The reCAPTCHA wasn't entered correctly. Go back and try it again.<br><br><input type='button' onclick='history.go(-2)' value='$editPost_lg'>";
}
?>