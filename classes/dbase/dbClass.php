<?php

class dbClass
{
	//public static $gr;
	
	//public static $db_apps		= 'androapps';
	//public $db_news     = 'news';
	
	public static $db_hostname = 'localhost';
	public static $db_aldb	   = 'androidli_aldb';
	public static $db_username = 'anton';
	public static $db_password = 'foT0nic_mysql';
	
	/*
	public static $db_hostname = 'db13.freehost.com.ua';
	public static $db_aldb	   = 'androidli_aldb';
	public static $db_username = 'androidli_al';
	public static $db_password = 'foT0nic';
	*/
	
	public static $db_server;
	public $insertTable_query;
	public static $tableTitles;
	public static $tableTitles_blog='(Author_Name,Date,Title,Short_Descrip,Content,Category,RateSum,RateCount,Rate,Id)';
	public static $tableTitles_apps='(Author_Name,Date,Name,Version,Android_Version,Developer,Size,RateSum,RateCount,Rate,Short_Descrip,Description,Category,Id)';
	public static $tableTitles_news='(Author_Name,Date,Title,Description,Category,RateSum,RateCount,Rate,Id)';
	public static $tableRow    = '(';
	
	public static $rall;
	public static $pp;
	//	public $db_allTabs_array='$allTabs';
	//	public $dbase;

	public $firstItemNum; // first item number on current page
	public $itemsPerPage; // number of items per page

	function __construct()
	{

	}

	public static function test($gr)
	{
		//self::$test="TESTEERER";
		//echo "TESTE";
		return $gr;
	}

	public static function db_connect()
	{
		self::$db_server=mysqli_connect(self::$db_hostname, self::$db_username, self::$db_password);
		if(!mysqli_query(self::$db_server,"SET NAMES 'cp1251'")) die("dbClass.php: error when setting encoding 'cp1251'");
		if(!mysqli_query(self::$db_server,"SET sql_mode='ANSI_QUOTES';")) die("dbClass.php: error when setting sql_mode='ANSI_QUOTES'");
	}
	public static function db_select($dbase)
	{
	    if(!mysqli_select_db(self::$db_server,$dbase)) die("dbClass.php[db_select()]: database selection error". mysql_error());
	}

	
	public static function db_set_rating($section,$rate,$fixipPerm,$itemid,$link,$rate_lg,$votes_lg)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
	
			$resultRead=mysqli_query("SELECT Rate, RateSum, RateCount FROM \"$section\" WHERE Id='$itemid'");
			if(!$resultRead) die('database access error'. mysql_error());
			$rowRead = mysqli_fetch_row($resultRead);
		
		if($fixipPerm)
		{	
			$submitRate = $rate;
			$rowRead[2]++;
			$resultSum = $submitRate+$rowRead[1];
			$rate = $resultSum/$rowRead[2];
		
			$queryWrite="UPDATE \"$section\" SET RateSum='$resultSum', RateCount='$rowRead[2]', Rate='$rate' WHERE Id='$itemid'";
			$resultWrite=mysql_query($queryWrite);
			if(!$resultWrite) die('database access error'. mysql_error());
		
		}
		if(!$fixipPerm) 
		{
			
		
		}
			$r = round($rowRead[0], 1);
			$ir = floor($r);
			$fr = $r-$ir;
		
			echo "<b>".$rate_lg."&nbsp;".$r."&nbsp;&nbsp;&nbsp;".$votes_lg."&nbsp;".$rowRead[2]."</b>";
			echo "<img src=\"rating/space.png\" onload=\"getRate($ir ,$fr ,'$itemid')\" />";
		
			echo "<div id='rating' >";
			for($i=1;$i<=5;$i++)
			{
			echo "<img border=\"0\" hspace=\"0\" src=\"rating/0.png\" id=\"r$i$itemid\" onclick='location=\"".$link."&rate=".$i."\"' onmouseover=\"getRate( $i ,0, '$itemid' )\" onmouseout=\"getRate( $ir , $fr , '$itemid' )\"/></a>";
			}	
			echo "</div>";
			
		
	}
	
	
	function db_insert_into_table($section,$category,$tableRow)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
		if ($section=='apps') self::$tableTitles=self::$tableTitles_apps;
		if ($section=='blog') self::$tableTitles=self::$tableTitles_blog;
		if ($section=='news') self::$tableTitles=self::$tableTitles_news;

		for ($i=0;$i<sizeof($tableRow);$i++)
		{
			$addPart1="'".$tableRow[$i]."'";
			if($i==sizeof($tableRow)-1) $addPart2=")"; else $addPart2=",";
			$addPart=$addPart1.$addPart2;
			self::$tableRow.=$addPart;
		}

		$this->insertTable_query="INSERT INTO \"".$section."\" ".self::$tableTitles." VALUES ".self::$tableRow;
		if(!mysqli_query($this->insertTable_query, self::$db_server)) die("dbClass.php[db_insert_into_table()]: error when inserting  new row into table");
		if(!mysqli_close(self::$db_server)) die("dbClass.php[db_insert_into_table()]: problem with closing the mysql connection");
	}
	
	function db_update_item_info($section,$itemid,$tableTitles,$tableRow)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
		$queryWrite="UPDATE \"$section\" SET $tableRow WHERE Id='$itemid'";
		$resultWrite=mysqli_query($queryWrite);
		if(!$resultWrite) die('dbClass.php[db_update_item_info()]:database access error'. mysql_error());
	}


	function db_idGenerator($lang,$manualId)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
		if($manualId)
		{
				
			$queryTab="SHOW TABLES";
			$resultTab=mysqli_query($queryTab,self::$db_server);
			if(!$resultTab) die("database access error". mysql_error());
			$rowsTab=mysqli_num_rows($resultTab);
			
			for($i=0; $i<$rowsTab; ++$i)
			{
				$rowTab = mysqli_fetch_row($resultTab);
				$querySrch="SELECT Id FROM \"".$rowTab[0]."\" WHERE Id='$manualId'";
				$resultSrch=mysqli_query($querySrch,self::$db_server);
				if($resultSrch)
				{
					$rowsSrch=mysqli_num_rows($resultSrch);
					if($rowsSrch)	{
						$i=$rowsTab; die('ERROR(dbClass.php[db_idGenerator()]): This ID already exist');
					}
				}
			}
			return $manualId;
			
		}
		
		if(!$manualId)
		{
			$perm = 1;
			while($perm)
			{
				$n = rand(0, 9999);
				if($n < 1000)
				{
					if($n < 10) {	$n = "000".$n;	}
					if($n >= 10 && $n < 100) {	$n = "00".$n;	}
					if($n >= 100 && $n < 1000) {	$n = "0".$n;	}
				}
				$varOut = "idn_".$n."_".$lang;

				$perm = 0;

				$queryTab="SHOW TABLES";
				$resultTab=mysqli_query($queryTab,self::$db_server);
				if(!$resultTab) die("database access error". mysql_error());
				$rowsTab=mysqli_num_rows($resultTab);

				for($i=0; $i<$rowsTab; ++$i)
				{
					$rowTab = mysqli_fetch_row($resultTab);
					$querySrch="SELECT Id FROM \"".$rowTab[0]."\" WHERE Id='$varOut'";
					$resultSrch=mysqli_query($querySrch,self::$db_server);
					if($resultSrch)
					{
						$rowsSrch=mysqli_num_rows($resultSrch);
						if($rowsSrch)	{
							$i=$rowsTab; $perm=1;
						}
					}
				}
			}
		}
		return $varOut;

		if(!mysqli_close(self::$db_server)) die("dbClass.php[db_insert_into_table()]: problem with closing the mysql connection");
	}

	
	public static function db_get_items_random($section, $sortby,$sortDir, $startItem, $itemAmount,$langPost)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
		if($langPost=='all') $langPost=''; else $langPost="WHERE Id LIKE '%$langPost%'" ;
		if(!$result=mysqli_query("SELECT $sortby, Id FROM $section $langPost", self::$db_server)) die("dbClass.php[db_get_items_random()]: problem with mysql_query(result)");
			
		for($k=0;$k<mysqli_num_rows($result);$k++) // write to array $row data from mysql table called $section
		{
			$row[$k] = mysqli_fetch_array($result, MYSQL_NUM);
		}
		
		if (sizeof($row)<$itemAmount) {$itemAmount=sizeof($row);}
		if (sizeof($row)!=null)
		{
			$random_row_key = array_rand($row,$itemAmount); // select random items keys in an amount of $itemAmount
	
			for ($g=0;$g<sizeof($random_row_key);$g++) // getting values of array $row by selected above keys 
			{
				$random_row[$g][0]=$row[$random_row_key[$g]][0];
				$random_row[$g][1]=$row[$random_row_key[$g]][1];
			}
		
			if($sortDir==0)	rsort($random_row);
			if($sortDir==1)	sort($random_row);
		
			for ($r=0;$r<sizeof($row);$r++)
			{
				if(!$result_all_staff=mysqli_query("SELECT * FROM $section WHERE Id='".$random_row[$r][1]."'", self::$db_server)) die("dbClass.php[db_get_items_random()]: problem with mysql_query(result_all_staff)");
				$row_all_staff[$r]=mysqli_fetch_array($result_all_staff, MYSQL_NUM);
			}
		}
		self::$pp=sizeof($random_row);
		self::$rall=$row_all_staff;
	}
	

	public static function db_get_items_category($section, $category, $sortby,$sortDir, $startItem, $itemAmount,$langPost)
	{
		
		self::db_connect();
		self::db_select(self::$db_aldb);	
		
		if($langPost=='all') $langPost=''; else $langPost="AND Id LIKE '%$langPost%'";
		if(!$result=mysqli_query("SELECT $sortby, Id FROM $section WHERE Category LIKE '%$category%' $langPost", self::$db_server)) die("dbClass.php[db_get_items_category()]: problem with mysql_query(result)");
			
		for($k=0;$k<mysqli_num_rows($result);$k++) // write to array $row data from mysql table called $section
		{
			$row[$k] = mysqli_fetch_array($result, MYSQL_NUM);
		}
		
		if (sizeof($row)!=null)
		{
			if($sortDir==0)	rsort($row);
			if($sortDir==1)	sort($row);
		
			if((sizeof($row)-$startItem)<$itemAmount) $itemAmount=(sizeof($row)-$startItem);
			
			for($r=$startItem; $r<=($startItem+$itemAmount); $r++)
			{
				if(!$result_all_staff=mysql_query("SELECT * FROM $section WHERE Id='".$row[$r][1]."'", self::$db_server)) die("dbClass.php[db_get_items_category()]: problem with mysql_query(result_all_staff)");
				$row_all_staff[$r]=mysql_fetch_array($result_all_staff, MYSQL_NUM);
			}
		}
		self::$pp=sizeof($row);
		self::$rall=$row_all_staff;
		//return $row_all_staff;
	}
	
	public static function db_get_items_search($section, $search_where, $sortby,$sortDir, $startItem, $itemAmount,$langPost)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
		if($langPost=='all') $langPost=''; else $langPost="AND Id LIKE '%$langPost%'";
		
		if(!$result=mysqli_query("SELECT $sortby, Id FROM $section WHERE ($search_where) $langPost", self::$db_server)) die("dbClass.php[db_get_items_search()]: problem with mysql_query(result)");
			
		for($k=0;$k<mysqli_num_rows($result);$k++) // write to array $row data from mysql table called $section
		{
			$row[$k] = mysqli_fetch_array($result, MYSQL_NUM);
		}
		
		if (sizeof($row)!=null)
		{
			if($sortDir==0)	rsort($row);
			if($sortDir==1)	sort($row);
		
			if((sizeof($row)-$startItem)<$itemAmount) $itemAmount=(sizeof($row)-$startItem);
			
			for($r=$startItem; $r<=($startItem+$itemAmount); $r++)
			{
				if(!$result_all_staff=mysql_query("SELECT * FROM $section WHERE Id='".$row[$r][1]."'", self::$db_server)) die("dbClass.php[db_get_items_search()]: problem with mysql_query(result_all_staff)");
				$row_all_staff[$r]=mysql_fetch_array($result_all_staff, MYSQL_NUM);
			}
		}
		self::$pp=sizeof($row);
		self::$rall=$row_all_staff;
	}
	
	
	public static function db_get_item_allinfo($section,$itemid)
	{
		self::db_connect();
		self::db_select(self::$db_aldb);
		
		if(!$result_all_staff=mysqli_query("SELECT * FROM $section WHERE Id='".$itemid."'", self::$db_server)) die("dbClass.php[db_get_item_allinfo()]: problem with mysql_query(result_all_staff)");
		$row_all_staff=mysqli_fetch_array($result_all_staff, MYSQL_NUM);
		return $row_all_staff;
	}

};
?>