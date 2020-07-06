
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=WINDOWS-1251" ><title>AndroApps Settings</title></head><body>

<table align='top' border='1' style='margin-left: auto; margin-right: auto;'>
<td>
	<hr>
	<form action='newsSetts.php' method='get'><pre>
	ENG Section Name:     <input type='text' name='tableName'/>
<!--	RUS Section Name:     <input type='text' name='catName_ru'/> -->
	<input type='submit' value='CREATE'/></pre>
	</form>
	
	
<?php

$rootPath = $_SERVER['DOCUMENT_ROOT'];


//include ($rootPath."/phpqrcode/qrlib.php"); //QRcode library including


// BEGIN DB INITIALIZATION
require_once ($rootPath."/login.php");
//phpinfo();
//echo ini_get('post_max_size');
//echo ini_get('upload_max_filesize');
$db_server=mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("connection error". mysql_error());

mysql_select_db($db_news, $db_server) or
 die("database selection error". mysql_error());
// END DB INITIALIZATION
mysql_query("SET NAMES 'cp1251'");

// BEGIN VARIABLES INITIALIZATION AND FUNCTION BLOCK
$permit = 0;


function idGenerator() 
{
$perm = 1;
while($perm) 
{	
	$n = rand(0, 9999);
	if($n < 1000) 
	{
		if($n < 10) { $n = "000".$n;  }
		if($n >= 10 && $n < 100) { $n = "00".$n;  }
		if($n >= 100 && $n < 1000) { $n = "0".$n;  }
	} 
	$varOut = "idn_".$n;

	$perm = 0;

	$queryTab="SHOW TABLES";
	$resultTab=mysql_query($queryTab);
	if(!$resultTab) die("database access error". mysql_error());
	$rowsTab=mysql_num_rows($resultTab);
	
	for($i=0; $i<$rowsTab; ++$i) 
	{
		$rowTab = mysql_fetch_row($resultTab);	
		$querySrch="SELECT Id FROM \"".$rowTab[0]."\" WHERE Id='$varOut'";
		$resultSrch=mysql_query($querySrch);
		if($resultSrch)
		{
		$rowsSrch=mysql_num_rows($resultSrch);	
		if($rowsSrch)	{$i=$rowsTab; $perm=1;}
		}
	}
}
	return $varOut;
}

function RemoveDir($path)
{
	if(file_exists($path) && is_dir($path))
	{
		$dirHandle = opendir($path);
		while (false !== ($file = readdir($dirHandle))) 
		{
			if ($file!='.' && $file!='..')// исключаем папки с назварием '.' и '..' 
			{
				$tmpPath=$path.'/'.$file;
				chmod($tmpPath, 0777);
				
				if (is_dir($tmpPath))
	  			{  // если папка
					RemoveDir($tmpPath);
			   	} 
	  			else 
	  			{ 
	  				if(file_exists($tmpPath))
					{
						// даляем файл  
	  					unlink($tmpPath);
					}
	  			}
			}
		}
		closedir($dirHandle);		
		// даляем текущую папку
		if(file_exists($path))
		{
			rmdir($path);
		}
	}
	else
	{
		echo "Удаляемой папки не существует или это файл!";
	}
}


// END VARIABLES INITIALIZATION AND FUNCTION BLOCK





// BEGIN CREATE TABLE CODE
if(!empty($_GET['tableName']))
{
	
	$tableName=$_GET['tableName'];
//	$catName_ru=$_GET['catName_ru'];
	$query="CREATE TABLE " . $tableName . " (
	No INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
	Name_en VARCHAR(256) NOT NULL,
	Name_ru VARCHAR(256) NOT NULL,
	Description_en VARCHAR(5000) NOT NULL,
	Description_ru VARCHAR(5000) NOT NULL,
	Date DATETIME NOT NULL,
	Id VARCHAR(32) NOT NULL
	)";
	if(!mysql_query($query, $db_server))
			echo "data ins error: $query<br />" . mysql_error(). "<br /><br />";
			
	mkdir($rootPath.'/news/'.$tableName) or die("ERROR of News Catalog Creation");
	
/*
$indexContent = "
<?php include('".$path."/androApps/templates/header1.php');?>

<title>AndroApps - ".$tableName."</title>
<meta name='Description' content='' />
<meta name='Keywords' content='' />

<?php 
	include('".$path."/androApps/templates/header2.php');
	include('".$path."/androApps/ads/topAd.php');
	include('".$path."/androApps/search/search.php');
	include('".$path."/androApps/menu/menu.php');
	include('".$path."/androApps/ads/leftAd.php'); 
	include('".$path."/androApps/ads/rightAd.php'); 
?>

<div id='centerContent'> 
<?php include('".$path."/androApps/appList.php');?>
</div>
<?php include('".$path."/androApps/templates/footer.php');?>";
	
	$indexFile = fopen('category/'.$tableName.'/index.php','a') or die("TEST РЎРѕР·РґР°С‚СЊ С„Р°Р№Р» РЅРµ СѓРґР°Р»РѕСЃСЊ!");
	$iF = fwrite($indexFile,$indexContent);	
	flock($indexFile,LOCK_UN);
	fclose($indexFile);	
*/	
/*
	$menuListOut_en = "echo \"<div id='menuItem'><a href='/?cnt=ctg&category=".$tableName."&sort=Rate&pn=1&l=en'>".$tableName."</a></div><br>\";";
	$menuList_en = fopen($rootPath.'/menu/menuList_en.php','a') or die("Создать файл не удалось!");
	$mL_en=fwrite($menuList_en,$menuListOut_en);
   flock($menuList_en,LOCK_UN);
	fclose($menuList_en);
	
	$menuListOut_ru = "echo \"<div id='menuItem'><a href='/?cnt=ctg&category=".$tableName."&sort=Rate&pn=1&l=ru'>".$catName_ru."</a></div><br>\";";
	$menuList_ru = fopen($rootPath.'/menu/menuList_ru.php','a') or die("Создать файл не удалось!");
	$mL_ru=fwrite($menuList_ru,$menuListOut_ru);
   flock($menuList_ru,LOCK_UN);
	fclose($menuList_ru);
	*/
}
// END CREATE TABLE CODE



// BEGIN TABLE SELECTION CODE
	$queryTab="SHOW TABLES";
	$resultTab=mysql_query($queryTab);
	if(!$resultTab) die("database access error". mysql_error());
	$rowsTab=mysql_num_rows($resultTab);
		
	echo "
	<form action='newsSetts.php' method='get'><pre>
	Choose a Table Data Base (Section): <select name='selectTab'>";
	
	for($i=0; $i<$rowsTab; ++$i) 
	{
	$rowTab[$i]=mysql_fetch_row($resultTab);
	echo "<option value='".$rowTab[$i][0]."'>".$rowTab[$i][0]."</option>";
	}
	echo "</select>";
	echo "<br>";
	for($i=0; $i<$rowsTab; ++$i) 
	{
		//$rowTab1 = mysql_fetch_row($resultTab);
		echo "<input type='checkbox' name='additCat".$i."' value='".$rowTab[$i][0]."'>".$rowTab[$i][0];
		if(!($i % 2)) echo "<br>"; else echo "&nbsp;&nbsp;";
	}
	echo "<br>";
	
//	<input type='hidden' name='selectTab' value='".$rowTab[$i][0]."' />
echo "<input type='submit' value='SELECT' />
	</pre>
	</form>";

// END TABLE SELECTION CODE



echo "<a href='setts/sets1.php'>ADD ANOTHER RECORD</a>";

//include("addRecord.php");

if( !empty($_GET['selectTab']))
{
	$selectTab = $_GET['selectTab'];
/*	
	for($i=0; $i<$rowsTab; ++$i) 
	{
	if($selectTab!=$_GET['additCat'.$i]){$additCat[$i] = $_GET['additCat'.$i];}
	}
	$allCat=implode(" ", $additCat);
	*/
	$permit = 1;

}

if( !empty($_POST['selectTab']))
{
	$selectTab = $_POST['selectTab'];
	$permit = 1;
}	
	echo $selectTab;
/*
if(!empty($_POST['allCat'])) 
{
	$allCat = $_POST['allCat'];
}

*/

// BEGIN INSERT RECORD TO TABLES


if( 
	
	!empty($_POST['Name_en']) &&
	!empty($_POST['Name_ru']) &&
	$_FILES &&
	!empty($_POST['description_en']) &&
	!empty($_POST['description_ru']))
	
	{
		$Name_en			  = $_POST['Name_en'];
		$Name_ru			  = $_POST['Name_ru'];
		$Id              = idGenerator();
		
		$newsPath = $rootPath.'/news/'.$selectTab.'/'.$Id;
		mkdir($newsPath) or die("ERROR of Creation of NewsPath");	
			
		$afPath = str_replace(" ", "%20", 'news/'.$selectTab.'/'.$Id);
		
	
		$mainScreenshot = $_FILES['mainScreenshot']['name'];
		move_uploaded_file($_FILES['mainScreenshot']['tmp_name'], $newsPath.'/'.$mainScreenshot);
	
		$msSize=getimagesize($afPath.'/'.$mainScreenshot); if($msSize[0]>$msSize[1]) {$msWidth='$big'; $msHeight='$imHeight';} if($msSize[0]<$msSize[1]) {$msWidth='$small'; $msHeight='$imHeight';}
		$mScrnsht = "<?php echo \"<img border='0' style='width: ".$msWidth."; height: ".$msHeight.";' src='".$afPath."/".$mainScreenshot."' />\"; ?>";
		
		
		$Date=date("Y-m-d H:i:s");		
		
		$description_en = "<h2>".$Name_en."</h2><b>".$Date."</b><br><br>".$_POST['description_en'];
		$description_ru = "<h2>".$Name_ru."</h2><b>".$Date."</b><br><br>".$_POST['description_ru'];
		
		
		
		
		
		
//		echo $rootPath.'/androApps/category/'.$selectTab.'/'.$Id.'.php';
		
		$fo_mScrnsht = fopen($newsPath.'/mScrnsht_'.$Id.'.php','a') or die("Создать файл не удалось!");
		$fw_mScrnsht=fwrite($fo_mScrnsht,$mScrnsht);
		flock($fo_mScrnsht,LOCK_UN);
		fclose($fo_mScrnsht);		
						
		
		$fo_dscrpt_en = fopen($newsPath.'/dscrpt_en_'.$Id.'.php','a') or die("Создать файл не удалось!");
		$fw_dscrpt_en=fwrite($fo_dscrpt_en,$description_en);
		flock($fo_dscrpt_en,LOCK_UN);
		fclose($fo_dscrpt_en);
		
		
		$fo_dscrpt_ru = fopen($newsPath.'/dscrpt_ru_'.$Id.'.php','a') or die("Создать файл не удалось!");
		$fw_dscrpt_ru=fwrite($fo_dscrpt_ru,$description_ru);
		flock($fo_dscrpt_ru,LOCK_UN);
		fclose($fo_dscrpt_ru);
		
		
		$querySet="SET sql_mode='ANSI_QUOTES';";
		if(!mysql_query($querySet, $db_server))
		echo "data Set ANSI_QUOTES error: $querySet<br />" . mysql_error(). "<br /><br />";
		mysql_query("SET NAMES 'cp1251'");
		
		
		
		
		
		$query = "INSERT INTO " . $selectTab . "(Name_en,Name_ru,Description_en,Description_ru,Date,Id) VALUES".
		"('$Name_en', '$Name_ru', '$description_en', '$description_ru', '$Date', '$Id')";
		
		if(!mysql_query($query, $db_server))
			echo "data ins error: $query<br />" . mysql_error(). "<br /><br />";
	}
// END INSERT RECORD TO TABLES

// BEGIN DELETE RECORD FROM TABLE
if(isset($_POST['delete']))
	{
	//	$selectTab = $_POST['selectTab'];
		$Id	=	$_POST['Id'];
		$rmnewsaddr=$rootPath.'/news/'.$selectTab.'/'.$Id;
		RemoveDir($rmnewsaddr);
		
		$querySet="SET sql_mode='ANSI_QUOTES';";
		if(!mysql_query($querySet, $db_server))
		echo "data Set ANSI_QUOTES error: $querySet<br />" . mysql_error(). "<br /><br />";
		
		$query = "DELETE FROM \"".$selectTab."\" WHERE Id='$Id'";
			
		if(!mysql_query($query, $db_server))
		echo "data remove error: $query<br />" . mysql_error(). "<br /><br />";
		
	/*	$QR_allapps="DELETE FROM allapps WHERE Id='$Id'";
		if(!mysql_query($QR_allapps, $db_server))
			echo "data ins error: $QR_allapps<br />" . mysql_error(). "<br /><br />"; */
	}
// END RECORD FROM TABLE



	
//	echo "Uploaded image '$application'<br />";
//	echo "Uploaded image '$mainScreenshot'<br />";




// table select


// BEGIN FORM BLOCK

echo "
<hr />
<form method='post' action='newsSetts.php' enctype='multipart/form-data'> <pre>
Name ENG             <input type='text' name='Name_en' />
Name RUS             <input type='text' name='Name_ru' />

<!-- <input type='hidden' name='MAX_FILE_SIZE' value='3000000' /> -->

Upload Main Screenshot:   <input type='file' name='mainScreenshot' size='10' /> <br />

Description EN:
<textarea name='description_en' rows='10' cols='50'></textarea>
Description RU:
<textarea name='description_ru' rows='10' cols='50'></textarea>

<input type='hidden' name='selectTab' value='$selectTab' />
<input type='submit' value='ADD RECORD' />
</pre>
</form>
";
// END FORM BLOCK






// BEGIN OUTPUT FILE BLOCK
/*
if(isset($_POST['description'])&&$description = $_POST['description'])
{
$Name = $_POST['Name'];


}
*/
// END OUTPUT FILE BLOCK

echo "<td><div><table border='1'>";


if($permit) 
{		

	$query1 = "SELECT*FROM $selectTab";
	$result1 = mysql_query($query1);
	if(!$result1) die("database access error". mysql_error());
	$rows = mysql_num_rows($result1);

	echo "<tr>
	<td>No</td>
	<td>Name_en</td>
	<td>Name_ru</td>
	<td>Description_EN</td>
	<td>Description_RU</td>
	<td>Date</td>
	<td>Id</td>
		</tr>";
	
	for ($j = 0; $j<$rows; ++$j)
	{ 
		$row = mysql_fetch_row($result1);
		echo "
		<tr>
		<td>$row[0]</td>
		<td>$row[1]</td>
		<td>$row[2]</td>
		<td>$row[3]</td>
		<td>$row[4]</td>
		<td>$row[5]</td>
		<td>$row[6]</td>
		<td>
		<form action='newsSetts.php' method='post'>
		<input type='hidden' name='delete' value='yes' />
		<input type='hidden' name='selectTab' value='$selectTab' />
		<input type='hidden' name='Id' value='$row[6]' />
		<input type='submit' value='DELETE' /> </form>
		</tr></td>";
 	
	}
	
}
echo "</div></table>";



//header('Location: sets.php');
	mysql_close($db_server);
	
		
		function get_post($var)
		{
			return mysql_real_escape_string($_POST[$var]);
		}
		
//		ob_end_clean();
//	header('Location: sets1.php');
?>
</table>
</body>
</html>