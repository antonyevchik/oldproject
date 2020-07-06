<?php
if(!require_once __DOCUMENT_ROOT_PATH.'classes/dbase/dbClass.php') die("suggestItemClass.php: dbClass.php inclusion error");

class suggestItemClass
{
	function __construct()
	{
	
	}
	
	public static function setSuggestItems_apps($lg)
	{
		$section='apps';
		$sortby='Rate';
		$sortDir=0;
		$startItem=0;
		$itemAmount=10;
		$langPost=$lg;
		dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount,$langPost);
		$rall=dbClass::$rall;
	
		echo "<br>";
		for ($i=0;$i<10;$i++)
		{
			$item=$rall[$i][2];
			$itemid=$rall[$i][13];
			$category=explode(',', $rall[$i][12]);
			echo "<a href='?cnt=iinfo&category=".$category[0]."&appn=".$item."&itemid=".$itemid."&l=".$lg."'>";
			echo "<h3 id='topicHeader'>".$item."</h3><br>";
			echo "</a>";
		}
	}
	
	
	public static function setSuggestItems_blog($lg)
	{
		$section='blog';
		$sortby='Rate';
		$sortDir=0;
		$startItem=0;
		$itemAmount=10;
		$langPost=$lg;
		dbClass::db_get_items_random($section, $sortby, $sortDir, $startItem, $itemAmount,$langPost);
		$rall=dbClass::$rall;
		
		echo "<br>";
		for ($i=0;$i<10;$i++)
		{
			$item=$rall[$i][2];
			$itemid=$rall[$i][9];
			$category=explode(',', $rall[$i][5]);
			echo "<a href='?cnt=iinfo&category=".$category[0]."&postn=".$item."&itemid=".$itemid."&l=".$lg."'>";
			echo "<h3 id='topicHeader'>".$item."</h3><br>";
			echo "</a>";
		}
	}
}

?>