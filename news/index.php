<?php
session_start();
if(!include("../constans.php")) die ("ERROR: constans.php file inclusion error");

if(!include __DOCUMENT_ROOT_PATH.'classes/dbase/dbClass.php') die("index.php: dbClass.php inclusion error");
//$dbObject=new dbClass();
if(!include __DOCUMENT_ROOT_PATH.'classes/fixip/fixipClass.php') die("index.php: fixipClass.php inclusion error");
$fixipObject=new fixipClass();
if($_GET['itemid']&&$_GET['rate']) {$itemid=$_GET['itemid']; $rate=$_GET['rate']; $fixipPerm=$fixipObject->fixip($rate,$itemid);}
//echo $fixipPerm.'test';

if(!include(__DOCUMENT_ROOT_PATH."classes/pageCount/pageCountClass.php")) die("index.php: pageCountClass.php inclusion error");
$pcObject=new pageCount;

if(!include(__DOCUMENT_ROOT_PATH."classes/searchform/searchformClass.php")) die("index.php: searchformClass.php inclusion error");
if(!include(__DOCUMENT_ROOT_PATH."classes/messages/messagesClass.php")) die("index.php: messagesClass.php inclusion error");
if(!include(__DOCUMENT_ROOT_PATH."classes/sortingbar/sortingbarClass.php")) die("index.php: sortingbarClass.php inclusion error");

$section='news';
//include("rating/ratingCodeCookies.php");

include(__DOCUMENT_ROOT_PATH."templates/header1.php");
echo "<script type='text/javascript' src='../ckeditor/ckeditor.js'></script>";
include(__DOCUMENT_ROOT_PATH."templates/header2.php");

$actionlink=__ROOT_PATH.$section."/";
searchformClass::set_search_form($actionlink, $lg);

//include(__DOCUMENT_ROOT_PATH."search/searchForm.php");
include(__DOCUMENT_ROOT_PATH."ads/topAd.php");
echo "</div>"; //end of title div
include(__DOCUMENT_ROOT_PATH."templates/centerContent.php");
echo "<div id='leftBox'>";
//include(__DOCUMENT_ROOT_PATH."news/menu/menu.php");
include(__DOCUMENT_ROOT_PATH."apps/menu/menu.php");
include(__DOCUMENT_ROOT_PATH."ads/leftAd.php");
echo "</div>"; //leftContent div


echo "<div id='centerBox'>";

/*
if($_GET['$category'])
{
	if($_GET['category']=='Books and Reference') {$appsHeader_lg=$BooksReference_lg;}
	if($_GET['category']=='Business') {$appsHeader_lg=$Business_lg;}
	if($_GET['category']=='Education and Science') {$appsHeader_lg=$EducationScience_lg;}
	if($_GET['category']=='Entertainment') {$appsHeader_lg=$Entertainment_lg;}
	if($_GET['category']=='Finance') {$appsHeader_lg=$Finance_lg;}
	if($_GET['category']=='Health and Medicine') {$appsHeader_lg=$HealthMedicine_lg;}
	if($_GET['category']=='Multimedia') {$appsHeader_lg=$Multimedia_lg;}
	if($_GET['category']=='Office') {$appsHeader_lg=$Office_lg;}
	if($_GET['category']=='Shopping') {$appsHeader_lg=$Shopping_lg;}
	if($_GET['category']=='Social and Communication') {$appsHeader_lg=$SocialCommunication_lg;}
	if($_GET['category']=='Tools') {$appsHeader_lg=$Tools_lg;}
	if($_GET['category']=='Travel') {$appsHeader_lg=$Travel_lg;}
	if($_GET['category']=='Viewers and Readers') {$appsHeader_lg=$ViewersReaders_lg;}
	if($_GET['category']=='Wallpapers') {$appsHeader_lg=$Wallpapers_lg;}
	if($_GET['category']=='Weather') {$appsHeader_lg=$Weather_lg;}
	if($_GET['category']=='Widgets') {$appsHeader_lg=$Widgets_lg;}
	if($_GET['category']=='Other') {$appsHeader_lg=$Other_lg;}
	if($_GET['category']=='3D-games') {$appsHeader_lg=$ThreeDgames_lg;}
	if($_GET['category']=='Arcade and Action') {$appsHeader_lg=$ArcadeAction_lg;}
	if($_GET['category']=='Cards and Casino') {$appsHeader_lg=$CardsCasino_lg;}
	if($_GET['category']=='Logic and Puzzle') {$appsHeader_lg=$LogicPuzzle_lg;}
	if($_GET['category']=='Online') {$appsHeader_lg=$Online_lg;}
	if($_GET['category']=='Sports Games') {$appsHeader_lg=$SportsGames_lg;}
	if($_GET['category']=='Strategy') {$appsHeader_lg=$Strategy_lg;}
	if($_GET['category']=='Shooting') {$appsHeader_lg=$Shooting_lg;}
	if($_GET['category']=='Quests') {$appsHeader_lg=$Quests_lg;}
	
}
*/


if (empty($_GET['cnt']))
{
	
	echo "<h3>".$news_lg."</h3>";
	echo "<a href='".__ROOT_PATH."news/?cnt=addn&l=".$lg."' style='color: red;'>".$addnews_lg."</a>";
	
	sortingbarClass::set_sorting_bar_news($lg);
	
	$sortby=sortingbarClass::$sortby;
	$sortDir=sortingbarClass::$sortdir;
	$startItem=$pcObject->get_na();
	$itemAmount=$pcObject->naop;
	//dbClass::db_get_items_category($section, $category, $sortby, $sortDir, $startItem, $itemAmount);
	dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount);
	
	if(!include("../news/newsList.php")) die("news/index.php: news/newsList.php file inclusion error");
}

if (!empty($_GET['cnt'])&&$_GET['cnt']=='ctg')
{
	
	
	echo "<h3>".$news_lg."</h3>";
	echo "<a href='".__ROOT_PATH."news/?cnt=addn&l=".$lg."' style='color: red;'>".$addnews_lg."</a>";
	
	sortingbarClass::set_sorting_bar_news($lg);
	
	$category=$_GET['category'];
	$sortby=sortingbarClass::$sortby;
	$sortDir=sortingbarClass::$sortdir;
	$startItem=$pcObject->get_na();
	$itemAmount=$pcObject->naop;
	dbClass::db_get_items_category($section, $category, $sortby, $sortDir, $startItem, $itemAmount);
	//dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount);
	
	
	if(!include("../news/newsList.php")) die("news/index.php: news/newsList.php file inclusion error");
}

if (!empty($_GET['cnt'])&&$_GET['cnt']=='srch')
{

	echo "<h3>".$srchResHeader_lg."</h3>";
	echo "<a href='".__ROOT_PATH."news/?cnt=addn&l=".$lg."' style='color: red;'>".$addnews_lg."</a>";

	sortingbarClass::set_sorting_bar_news($lg);

//	$category=$_GET['category'];
	$sortby=sortingbarClass::$sortby;
	$sortDir=sortingbarClass::$sortdir;
	$startItem=$pcObject->get_na();
	$itemAmount=$pcObject->naop;
	$searchQuery=$_GET['sQ'];
	$search_where="Name LIKE '%$searchQuery%' OR  Description LIKE '%$searchQuery%'";
	
	dbClass::db_get_items_search($section, $search_where, $sortby, $sortDir, $startItem, $itemAmount);
//	dbClass::db_get_items_category($section, $category, $sortby, $sortDir, $startItem, $itemAmount);
	//dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount);


	if(!include("../news/search.php")) die("news/index.php: apps/search.php file inclusion error");
}

if(!empty($_GET['cnt'])&&$_GET['cnt']=='iinfo')
{	
	echo "<h3>".$news_lg." > ".$_GET['newsn']."</h3>";
	if(!include("../news/newsWin.php")) die("news/index.php: news/postWin.php file inclusion error");
}


if(!empty($_GET['cnt'])&&$_GET['cnt']=='addp')
{
	echo "<h3>".$addpostHeader_lg."</h3>";
	echo "<a href='".__ROOT_PATH."news/?cnt=addn&l=".$lg."' style='color: red;'>".$addnews_lg."</a>";
}


if(!empty($_GET['cnt'])&&$_GET['cnt']=='pprev')
{
	echo "<h3>".$postPrevHeader_lg."</h3>";
	if(!include("../blog/postPreview.php")) die("blog/index.php: blog/postPreview.php file inclusion error");
}

if(!empty($_GET['cnt'])&&$_GET['cnt']=='psubm')
{
	echo "<h3>".$postSubmittedHeader_lg."</h3>";
	if(!include("../blog/postSubmitted.php")) die("blog/index.php: blog/postSubmitted.php file inclusion error");
}

//echo "</div>";

//include(__DOCUMENT_ROOT_PATH.'centerBox.php');
include(__DOCUMENT_ROOT_PATH.'social.php');
echo "</div>";

//mysql_select_db($db_database, $db_server) or die("database sel error". mysql_error());
echo "<div id='rightBox'>";
//$dbObject->db_select('db_apps');
//include(__DOCUMENT_ROOT_PATH.'suggestApp.php');
include(__DOCUMENT_ROOT_PATH.'ads/rightAd.php');
echo "</div>"; //rightBox div

//mysql_close($db_server);

include(__DOCUMENT_ROOT_PATH."templates/footer.php");



?>