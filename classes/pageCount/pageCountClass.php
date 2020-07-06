<?php
class pageCount
{
	
/*	
	function __construct()
	{
		
	}
*/	
	
	
//	var $startPage=12;
	
	
	public $naop = 3; // The number of apps per page;
	public $pn;       // The page number;
	public $na;       // The number of apps already are listed befor current page;
	
public function get_na() // Function return the number of apps already are listed befor current page;
	{
//		$naop=10;
		if (isset($_GET['pn']))	$this->pn = $_GET['pn'];
		if($this->pn=='') $this->pn=1;
		if($this->pn==1) $na=0;
		else {$na = ($this->pn-1)*$this->naop;}
		return $na;
	}
	
	
	
public  function pageNmbrPrnt($pp,$lg)
	{
//		echo $pp;
//		$naop=10;
		$curl=str_replace('&pn='.$_GET['pn'], '', __CURL_WITHOUT_LANG);
		if ($pp==0) $pp=1;
		if (isset($_GET['pn']))	$this->pn = $_GET['pn'];
		//BEGIN PAGES COUNT CODE
		if($pp/$this->naop>=10)
		{
			$sp=$this->pn-2; $lp=$this->pn+2; 
			if($lp>$pp) {$lp=$pp; $sp=$pp-4;}
			if($sp<=0) {$sp=1; $lp=5;}
		}
		
		else 
		{
			$sp=1; $lp=ceil($pp/$this->naop);
		}
	
		if($pp>$this->naop)
		{	
			if($this->pn!=1) echo "<a href='".$curl."&pn=".($this->pn-1)."&l=".$lg."'> < </a>";
		
			for($p=$sp; $p<=$lp; $p++) 
			{	
				if($p==$this->pn) echo "<a href='".$curl."&pn=".$p."&l=".$lg."'> &nbsp <b>".$p."</b> &nbsp</a>";	
				else echo "<a href='".$curl."&pn=".$p."&l=".$lg."'> &nbsp ".$p." &nbsp</a>";	
			}
		
			if($this->pn!=$lp) echo "<a href='".$curl."&pn=".($this->pn+1)."&l=".$lg."'> > </a>";
		}
		
//END PAGES COUNT CODE
	}
}
?>