<?php
$dbObject->db_select('androidli_news');

if(isset($_GET['cnt'])&&$_GET['cnt']=='fnws')
include ("boxtemplate/nwtem.php");

//BEGIN NEWS CODE
if($_GET['cnt']=='news')
{
	$cntlink="cnt=news";
	include ("newsList.php");
}
//END NEWS CODE

$dbObject->db_select('androidli_androidapps');

if(isset($_GET['cnt'])&&$_GET['cnt']=='ainfo')
include ("boxtemplate/aptem.php");

include ("appList.php");

?>
