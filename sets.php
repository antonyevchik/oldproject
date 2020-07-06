
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html><head><title>AndroApps Settings</title></head><body>

<div style='width: 400px;  margin-left: auto; margin-right: auto;'>

	<hr>
	<form action='sets.php' method='post'><pre>
	Section Name:     <input type='text' name='tableName'/>
	<input type='submit' value='CREATE'/></pre>
	</form>
	<hr>
	
<?php

// BEGIN DB INITIALIZATION
require_once 'login.php';
$db_server=mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("connection error". mysql_error());

mysql_select_db($db_database, $db_server) or
 die("database selection error". mysql_error());
// END DB INITIALIZATION


$selectTab = $_POST['selectTab'];


// BEGIN CREATE TABLE CODE
if(isset($_POST['tableName']))
{
	
	$tableName=$_POST['tableName'];
	$query="CREATE TABLE " . $tableName . "(
	Name VARCHAR(32) NOT NULL,
	Version VARCHAR(32) NOT NULL,
	Android_Version VARCHAR(32) NOT NULL,
	Developer VARCHAR(32) NOT NULL,
	Size VARCHAR(32) NOT NULL,
	Id SMALLINT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (Id)
	)";
	if(!mysql_query($query, $db_server))
			echo "data ins error: $query<br />" . mysql_error(). "<br /><br />";
}
// END CREATE TABLE CODE



	
	$queryTab="SHOW TABLES";
	$resultTab=mysql_query($queryTab);
	if(!$resultTab) die("database access error". mysql_error());
	$rowsTab=mysql_num_rows($resultTab);
	
	echo "
	<form action='sets.php' method='post'><pre>
	Choose a Table Data Base (Section): <select name='selectTab'>";
	
	for($i=0; $i<$rowsTab; ++$i) 
	{
		$rowTab = mysql_fetch_row($resultTab);
	echo "
	<option value='$rowTab[0]'>$rowTab[0]</option>";
	}
	echo "
	</select>
	<input type='submit' value='SELECT' />
	</pre>
	</form>";





// BEGIN INSERT RECORD TO TABLE
if( 
	isset($_POST['Name']) &&
	isset($_POST['Version']) &&
	isset($_POST['Android_Version']) &&
	isset($_POST['Developer']) &&
	isset($_POST['Size']) &&
	isset($_POST['Id']))
	
	{
	
		$Name				  = $_POST['Name'];
		$Version         = $_POST['Version'];
		$Android_Version = $_POST['Android_Version'];
		$Developer		  = $_POST['Developer'];
		$Size				  = $_POST['Size'];
		$Id				  = $_POST['Id'];
		
		$query = "INSERT INTO " . $selectTab . " VALUES".
		"('$Name', '$Version', '$Android_Version', '$Developer', '$Size', '$Id')";
	
		if(!mysql_query($query, $db_server))
			echo "data ins error: $query<br />" . mysql_error(). "<br /><br />";
	}
// END INSERT RECORD TO TABLE

// BEGIN DELETE RECORD FROM TABLE
if(isset($_POST['delete']))
	{
	//	$selectTab = $_POST['selectTab'];
		$Id	=	$_POST['Id'];
		$query = "DELETE FROM " . $selectTab . " WHERE Id='$Id'";
			
		if(!mysql_query($query, $db_server))
		echo "data remove error: $query<br />" . mysql_error(). "<br /><br />";
	}
// END RECORD FROM TABLE



if ($_FILES)
{
	
	$application = $_FILES['application']['name'];
	move_uploaded_file($_FILES['application']['tmp_name'], $application);
	
	$mainScreenshot = $_FILES['mainScreenshot']['name'];
	move_uploaded_file($_FILES['mainScreenshot']['tmp_name'], $mainScreenshot);
	echo "Uploaded image '$application'<br />";
	echo "Uploaded image '$mainScreenshot'<br />";
}



	
	echo "
	<hr />
	<form method='post' action='sets.php' enctype='multipart/form-data'> <pre>
	Name              <input type='text' name='Name' />
	Version           <input type='text' name='Version' />
	Android Version   <input type='text' name='Android_Version' />
	Developer         <input type='text' name='Developer' />
	Size              <input type='text' name='Size' />
	Id                <input type='text' name='Id' />

Upload Application :      <input type='file' name='application' size='10' /> <br />
Upload Main Screenshot:   <input type='file' name='mainScreenshot' size='10' /> <br />
Upload First Screenshot:  <input type='file' name='firstScreenshot' size='10' /> <br />
Upload Second Screenshot: <input type='file' name='secondScreenshot' size='10' /> <br />
Upload Third Screenshot:  <input type='file' name='thirdScreenshot' size='10' /> <br />
Upload Fourth Screenshot: <input type='file' name='fourthScreenshot' size='10' /> <br />
Upload QR-code Image:     <input type='file' name='qrCode' size='10' /> <br /><br />

Description:
<textarea name='description' rows='10' cols='50'></textarea>
<input type='hidden' name='selectTab' value='$selectTab' />
<input type='submit' value='ADD RECORD' />
</pre>
</form>
";
// End Upload Block

/*
if($description = $_POST['description'])
{
$Name = $_POST['Name'];


echo "
<form method='post' action='". $Name .".php' enctype='multipart/form-data'>
<pre>
<input type='submit' value='PREVIEW' />
</form>
</pre>
<hr />
";

$fileOut = "
<pre>
<div>
<img src='$mainScreenshot' />
<p>$description</p>
<a href=$application'> $Name </a>
</div>
</pre>";

$fh = fopen($Name.'.php','a') or die("TEST Создать файл не удалось!");
$fw=fwrite($fh,$fileOut);
flock($fh,LOCK_UN);
fclose($fh);
}
*/
echo "<hr>";




				
 if( isset($_POST['selectTab']))
{
	//$selectTab = $_POST['selectTab'];
	$query1 = "SELECT*FROM " . $selectTab;
	$result1 = mysql_query($query1);
	if(!$result1) die("database access error". mysql_error());
	$rows = mysql_num_rows($result1);
	
	for ($j = 0; $j<$rows; ++$j)
	{ 
		$row = mysql_fetch_row($result1);
		echo "
		<pre>
		Name            $row[0]
		Version         $row[1]
		Android Version $row[2]
		Developer       $row[3]
		Size            $row[4]
		Id              $row[5]
		</pre>
		<form action='sets.php' method='post'>
		<input type='hidden' name='delete' value='yes' />
		<input type='hidden' name='selectTab' value='$selectTab' />
		<input type='hidden' name='Id' value='$row[5]' />
		<input type='submit' value='DELETE RECORD' /> </form>";
 	
	}
}



//header('Location: sets.php');
	mysql_close($db_server);
		
		function get_post($var)
		{
			return mysql_real_escape_string($_POST[$var]);
		}
?>
</div>
</body>
</html>