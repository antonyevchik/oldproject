<?php
echo "<script type='text/javascript' src='../ckeditor/ckeditor.js'></script>";
require_once '../constans.php';
//include 'pcountClass.php';
//$pcount= new pcount;

if(!include(__DOCUMENT_ROOT_PATH."classes/dbase/dbClass.php")) die ("ERROR: dbClass.php file inclusion error");
$dbObject=new dbClass;


if (!empty($_POST['post'])&&!empty($_POST['filename']))
{
	$filename=$_POST['filename'];
	//$postContent=file_get_contents($filename);
	$postContent=$_POST['editorContent_'.$filename];

	$dbase='aldb';
	$section='blog';
	$mId='manualId_'.$_POST['filename'];
	$manualId=$_POST[$mId];
	
	$category=$_POST['category'];
	if(!empty($_POST['addCat']))
	{
		$addCat=$_POST['addCat'];
		$cat_array[0]=$category;
		$cat_array[1]=$addCat;
		$category=implode(',', $cat_array);
	}
	$tableRow=array('0','0','0','0','0','0','0','0','0','0');
	$tableRow[0]=$_POST['authorName'];
		//$postContent=str_replace("'", "\'", $postContent);
	$tableRow[1]=$_POST['date'];
	$tableRow[2]=$_POST['postTitle'];
	$tableRow[3]=$_POST['shortDescription'];
	$postContent=str_replace("'", "\'", $postContent);
	$tableRow[4]=$postContent;
	$tableRow[5]=$category;
	$tableRow[6]=0;
	$tableRow[7]=0;
	$tableRow[8]=0.0;
	if (empty($manualId))	$tableRow[9]=$dbObject->db_idGenerator($_POST['language']);
	if (!empty($manualId))  $tableRow[9]=$dbObject->db_idGenerator($_POST['language'],$manualId);
	$Id=$tableRow[9];
	for ($j=0;$j<sizeof($langs_array);$j++) { $replaceNeedle[$j]="_".$langs_array[$j];}
	$Id_wl=str_replace($replaceNeedle, '', $Id);  // id without language tail ('_en' or '_ru')
	
	$dbObject->db_insert_into_table($section, $category, $tableRow);
	mkdir(__DOCUMENT_ROOT_PATH.'blog/blogPosts/'.$Id_wl);	
	
	//unlink(__DOCUMENT_ROOT_PATH.'blog/postsBuffer/'.$filename.".php");
}

if (!empty($_POST['delete'])&&!empty($_POST['filename']))
{
	$filename=$_POST['filename'];
	unlink(__DOCUMENT_ROOT_PATH.'blog/postsBuffer/'.$filename.".php");
}

include (__DOCUMENT_ROOT_PATH.'blog/postsBuffer.php');


if (!empty($_POST['submitClearBuffer'])&&$_POST['submitClearBuffer']=='true')
{
	$postBufferFile=fopen(__DOCUMENT_ROOT_PATH.'blog/postsBuffer.php','w') or die("postsFilter.php: postsBuffer.php opening file error");
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