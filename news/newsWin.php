<?php

if($_GET['newsn']) {$appn=$_GET['newsn']; $itemTitle=$_GET['newsn'];}
if($_GET['rate']) $rate=$_GET['rate'];
if($_GET['itemid']) $itemid=$_GET['itemid'];

$link=__ROOT_PATH.$section."/?cnt=iinfo&category=$category&newsn=$appn&itemid=$itemid&l=$lg";

$rall=dbClass::db_get_item_allinfo($section, $itemid);

echo "<h2>".$itemTitle."</h2><br>";

dbClass::db_set_rating($section, $rate, $fixipPerm, $itemid, $link, $rate_lg, $votes_lg);

echo "<b>".$AuthorName_lg."</b>&nbsp".$rall[0].";&nbsp&nbsp<b>".$postDate_lg."</b>&nbsp".$rall[1];

echo "<br>";

$mesPath=__DOCUMENT_ROOT_PATH."news/newsstore/".$itemid."/";
$mesBufferPath=__DOCUMENT_ROOT_PATH."messages/news_mes_files/";

messagesClass::messages($itemTitle, $mesPath, $mesBufferPath, $itemid);

?>
