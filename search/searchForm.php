<?php

echo "
<div id='search' enctype='multipart/form-data'>
<form action='".$htmRP."' method='get'>
					<input type='hidden' name='cnt' value='srch' />
 			<br>  <input id='srchText' type='text' name='sQ' size='8' />
					<input type='hidden' name='pn' value='1' />
					<input type='hidden' name='l' value='$lg' />
					
					<input id='srchBut' type='submit' value='$Search_lg' />
					
</form>
</div>
";
?>
