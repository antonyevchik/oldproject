<?php	
/*
include("getip/getIp.php");
include("rating/ratingCodeCookies.php");
session_start();
*/

include("templates/header1.php"); 

//echo $_SERVER['SERVER_NAME'];

include('login.php');
$db_server=mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("connect error". mysql_error());
mysql_select_db($db_database, $db_server) or die("database sel error". mysql_error());
mysql_query("SET NAMES 'cp1251'");
$querySet="SET sql_mode='ANSI_QUOTES';";
if(!mysql_query($querySet, $db_server))
echo "data ins error: $querySet<br />" . mysql_error(). "<br /><br />";

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


?>
<!-- Begin Main Content -->

<?php
echo "<div id='centerBox'>";


echo "<h3>������� �������������</h3><br>
1. ��������� ���-������  AndroidLifestyle �� ������������� ������������ � ������� �����������.<br>
2. ���� ������ �������� ��������� ��������� �� ����������� ���������� (����������, ���������� � ��. �����������), ������, ������ ������, ���������� ��� ���������� �������� (��������) � ������������� ����������. ��� ����������������� ��������� ��������� ������������� ��� ��������������� � ��������������� �����. �������� � ��������� ��������� �� ���������� ������������ � ������� �� � �������� ��� ��������.<br>
3. ����������, ����� ������������ ��������� (����������, ���������) � ������ ��������� �� �������� ����������, ������� ������������� (��������� ��������� ����) ������� �� ��������� �� ������������ ������� ��������������. �� ������������� �������, �� ������� ��������� �� ����� ��������������� �� ��� ���������.<br>
4. ���� �� ��������, ��� �����-���� ����������� ��������� �������� ���� �����, ���������� ��������� � �������������� ����� ��� ������� ����� �������.<br>
5. �� ���� ����� ������������� ���������� � �������� �������� �����, ���� �� ���������, ��� �����-���� ���������� ����� ������� ���� ������ ����������, �� �������������� ��� ���� ���������� � ������������ �� ����� ��������� �����������.";


echo "</div>";
//echo "</td><td>";
echo "<div id='rightBox'>";
include("suggestApp.php");
include("social.php");
include("ads/rightAd.php");
echo "</div>"; //rightBox div
//echo "</td></tr></table>";

mysql_close($db_server); 
?>
<!-- End Main Content -->
<?php

include("templates/footer.php");

?>

