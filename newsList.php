<?php

if($lg=='en') {echo "<h3>News</h3>";}
else {echo "<h3>�������</h3>";}
		$pp=0;
//		$category = $_GET['category'];
		$sort = $_GET['sort'];
	


$query="SHOW TABLES";
if(!mysql_query($query, $db_server)) echo "data search error: $query<br/>". mysql_error() ."<br/><br/>";
$result=mysql_query($query);
$rows=mysql_num_rows($result);		

for($i=0;$i<$rows;$i++) 
{
		$alltab[$i]=mysql_fetch_row($result);

		$queryNews="SELECT * FROM \"".$alltab[$i][0]."\"";		
		if(!mysql_query($queryNews, $db_server))
		echo "data Selecting error: $queryNews<br/>". mysql_error() ."<br/><br/>";
		$resultNews=mysql_query($queryNews);
		$rowsNews=mysql_num_rows($resultNews);
		
		for($j=0; $j < $rowsNews; $j++)
		{
		$rall[$pp]=mysql_fetch_row($resultNews);
		$rall[$pp][7]=$alltab[$i][0];
		$pp++;
		}	
}
$pcObject = new pageCount;
include($rootPath.'newsWin.php');
$pcObject->pageNmbrPrnt($pp,$cntlink,$lg);
?>