
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=WINDOWS-1251" ><title>AndroApps Settings</title></head><body>

<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'].'/';


	 if(!empty($_POST['post']))
    {
  		$aPath = $_POST['aPath'];
		$date = $_POST['date'];
  		
  		if(!empty($_POST['app']))
		{
		$app=$_POST['app'];
		$fr = file_get_contents($rootPath.'messages/app_mes_files/mesfile'.$date.'_'.$app.'.txt'); 	
    	$fh = fopen($aPath.'/mesfile_'.$app.'.txt','a') or die("Создать файл не удалось!");
		$fw=fwrite($fh,$fr);
		flock($fh,LOCK_UN);
		fclose($fh);
    	}
    	
    	if(!empty($_POST['idn']))
    	{
    	$idn=$_POST['idn'];
    	$fr = file_get_contents($rootPath.'messages/news_mes_files/mesfile'.$date.'_'.$idn.'.txt'); 	
    	$fh = fopen($aPath.'/mesfile_'.$idn.'.txt','a') or die("Создать файл не удалось!");
		$fw=fwrite($fh,$fr);
		flock($fh,LOCK_UN);
		fclose($fh);
    	}
    	
	 }
	 
	 if(!empty($_POST['remove']))
	 {
		if(!empty($_POST['app']))
		{
			$app=$_POST['app']; 
			unlink($rootPath.'messages/app_mes_files/mesfile'.$date.'_'.$app.'.txt');
		}
		
		if(!empty($_POST['idn']))
    	{
    		$idn=$_POST['idn']; 
			unlink($rootPath.'messages/news_mes_files/mesfile'.$date.'_'.$idn.'.txt');
		}
	 }
	 
if(!empty($_POST['clear']))
{
		$fh = fopen($rootPath.'messages/mesAdmin.php','w') or die("Создать файл не удалось!");
		$fw=fwrite($fh,'');
		flock($fh,LOCK_UN);
		fclose($fh);
}

include($rootPath.'messages/mesAdmin.php');

?>
<hr>
<form action='/setts/mesSetts.php' method='post'> 

<input type='submit' name='clear' value='CLEAR'/></form>


</body>
</html>