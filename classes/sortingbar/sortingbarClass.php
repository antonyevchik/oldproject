<?php
if(!require_once(__DOCUMENT_ROOT_PATH."classes/createLink/createLinkClass.php")) die("sortingbarClass.php: createLinkClass.php inclusion error");
class sortingbarClass
{
	public static $sortby='Rate';
	public static $sortdir=0;
	function __construct()
	{
		
	}
	
	
	
	public static function set_sorting_bar_apps($lg)
	{
		$sign_get_link='';
		
		
		$selected_name_0='';
		$selected_name_1='';
		$selected_developer_0='';
		$selected_developer_1='';
	//	$selected_publishDate_0='';
	//	$selected_publishDate_1='';
		$selected_rating='';
		
		//if(preg_match("/?sortby/", __CURL_WITHOUT_LANG)|| empty($_GET))	$sign_get_link='?';
		//if(preg_match("/&sortby/", __CURL_WITHOUT_LANG)|| (!empty($_GET)&&empty($_GET['sortby'])))	$sign_get_link='&';
		
		
		$exluded_elements[0]='sortby';
		$exluded_elements[1]='l';
		
		$location=createLinkClass::linkExcludedElements($exluded_elements);
		
		if (strpos( $location,"?")===false) $sign_get_link='?'; else $sign_get_link='&';
		//echo $location;
		
	
		if($_GET['sortby'])
		{
			//$curl=str_replace($sign_get_link.'sortby='.$_GET['sortby'], '', __CURL_WITHOUT_LANG);
				
			if($_GET['sortby']=='name_1') $selected_name_1='selected';
			if($_GET['sortby']=='name_0') $selected_name_0='selected';
			if($_GET['sortby']=='Developer_1') $selected_developer_1='selected';
			if($_GET['sortby']=='Developer_0') $selected_developer_0='selected';
		//	if($_GET['sortby']=='publishDate_1') $selected_publishDate_1='selected';
		//	if($_GET['sortby']=='publishDate_0') $selected_publishDate_0='selected';
			if($_GET['sortby']=='rating') $selected_rating='selected';
				
		}
		if(!$_GET['sortby'])
		{
			//$curl=__CURL_WITHOUT_LANG;
				
			$selected_rating='selected';
		}
		echo "<script>
				function submit_sortby()
				{
					var sortby=document.getElementById('sortby').value;
					location='".$location.$sign_get_link."sortby='+sortby+'&l=".$lg."';
				}
			  </script>";
	
	
		echo "
					<select id='sortby' name='sortby' onchange='submit_sortby()' style='width: 100px;'>
					<option value='name_1' ".$selected_name_1.">".__SORT_APPNAME_AZ_LG."</option>
					<option value='name_0' ".$selected_name_0.">".__SORT_APPNAME_ZA_LG."</option>
					<option value='Developer_0' ".$selected_developer_0.">".__SORT_DEVELOPER_AZ_LG."</option>
					<option value='Developer_1' ".$selected_developer_1.">".__SORT_DEVELOPER_ZA_LG."</option>
			<!--	<option value='publishDate_0' ".$selected_publishDate_0.">".__SORT_PUBLISHING_NEW_LG."</option>
					<option value='publishDate_1' ".$selected_publishDate_1.">".__SORT_PUBLISHING_OLD_LG."</option> -->
					<option value='rating' ".$selected_rating.">".__SORT_RATING_LG."</option>
					</select>
			  ";
	
		if($_GET['sortby'])
		{
			if($_GET['sortby']=='name_1') {self::$sortby='Name'; self::$sortdir=1;}
			if($_GET['sortby']=='name_0') {self::$sortby='Name'; self::$sortdir=0;}
			if($_GET['sortby']=='Developer_1') {self::$sortby='Developer'; self::$sortdir=1;}
			if($_GET['sortby']=='Developer_0') {self::$sortby='Developer'; self::$sortdir=0;}
		//	if($_GET['sortby']=='publishDate_0') {self::$sortby='Date'; self::$sortdir=0;}
		//	if($_GET['sortby']=='publishDate_1') {self::$sortby='Date'; self::$sortdir=1;}
			if($_GET['sortby']=='rating') {self::$sortby='Rate'; self::$sortdir=0;}
		}
	}
	
	
	
	public static function set_sorting_bar_blog($lg) 
	{
		$sign_get_link='';
		//$curl='';
		
		$selected_title_0='';
		$selected_title_1='';
		$selected_authorName_0='';
		$selected_authorName_1='';
		$selected_publishDate_0='';
		$selected_publishDate_1='';
		$selected_rating='';
		
		
		//if(preg_match("/?sortby/", __CURL_WITHOUT_LANG)|| empty($_GET))	$sign_get_link='?';
		//if(preg_match("/&sortby/", __CURL_WITHOUT_LANG)|| (!empty($_GET)&&empty($_GET['sortby'])))	$sign_get_link='&';
		
		

		$excluded_elements_blog[0]='sortby';
		$excluded_elements_blog[1]='l';
		
		$location=createLinkClass::linkExcludedElements($excluded_elements_blog);
		
		//$excluded_elements=array("?sortby=".$_GET['sortby'],"&sortby=".$_GET['sortby']);
		//$location=str_replace($excluded_elements, '', __CURL_WITHOUT_LANG);
		
		
		if (!strpos( $location,"?")) $sign_get_link='?'; else $sign_get_link='&';
		//echo $location;
		
		
		if($_GET['sortby']) 
		{
			//$curl=str_replace($sign_get_link.'sortby='.$_GET['sortby'], '', __CURL_WITHOUT_LANG);
			
			if($_GET['sortby']=='title_1') $selected_title_1='selected';
			if($_GET['sortby']=='title_0') $selected_title_0='selected';
			if($_GET['sortby']=='authorName_1') $selected_authorName_1='selected';
			if($_GET['sortby']=='authorName_0') $selected_authorName_0='selected';
			if($_GET['sortby']=='publishDate_1') $selected_publishDate_1='selected';
			if($_GET['sortby']=='publishDate_0') $selected_publishDate_0='selected';
			if($_GET['sortby']=='rating') $selected_rating='selected';
			
		}
		if(!$_GET['sortby']) 
		{
			//$curl=__CURL_WITHOUT_LANG;
			
			$selected_rating='selected';
		}
		echo "<script>	
				function submit_sortby()
				{
					var sortby=document.getElementById('sortby').value;
					location='".$location.$sign_get_link."sortby='+sortby+'&l=".$lg."';
				}							
			  </script>";

		
		echo "
					<select id='sortby' name='sortby' onchange='submit_sortby()' style='width: 100px;'>
					<option value='title_1' ".$selected_title_1.">".__SORT_TITLE_AZ_LG."</option>
					<option value='title_0' ".$selected_title_0.">".__SORT_TITLE_ZA_LG."</option>
					<option value='authorName_0' ".$selected_authorName_0.">".__SORT_AUTHORNAME_AZ_LG."</option>
					<option value='authorName_1' ".$selected_authorName_1.">".__SORT_AUTHORNAME_ZA_LG."</option>
					<option value='publishDate_0' ".$selected_publishDate_0.">".__SORT_PUBLISHINGDATE_NEW_LG."</option>
					<option value='publishDate_1' ".$selected_publishDate_1.">".__SORT_PUBLISHING_OLD_LG."</option>
					<option value='rating' ".$selected_rating.">".__SORT_RATING_LG."</option>
					</select>
			  ";
				
		if($_GET['sortby'])
		{
			if($_GET['sortby']=='title_1') {self::$sortby='Title'; self::$sortdir=1;}
			if($_GET['sortby']=='title_0') {self::$sortby='Title'; self::$sortdir=0;}
			if($_GET['sortby']=='authorName_1') {self::$sortby='Author_Name'; self::$sortdir=1;}
			if($_GET['sortby']=='authorName_0') {self::$sortby='Author_Name'; self::$sortdir=0;}
			if($_GET['sortby']=='publishDate_0') {self::$sortby='Date'; self::$sortdir=0;}
			if($_GET['sortby']=='publishDate_1') {self::$sortby='Date'; self::$sortdir=1;}
			if($_GET['sortby']=='rating') {self::$sortby='Rate'; self::$sortdir=0;}
		}
	}
	
	
	public static function set_sorting_bar_news($lg)
	{
		$selected_title_0='';
		$selected_title_1='';
		$selected_authorName_0='';
		$selected_authorName_1='';
		$selected_publishDate_0='';
		$selected_publishDate_1='';
		$selected_rating='';
	
		if(preg_match("/?sortby/", __CURL_WITHOUT_LANG)|| empty($_GET))	$sign_get_link='?';
		if(preg_match("/&sortby/", __CURL_WITHOUT_LANG)|| (!empty($_GET)&&empty($_GET['sortby'])))	$sign_get_link='&';
	
		if($_GET['sortby'])
		{
			$curl=str_replace($sign_get_link.'sortby='.$_GET['sortby'], '', __CURL_WITHOUT_LANG);
				
			if($_GET['sortby']=='title_1') $selected_title_1='selected';
			if($_GET['sortby']=='title_0') $selected_title_0='selected';
			if($_GET['sortby']=='authorName_1') $selected_authorName_1='selected';
			if($_GET['sortby']=='authorName_0') $selected_authorName_0='selected';
			if($_GET['sortby']=='publishDate_1') $selected_publishDate_1='selected';
			if($_GET['sortby']=='publishDate_0') $selected_publishDate_0='selected';
			if($_GET['sortby']=='rating') $selected_rating='selected';
				
		}
		if(!$_GET['sortby'])
		{
			$curl=__CURL_WITHOUT_LANG;
				
			$selected_rating='selected';
		}
		echo "<script>
				function submit()
				{
					var sortby=document.getElementById('sortby').value;
					location='".$curl.$sign_get_link."sortby='+sortby+'&l=".$lg."';
				}
			  </script>";
	
	
		echo "
					<select id='sortby' name='sortby' onchange='submit()' style='width: 100px;'>
					<option value='title_1' ".$selected_title_1.">Title (A > Z)</option>
					<option value='title_0' ".$selected_title_0.">Title (Z > A)</option>
					<option value='authorName_0' ".$selected_authorName_0.">Author Name (A > Z)</option>
					<option value='authorName_1' ".$selected_authorName_1.">Author Name (Z > A)</option>
					<option value='publishDate_0' ".$selected_publishDate_0.">Publishing Date (New first)</option>
					<option value='publishDate_1' ".$selected_publishDate_1.">Publishing Date (old first)</option>
					<option value='rating' ".$selected_rating.">Rating</option>
					</select>
			  ";
	
		if($_GET['sortby'])
		{
			if($_GET['sortby']=='title_1') {self::$sortby='Title'; self::$sortdir=1;}
			if($_GET['sortby']=='title_0') {self::$sortby='Title'; self::$sortdir=0;}
			if($_GET['sortby']=='authorName_1') {self::$sortby='Author_Name'; self::$sortdir=1;}
			if($_GET['sortby']=='authorName_0') {self::$sortby='Author_Name'; self::$sortdir=0;}
			if($_GET['sortby']=='publishDate_0') {self::$sortby='Date'; self::$sortdir=0;}
			if($_GET['sortby']=='publishDate_1') {self::$sortby='Date'; self::$sortdir=1;}
			if($_GET['sortby']=='rating') {self::$sortby='Rate'; self::$sortdir=0;}
		}
	}
	
	
	
	
	
	
}

?>