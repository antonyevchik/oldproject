<?php

session_start();
if(!include("../constans.php")) die ("ERROR: constans.php file inclusion error");
if(!include __DOCUMENT_ROOT_PATH.'classes/setTitle/setTitleClass.php') die("index.php: setTitleClass.php inclusion error");
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
if(!include(__DOCUMENT_ROOT_PATH."classes/centerboxBar/centerboxBarClass.php")) die("index.php: centerboxBarClass.php inclusion error");
if(!include(__DOCUMENT_ROOT_PATH."classes/suggestItemClass/suggestItemClass.php")) die("index.php: suggestItemClass.php inclusion error");
if(!require_once(__DOCUMENT_ROOT_PATH."classes/langCntrBoxBar/langCntrBoxBarClass.php")) die("centerBoxBarClass.php: sortingbarClass.php inclusion error");
//if(!require_once(__DOCUMENT_ROOT_PATH."reCaptcha/recaptchalib.php")) die("index.php: recaptchalib.php inclusion error");
if(!require_once(__DOCUMENT_ROOT_PATH."classes/reCaptcha/recaptchaClass.php")) die("index.php: recaptchaClass.php inclusion error");

$section='blog';
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
include(__DOCUMENT_ROOT_PATH."blog/menu/menu.php");
include(__DOCUMENT_ROOT_PATH."ads/leftAd.php");
echo "</div>"; //leftContent div


if(!empty($_GET['category']))
{
	$category=$_GET['category'];
	
	if($_GET['category']=='General') {$blogHeader_lg=$General_lg;}
	if($_GET['category']=='AndroidOS') {$blogHeader_lg=$AndroidOS_lg;}
	if($_GET['category']=='AndroidDevices') {$blogHeader_lg=$AndroidDevices_lg;}
	if($_GET['category']=='Developing') {$blogHeader_lg=$Developing_lg;}
	if($_GET['category']=='Games') {$blogHeader_lg=$Games_lg;}
	if($_GET['category']=='Applications') {$blogHeader_lg=$Applications_lg;}
}


echo "<div id='centerBox'>";

if (empty($_GET['cnt']))
{
	//$category=0;
	echo "<h3 id='mainHeader'>".$blogHeader_lg."</h3>";
	centerboxbarClass::centerboxBar_blog($lg,$addpost_lg,$sort_lg);
//	$category=$_GET['category'];
	$sortby=sortingbarClass::$sortby;
	$sortDir=sortingbarClass::$sortdir;
	$startItem=$pcObject->get_na();
	$itemAmount=$pcObject->naop;
	$langPost=langCntrBoxBarClass::$pstlng;
	//dbClass::db_get_items_category($section, $category, $sortby, $sortDir, $startItem, $itemAmount);
	dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount,$langPost);
	
	if(!include("../blog/postList.php")) die("blog/index.php: blog/postList.php file inclusion error");
}

if (!empty($_GET['cnt'])&&$_GET['cnt']=='ctg')
{
	
	
	echo "<h3 id='mainHeader'>".$blogHeader_lg."</h3>";
	centerboxbarClass::centerboxBar_blog($lg,$addpost_lg,$sort_lg);
	
	//$category=$_GET['category'];
	$sortby=sortingbarClass::$sortby;
	$sortDir=sortingbarClass::$sortdir;
	$startItem=$pcObject->get_na();
	$itemAmount=$pcObject->naop;
	$langPost=langCntrBoxBarClass::$pstlng;
	dbClass::db_get_items_category($section, $category, $sortby, $sortDir, $startItem, $itemAmount,$langPost);
	//dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount);
	
	
	if(!include("../blog/postList.php")) die("blog/index.php: blog/postList.php file inclusion error");
}

if (!empty($_GET['cnt'])&&$_GET['cnt']=='srch')
{

	echo "<h3 id='mainHeader'>".$srchResHeader_lg."</h3>";
	centerboxbarClass::centerboxBar_blog($lg,$addpost_lg,$sort_lg);

//	$category=$_GET['category'];
	$sortby=sortingbarClass::$sortby;
	$sortDir=sortingbarClass::$sortdir;
	$startItem=$pcObject->get_na();
	$itemAmount=$pcObject->naop;
	$searchQuery=$_GET['sQ'];
	$search_where="Title LIKE '%$searchQuery%' OR  Content LIKE '%$searchQuery%'";
	$langPost=langCntrBoxBarClass::$pstlng;
	dbClass::db_get_items_search($section, $search_where, $sortby, $sortDir, $startItem, $itemAmount,$langPost);
//	dbClass::db_get_items_category($section, $category, $sortby, $sortDir, $startItem, $itemAmount);
	//dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount);

	if(!include("../blog/postList.php")) die("blog/index.php: blog/postList.php file inclusion error");
	//if(!include("../blog/search.php")) die("blog/index.php: blog/search.php file inclusion error");
}

if(!empty($_GET['cnt'])&&$_GET['cnt']=='iinfo')
{
	/*
	if($_GET['category']=='General') {$blogHeader_lg=$General_lg;}
	if($_GET['category']=='AndroidOS') {$category=1; $blogHeader_lg=$AndroidOS_lg;}
	if($_GET['category']=='AndroidDevices') {$category=2; $blogHeader_lg=$AndroidDevices_lg;}
	if($_GET['category']=='Developing') {$category=3; $blogHeader_lg=$Developing_lg;}
	if($_GET['category']=='Games') {$category=4; $blogHeader_lg=$Games_lg;}
	if($_GET['category']=='Applications') {$category=5; $blogHeader_lg=$Applications_lg;}
	*/
	
	echo "<h3 id='mainHeader'>".$blogHeader_lg." > ".$_GET['postn']."</h3>";
	if(!include("../blog/postWin.php")) die("blog/index.php: blog/postWin.php file inclusion error");
}


if(!empty($_GET['cnt'])&&$_GET['cnt']=='addp')
{
	echo "<h3 id='mainHeader'>".$addpostHeader_lg."</h3>";
	if(!include("../blog/addPost.php")) die("blog/index.php: blog/addPost.php file inclusion error");
}


if(!empty($_GET['cnt'])&&$_GET['cnt']=='pprev')
{
	echo "<h3 id='mainHeader'>".$postPrevHeader_lg."</h3>";
	if(!include("../blog/postPreview.php")) die("blog/index.php: blog/postPreview.php file inclusion error");
}

if(!empty($_GET['cnt'])&&$_GET['cnt']=='psubm')
{
	echo "<h3 id='mainHeader'>".$postSubmittedHeader_lg."</h3>";
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
echo "<h3 id='mainHeader'>$suggestApp_lg</h3>";
suggestItemClass::setSuggestItems_blog($lg);

include(__DOCUMENT_ROOT_PATH.'ads/rightAd.php');
echo "</div>"; //rightBox div

//mysql_close($db_server);

include(__DOCUMENT_ROOT_PATH."templates/footer.php");



?>