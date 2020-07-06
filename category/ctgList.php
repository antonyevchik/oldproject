<?php
if(!include $rootPath."classes/pageCount/pageCountClass.php") echo " pageCountClass.php including ERROR";
		$pp=0;
		$category = $_GET['category'];
		$sort = $_GET['sort'];
		

$query="SHOW TABLES";
if(!mysqli_query($db_server,$query)) echo "data search error: $query<br/>". mysqli_error() ."<br/><br/>";
$result=mysqli_query($query);
//echo $result;
$rows=mysqli_num_rows($result);

for($i=0;$i<$rows;$i++) 
{
		$alltab[$i]=mysqli_fetch_row($result);

		$queryAppInfo="SELECT * FROM \"".$alltab[$i][0]."\" WHERE AdditCat LIKE '%$category%'";
		if(!mysqli_query($db_server,$queryAppInfo))	echo "data search error: $queryAppInfo<br/>". mysql_error() ."<br/><br/>";
		$resultAppInfo=mysqli_query($queryAppInfo);
		$rowsAppInfo=mysqli_num_rows($resultAppInfo);
						
		for($j=0; $j < $rowsAppInfo; $j++)
		{
		$rall[$pp]=mysqli_fetch_row($resultAppInfo);
		$rall[$pp][13]=$alltab[$i][0];
		$pp++;
		}	
}	

$pcObject = new pageCount;
include($rootPath.'appWin.php');
$pcObject->pageNmbrPrnt($pp,$cntlink,$lg);

?>