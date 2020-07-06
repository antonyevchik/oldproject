
<?php	
	$pp=0;
	$searchQuery=$_GET['sQ'];
	$queryTab="SHOW TABLES";
	$resultTab=mysql_query($queryTab);
	if(!$resultTab) die("database access error". mysql_error());
	$rowsTab=mysql_num_rows($resultTab);
	


	for($i=0; $i<$rowsTab; ++$i)
	{
		$rowTab = mysql_fetch_row($resultTab);
		
		$queryAppInfo="SELECT * FROM \"".$rowTab[0]."\" WHERE Name LIKE '%$searchQuery%' OR  Description_en LIKE '%$searchQuery%'";
//		$category = $rowTab[0];
	//	echo $category;
		$result=mysql_query($queryAppInfo);
		$rows=mysql_num_rows($result);
		
		
		for($j=0; $j < $rows; $j++)
		{
		$row[$i][$j]=mysql_fetch_row($result);
		$rall[$pp]=$row[$i][$j];
		$rall[$pp][13]=$rowTab[0];
		$pp++;
		}

	}		

//mysql_close($db_server);

$pcObject = new pageCount;
include($rootPath.'appWin.php');
$pcObject->pageNmbrPrnt($pp,$cntlink,$lg);

?>
