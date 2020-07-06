<?php
if(!require_once(__DOCUMENT_ROOT_PATH."classes/createLink/createLinkClass.php")) die("langCntrBoxBarClass.php: createLinkClass.php inclusion error");

class langCntrBoxBarClass
{
	public static $pstlng='all';
	
	function __construct()
	{
	
	}
	
	public static function langCntrBoxBar($lg)
	{
		$excluded_elements=array();
		$sign_get_link='';
		
		$excluded_elements[0]='pstlng';
		$excluded_elements[1]='l';
		//$excluded_elements[0][1]='lang_en';

		$location=createLinkClass::linkExcludedElements($excluded_elements);
		//echo createLinkClass::linkExcludedElements($excluded_elements);
		//createLinkClass::linkExcludedElements($excluded_elements);
		
		//$excluded_elements=array("?pstlng=".$_GET['pstlng'],"&pstlng=".$_GET['pstlng']);
		//$location=str_replace($excluded_elements, '', __CURL_WITHOUT_LANG);

		if (!strpos( $location,"?")) $sign_get_link='?'; else $sign_get_link='&';
		//echo $location;
		
		
		//echo implode('=', $a);
		for ($i=0; $i<sizeof($a);$i++)
		{
			//for ($j=0;sizeof($a[$i]);$j++)
			//{
				echo $a[$i][0]."=".$a[$i][1].'&';
			//}
		}
		
		if (empty($_GET['pstlng'])) 
		{
			if ($lg=='en') {self::$pstlng='en'; $selected_lang_en='selected';}
			if ($lg=='ru') {self::$pstlng='ru'; $selected_lang_ru='selected';}
		}
		//if (empty($_GET['pstlng'])&&$_GET['l']=='ru') {self::$pstlng='ru'; $selected_lang_ru='selected'; }
		
		if($_GET['pstlng'])
		{
			
			
			if($_GET['pstlng']=='lang_en') {self::$pstlng='en'; $selected_lang_en='selected'; }
			if($_GET['pstlng']=='lang_ru') {self::$pstlng='ru'; $selected_lang_ru='selected'; }
			if($_GET['pstlng']=='lang_all') {self::$pstlng='all'; $selected_lang_all='selected'; }
		}
		if(empty($_GET['pstlng'])&&empty($_GET['l'])) { $selected_lang_all='selected'; }
		
	
		echo "<script>
			 
				function submit_lang()
				{
					var pstlng=document.getElementById('pstlng').value;
					location='".$location.$sign_get_link."pstlng='+pstlng+'&l=".$lg."';
				} 
			  </script>";
				
		echo "
				<select id='pstlng' name='pstlng' onchange='submit_lang()' >
				<option value='lang_en' ".$selected_lang_en.">English</option>
				<option value='lang_ru' ".$selected_lang_ru.">Русский</option>
				<option value='lang_all' ".$selected_lang_all.">All</option>
				</select>
			  ";
	}
}

?>