<?php
class fixipClass
{
	function __construct()
	{
	
	}

	function fixip($rate,$itemid) 
	{
		//$fixipPerm = "TEST";
	
		$url_without_rate=str_replace('&rate='.$rate,'', __CURRENT_URL);
		
		$gi = $_SERVER['REMOTE_ADDR']."\n";
		
		$fixipPerm=0;
		if(!empty($_COOKIE[$itemid])) 
		{
			
			
			header('Location: '.$url_without_rate);
			
		}
		else 
		{
			$fixipPerm = 1;
			setcookie($itemid, $gi, time()+86400);
			header('Location: '.$url_without_rate);
			
		} 
	return $fixipPerm;
	
	}
}
?>