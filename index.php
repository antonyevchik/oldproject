<?php	


include("getip/getIp.php");
include("rating/ratingCodeCookies.php");
session_start();
if(!include("constans.php")) die ("ERROR: variables.php file inclusion error");
include("classes/setTitle/setTitleClass.php");
include("templates/header1.php"); 

//echo $_SERVER['SERVER_NAME'];

if(!include($rootPath."classes/dbase/dbClass.php")) die ("ERROR: dbClass.php file inclusion error"); 
$dbObject=new dbClass;
$dbObject->db_connect();
$db_server=$dbObject->db_server;
//dbClass::db_connect();
//$db_server=dbClass::db_server;
echo $db_server;
//mysqli_query("SET NAMES 'cp1251'");
//$querySet="SET sql_mode='ANSI_QUOTES';";
//if(!mysqli_query($querySet, $db_server))
//echo "data ins error: $querySet<br />" . mysql_error(). "<br /><br />";


include("templates/header2.php");
include("search/searchForm.php");
include("ads/topAd.php");
echo "</div>"; //end of title div
include("templates/centerContent.php");
echo "<div id='leftBox'>";
include("menu/menu.php");
include("ads/leftAd.php");
echo "</div>"; //leftContent div
 
echo "</td><td>";
include("randApp.php");


//phpinfo();

echo "<div id='centerBox'>";
//include("centerBox.php");
include("social.php");
echo "</div>";
//	mysql_select_db($db_database, $db_server) or die("database sel error". mysql_error());
echo "<div id='rightBox'>";
//include("suggestApp.php");
//include("ads/rightAd.php");
echo "</div>"; //rightBox div
echo "</td></tr></table>";

//mysql_close($db_server); 
echo "<div style='width: 1000px; margin-right: auto; margin-left: auto;'>";
echo "<br><br><h1>We apologize but site is under construction. Please visit Android-lifestyle.com a little later.</h1>";
echo "<hr style='height: 10px; border: 0px; top: 100px; bottom:30px; background-color:black;'>";

include("templates/footer.php");
echo "</div>";

?>

