<?php

if(isset($_GET['category']))
		{
		$category=$_GET['category'];
		$app=$_GET['app'];
		$an=$_GET['an'];
		$lg=$_GET['l'];
		}
		
if(!empty($_GET['rate'])&&fixip())
{	
	$ipPermit=1;
	header('Location: /?cnt=ainfo&category='.$category.'&app='.$app.'&an='.$an.'&l='.$lg);
	//$hRateoutput = "<script>location.href='/?cnt=ainfo&category=".$category."&app=".$app."&an=".$rowRead[3]."&l=".$lg."</script>";
}
if(!empty($_GET['rate'])&&!fixip())  
{		
		$ipPermit=0;
   	$rmsg = "You Already Rated This App Today!";   
   	//$hRateoutput = "<script>location.href='/?cnt=ainfo&category=".$category."&app=".$app."&an=".$rowRead[3]."&l=".$lg."</script>";
   	header('Location: /?cnt=ainfo&category='.$category.'&app='.$app.'&an='.$an.'&l='.$lg);
   	
}
?>