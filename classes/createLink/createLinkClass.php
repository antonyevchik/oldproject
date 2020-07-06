<?php

class createLinkClass
{

	function __construct()
	{
	
	}
	
	
	public static function createLink()
	{
		
	}
	
	public static function addToCurrentLink($array_link)
	{
		$add_to_end_permit=1;
		$construct_link='?';
		$curl=__CURL_WITHOUT_LANG;
		$elem1=explode('?', $curl);
		$elem2=explode('&', $elem1[1]);
		
		if($elem1[1])
		{
			for ($i=0;$i<sizeof($elem2);$i++)
			{
				$result[$i]=explode('=', $elem2[$i]);
			
				for ($j=0;$j<sizeof($array_link);$j++)
				{
					if($result[$i][0]==$array_link[$j][0])
					{
						$result[$i][1]=$array_link[$j][1];
						$add_to_end_permit=0;
					}
				}
			}
		
			if ($add_to_end_permit==1)
			{
				for ($j=0;$j<sizeof($array_link);$j++)
				{
					$final_element=sizeof($result);
					$result[$final_element+$j][0]=$array_link[$j][0]; $result[$final_element+$j][1]=$array_link[$j][1];
				}
			}
		
			for ($l=0;$l<sizeof($result);$l++)
			{
				$and_sign='&';
				if($l==sizeof($result)-1) $and_sign='';
				$construct_link=$construct_link.$result[$l][0]."=".$result[$l][1].$and_sign;
			}
		}
		
		if (!$elem1[1])
		{
			for ($l=0;$l<sizeof($array_link);$l++)
			{
				$and_sign='&';
				if($l==sizeof($array_link)-1) $and_sign='';
				$construct_link=$construct_link.$array_link[$l][0]."=".$array_link[$l][1].$and_sign;
			}
		}
		
		//if ($add_to_end_permit) {$result[sizeof($result)+1][0]=}
		
		$final_link=__DOCUMENT_ROOT_PATH.$construct_link;
		return $final_link;
	}
	
	public static function linkExcludedElements($excluded_elements)
	{
		$add_to_end_permit=1;
		$l=0;
		$construct_link='?';
		$curl=__CURL_WITHOUT_LANG;
		$elem1=explode('?', $curl);
		$get_array=$_GET;
		
		if(!empty($get_array))
		{
			for ($i=0; $i<sizeof($excluded_elements); $i++)
			{
				$exce=$excluded_elements[$i];
				if(!empty($get_array["$exce"])) unset($get_array["$exce"]);
			}
			$get_size=sizeof($get_array);
			
			foreach ($get_array as $key => $value)
			{
				
				$and_sign='&';
				if($l==($get_size-1)) $and_sign='';
				$construct_link=$construct_link.$key."=".$value.$and_sign;
				//echo $l." ".$get_size-1;
				$l++;
			}
		}
		if(empty($get_array)||(sizeof($get_array)==sizeof($excluded_elements))) 
		{
			$construct_link='';
		}
		
		/*
		$elem1=explode('?', $curl);
		$elem2=explode('&', $elem1[1]);
		
		if($elem1[1])
		{
			for ($i=0;$i<sizeof($elem2);$i++)
			{
				$result[$i]=explode('=', $elem2[$i]);
				
				for ($j=0;$j<sizeof($excluded_elements);$j++)
				{
					if($result[$i][0]==$excluded_elements[$j])
					{
						unset($result[$i]);
						//$add_to_end_permit=0;
					}
				}
			}
		
			if ($add_to_end_permit==1)
			{
				for ($j=0;$j<sizeof($array_link);$j++)
				{
					$final_element=sizeof($result);
					$result[$final_element+$j][0]=$array_link[$j][0]; $result[$final_element+$j][1]=$array_link[$j][1];
				}
			}
			
			if (sizeof($result)!=0)
			{
				for ($l=0;$l<sizeof($result);$l++)
				{
					$and_sign='&';
					//if($l==sizeof($result)-1) $and_sign='';
					$construct_link=$construct_link.$result[$l][0]."=".$result[$l][1].$and_sign;
				}
			}
		}
		
		if (!$elem1[1])
		{
			$construct_link='';
			
		}*/
		
		
		
		$final_link=$elem1[0].$construct_link;
		return $final_link;
		//return $_GET['pstlng'];
	}
	
}

?>