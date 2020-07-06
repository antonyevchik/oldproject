<?php

if(!require_once(__DOCUMENT_ROOT_PATH."classes/sortingbar/sortingbarClass.php")) die("centerBoxBarClass.php: sortingbarClass.php inclusion error");
if(!require_once(__DOCUMENT_ROOT_PATH."classes/langCntrBoxBar/langCntrBoxBarClass.php")) die("centerBoxBarClass.php: sortingbarClass.php inclusion error");

class centerboxbarClass
{
	function __construct()
	{
	
	}
	
	public static function centerboxBar_apps($lg,$additem_lg,$sort_lg)
	{
		//if(!require_once("../constans.php")) die ("ERROR: constans.php file inclusion error");

		echo "<div id='centerboxBarClass' style='margin-left: 10px; margin-right: 10px; padding: 0px 5px 0px 5px; background-color: #ededed;'>";
		echo __SORT_LG." "; sortingbarClass::set_sorting_bar_apps($lg);
		echo __LANG_CNTRBOX_LG." "; langCntrBoxBarClass::langCntrBoxBar($lg);
		echo "<a href='".__ROOT_PATH."apps/?cnt=adda&l=".$lg."' style='color: red; float: right;'><b>+ ".$additem_lg."</b></a>";
		echo "</div>";	
	}
	
	public static function centerboxBar_blog($lg,$additem_lg,$sort_lg)
	{
		//if(!require_once("../constans.php")) die ("ERROR: constans.php file inclusion error");
		echo "<div id='centerboxBar' style='max-height: 50px; margin-left: 10px; margin-right: 10px; padding: 0px 5px 0px 5px; background-color: #ededed;'>";
		echo __SORT_LG." "; sortingbarClass::set_sorting_bar_blog($lg);
		echo __LANG_CNTRBOX_LG." "; langCntrBoxBarClass::langCntrBoxBar($lg);
		echo "<a href='".__ROOT_PATH."blog/?cnt=addp&l=".$lg."' style='color: red; float: right;'><b>+".$additem_lg."</b></a>";
		echo "</div>";
	}
};
?>