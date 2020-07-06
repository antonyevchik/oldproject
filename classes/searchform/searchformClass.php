<?php
class searchformClass
{
	function __construct()
	{
		
	}
	
	public static function set_search_form($actionlink,$lg)
	{
		echo "
			<div id='search' enctype='multipart/form-data'>
				<form action='".$actionlink."' method='get'>
					<input type='hidden' name='cnt' value='srch' />
					<br>  
					<input id='srchText' type='text' name='sQ' size='8' />
					<input type='hidden' name='pn' value='1' />
					<input type='hidden' name='l' value='$lg' />
					<input id='srchBut' type='submit' value='".__SRCH_SEARCH_LG."' />
				</form>
			</div>
			";
	} 
}

?>