<?php

if($_GET['postn']) {$postn=$_GET['postn']; $itemTitle=$_GET['postn'];}
if($_GET['rate']) $rate=$_GET['rate'];
if($_GET['itemid']) $itemid=$_GET['itemid'];

for ($j=0;$j<sizeof($langs_array);$j++) {$replaceNeedle[$j]="_".$langs_array[$j];}
$itemid_wl=str_replace($replaceNeedle, '', $itemid);  // id without language tail ('_en' or '_ru')

$link=__ROOT_PATH.$section."/?cnt=iinfo&category=$category&postn=$postn&itemid=$itemid&l=$lg";

$rall=dbClass::db_get_item_allinfo($section, $itemid);

$authorName=$rall[0];
$postDate=$rall[1];
$postContent=$rall[4];

echo "<h1>".$itemTitle."</h1><br>";

dbClass::db_set_rating($section, $rate, $fixipPerm, $itemid, $link, $rate_lg, $votes_lg);

echo "<b>".$AuthorName_lg."</b>&nbsp".$authorName.";&nbsp&nbsp<b>".$postDate_lg."</b>&nbsp".$postDate;
echo "<br>";
echo "<div id='post_description_Content'>";
echo $postContent;
echo "</div>";
echo "<br>";



$mesPath=__DOCUMENT_ROOT_PATH."blog/blogPosts/".$itemid_wl."/";
$mesBufferPath=__DOCUMENT_ROOT_PATH."messages/blog_mes_files/";

echo "<div style='position: relative; clear: both; top: 20px;'>";
echo "<h3 id='mainHeader'>Comments</h3>";
echo "<br>";
messagesClass::messages($itemTitle, $mesPath, $mesBufferPath, $itemid_wl);
echo "</div>";

?>