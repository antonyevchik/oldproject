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


echo "<h3>”слови€ использовани€</h3><br>
1. »спользу€ вэб-ресурс  AndroidLifestyle ¬ы автоматически соглашаетесь с данными положени€ми.<br>
2. Ётот ресурс содержит ћатериалы состо€щие из графических материалов (фотографий, скриншотов и др. изображений), текста, файлов данных, приложений дл€ мобильного телефона (планшета) и персонального компьютера. ¬се вышеперечисленные ћатериалы приведены исключительно дл€ ознакомительных и образовательных целей. «агружа€ и использу€ ћатериалы ¬ы об€зуетесь ознакомитьс€ и удалить их с телефона или планшета.<br>
3. ѕриложени€, часть графического материала (фотографии, скриншоты) и текста приведены из открытых источников, услови€ использовани€ (положени€ авторских прав) которых не запрещают их демонстрацию широкой общественности. Ќи администраци€ ресурса, ни хостинг провайдер не несут ответственность за эти материалы.<br>
4. ≈сли вы считаете, что какие-либо размещенные материалы нарушают ¬аши права, немедленно св€житесь с администрацией сайта дл€ решени€ этого вопроса.<br>
5. Ќа этом сайте располагаютс€ приложени€ с открытым исходным кодом, если вы полагаете, что какое-либо приложение может нанести вред вашему устройству, не устанавливайте его либо обратитесь к разработчику за более детальной информацией.";


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

