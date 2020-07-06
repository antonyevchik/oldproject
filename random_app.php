<?php

//include ("pageCount/pCount_begin.php");
$rr=0;

$query="SHOW TABLES";
if(!mysql_query($query, $db_server)) echo "data search error: $query<br/>". mysql_error() ."<br/><br/>";
$result=mysql_query($query);
$rows=mysql_num_rows($result);



for($i=0;$i<$rows;$i++) 
{
	//$arr=array();
//	$arr[$i]=$i;
	$alltab[$i]=mysql_fetch_row($result);
	
	$cat_query="SELECT * FROM \"".$alltab[$i][0]."\"";
	if(!mysql_query($cat_query, $db_server)) echo "data search error: $cat_query<br/>". mysql_error() ."<br/><br/>";
	$cat_result=mysql_query($cat_query);
	$cat_rows=mysql_num_rows($cat_result);
	
	for($j=0;$j<$cat_rows;$j++) 
	{
		$cat_fetch[$i][$j]=mysql_fetch_row($cat_result);
		
		$pall[$rr]=$cat_fetch[$i][$j];
		$pall[$rr][13]=$alltab[$i][0];
		$rr++;
	}
}




$randApp=array();
$l=1;
for($k=1;$k<=10; ) 
{
	$perm=1;
	$randNum=rand(0,sizeof($pall)-1);
	$m=0;
	for($g=0; $g<sizeof($randApp); $g++) 
	{
		if($randApp[$g]==$randNum) 
		{$perm=0;}
		
	//	else {$perm=1;}
	}
//	$l++;
	if($perm) 
	{
//		
		$randApp[$k-1]=$randNum;
		$k++;	
//		$k=$l;	 
	}
//	if($l>=3) $k=$l;
}

//echo $g."&nbsp;".$k;

for($pp=0;$pp<sizeof($randApp);$pp++)
{
	$rall[$pp]=$pall[$randApp[$pp]];
}






/*

	$query1="SELECT Id, Category FROM allapps ";
	if(!mysql_query($query1, $db_server)) echo "data search error: $query1<br/>". mysql_error() ."<br/><br/>";
	$result1=mysql_query($query1);
	$rows1=mysql_num_rows($result1);
//	echo $rows;
	if($rows1<=5) $startapp=0;
	else $startapp=$rows1-5;
	
	for($pp=$startapp;$pp<$rows1;$pp++) 
	{
	$approw=mysql_fetch_row($result1);
	$category=$approw[1];
	$query2="SELECT * FROM $category WHERE Id='$approw[0]'";
	if(!mysql_query($query2, $db_server)) echo "data search error: $query2<br/>". mysql_error() ."<br/><br/>";
	$result2=mysql_query($query2);	
	$rall[($startapp+4)-$pp]=mysql_fetch_row($result2);
//	echo $rall[$pp][0];
	}
*/	
//	mysql_close($db_server); 
	
$pcObject = new pageCount; 
include($rootPath.'appWin.php');
//$pcObject->pageNmbrPrnt($pp,$cntlink,$lg);

?>