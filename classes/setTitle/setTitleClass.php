<?php
//if(!include("/var/www/html/android-lifestyle_t2/constans.php")) die ("ERROR: constans.php file inclusion error");

class setTitleClass
{
	
	public static $title;
	function __construct()
	{
	
	}
	
	public static function setTitle()
	{
		if(!empty($_GET['cnt']))
		{
			if($_GET['cnt']=='ctg') self::$title = $_GET['category'];
			if($_GET['cnt']=='srch') self::$title = $_GET['sQ'];
			if(!empty($_GET['appn'])) self::$title = $_GET['appn'];
			if(!empty($_GET['postn'])) self::$title = $_GET['postn'];
			
			//if($_GET['cnt']=='news') self::$title = "News";
			//if($_GET['cnt']=='fnws') self::$title = $_GET['nn'];
			if($_GET['cnt']=='terms') self::$title = $terms_lg;
			//if($_GET['cnt']=='terms'&&$_GET['l']=='ru') self::$title = "Условия использования";
		}
		if (empty($_GET['cnt']))
		{
			if(strpos(__CURRENT_URL,"/apps")) self::$title=__APPS_LG;
			if(strpos(__CURRENT_URL,"/blog")) self::$title=__BLOG_LG;
			if(strpos(__CURRENT_URL,"/news")) self::$title=__NEWS_LG;
			//self::$title = "Main";
		}
		
		return self::$title;
		//self::$titleName=$titleName;
	}
	
}

?>