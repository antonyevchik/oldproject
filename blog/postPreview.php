<?php
//if(!require_once("../constans.php")) die ("ERROR: constans.php file inclusion error");
//if(!require_once(__DOCUMENT_ROOT_PATH."classes/reCaptcha/recaptchaClass.php")) die("postPreview.php: recaptchaClass.php inclusion error");

if(!empty($_POST['editorContent'])&&!empty($_POST['authorName'])&&!empty($_POST['blogCategory'])&&!empty($_POST['postTitle'])&&!empty($_POST['shortDescription']))
{
	$authorName=$_POST['authorName'];
	$blogCategory=$_POST['blogCategory'];
	$postTitle=$_POST['postTitle'];
	$shortDescription=$_POST['shortDescription'];
	$editorContent=$_POST['editorContent'];
	$postDate=date('d.m.Y H:i');
	
	echo   "<h1>".$postTitle."</h1>";
	echo "<b>".$AuthorName_lg."</b>&nbsp".$authorName.";&nbsp&nbsp<b>".$postDate_lg."</b>&nbsp".$postDate;
	echo "<br>";
	//echo $postContent;
	echo "<div id='post_description_Content'>";
	echo "<br>$editorContent";
	echo "</div>";
	echo "<br style='clear:both;'>";
	echo "<br>";
	echo "<br><hr style='height: 3px; border: 0px; background-color:black;'><br>";
	echo   "<input style='float: left;' type='button' onclick='history.back()' value='$editPost_lg'>";
	
	echo "<form id='form1' name='form1' method='post' action='../blog/?cnt=psubm&l=".$lg."'>";
	echo recaptchaClass::recaptchaClass_recaptcha_get_html();
	echo "	<input type='hidden' name='authorName' value='$authorName'/>
			<input type='hidden' name='blogCategory' value='$blogCategory'/>
			<input type='hidden' name='postTitle' value='$postTitle'/>
			<input type='hidden' name='shortDescription' value='$shortDescription'/>
			<input type='hidden' name='editorContent' value='$editorContent'/>
			<input type='submit' value='$submitPost_lg'> 
		  </form>
		  ";

}

else echo "<br>".__REQUIRED_FIELDS_LG."<br><br><input type='button' onclick='history.back()' value='$editPost_lg'>";


?>