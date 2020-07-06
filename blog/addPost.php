<?php
//echo 'test';
echo "
<br><br>
<form id='form1' name='form1' method='post' action='../blog/?cnt=pprev&l=".$lg."'>
$userName_lg:<span style='color:red;'>*</span>

<input type='text' name='authorName' size='25' />
<br><br>
$blogTopics_lg:<span style='color:red;'>*</span>

<select name='blogCategory' ><span style='color:red;'>*</span>
<option value='General'>$General_lg</option>
<option value='AndroidOS'>$AndroidOS_lg</option>
<option value='AndroidDevices'>$AndroidDevices_lg</option>
<option value='Developing'>$Developing_lg</option>
<option value='Games'>$Games_lg</option>
<option value='Applications'>$Applications_lg</option>
</select>
<br><br>
$blogPostTitle_lg:<span style='color:red;'>*</span>
<input type='text' name='postTitle' size='50' />
<br><br>
$shotDescription_lg:<span style='color:red;'>*</span>
<br>
<textarea name='shortDescription' cols='93' rows='5' style='max-width: 660px; min-width:660px; '></textarea>
<br><br>
$postContent_lg:<span style='color:red;'>*</span>
<textarea name='editorContent' id='editorContent' cols='45' rows='5'></textarea>
<script type='text/javascript'>
CKEDITOR.replace('editorContent');
</script>
<br>
<input type='submit' value='$postPreview_lg'/>
</form>
";
?>