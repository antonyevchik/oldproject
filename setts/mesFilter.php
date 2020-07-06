<?php
if(!include("../constans.php")) die ("mesFilter.php: constans.php file inclusion error");


if(!empty($_POST['post']))
{
		$mesFile = $_POST['mesFile'];
		$mesBufferFile = $_POST['mesBufferFile'];

		$fr = file_get_contents($mesBufferFile);
		$fh = fopen($mesFile,'a') or die("Cannot open the file".$mesFile."!");
		$fw=fwrite($fh,$fr);
		flock($fh,LOCK_UN);
		fclose($fh); 
}

if(!empty($_POST['remove']))
{
		$mesBufferFile = $_POST['mesBufferFile'];
		unlink($mesBufferFile);
}

if(!empty($_POST['clear']))
{
	$fh = fopen(__DOCUMENT_ROOT_PATH.'messages/mesBuffer.php','w') or die("Cannot open the file ".__DOCUMENT_ROOT_PATH."messages/mesBuffer.php!");
	$fw=fwrite($fh,'');
	flock($fh,LOCK_UN);
	fclose($fh);
}

include(__DOCUMENT_ROOT_PATH.'messages/mesBuffer.php');

echo "
		<hr>
		<form action='".__ROOT_PATH."setts/mesFilter.php' method='post'>
		<input type='submit' name='clear' value='CLEAR'/>
		</form>
	";

?>