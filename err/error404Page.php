<?php	
include("getip/getIp.php");
include("rating/ratingCodeCookies.php");
session_start();


include("templates/header1.php"); 

echo "
<meta name='Description' content='' />
<meta name='Keywords' content='' />
";



//echo $_SERVER['SERVER_NAME'];

include('login.php');
$db_server=mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("connect error". mysql_error());
mysql_select_db($db_database, $db_server) or die("database sel error". mysql_error());

 include("templates/header2.php");
 include("search/searchForm.php");
 include("ads/topAd.php");
 echo "</div>"; //end of title div
 include("templates/centerContent.php");
 echo "<div id='leftBox'>";
 include("menu/menu.php");
 include("ads/leftAd.php");
 echo "</div>"; //leftContent div
 
// echo "</td><td>";
// include("randApp.php");



//<!-- Begin Main Content -->


echo "<div id='centerBox'>";
//include("centerBox.php");
echo "<h1>404: Sorry! This Page Dosn`t Exist!</h1>";
echo "</div>";
//echo "</td><td>";
echo "<div id='rightBox'>";
include("ads/rightAd.php");
echo "</div>"; //rightBox div
//echo "</td></tr></table>";

//<!-- End Main Content -->


include("templates/footer.php");


//echo "TEST";
?>


