<?php
function fixip() 
{
$app = $_GET['app'];
$gi = $_SERVER['REMOTE_ADDR']."\n";
$perm = 1;
if(!empty($_COOKIE[$app]))  $perm = 0;
	else 
	{
		setcookie($app, $gi, time()+86400);
	}
return $perm;
}
?>