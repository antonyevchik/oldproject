
			<script>
				function checkManualId_Here_are_our_fa_1008102903() { var x = document.getElementById('miCheck_Here_are_our_fa_1008102903').checked; document.getElementById('manualId_Here_are_our_fa_1008102903').disabled=!x; }
			</script>
			<br>
			<div style='width: 1000px; margin-right: auto; margin-left: auto;'>
				<?php
				if(!empty($_POST['post'])&&($_POST['filename']=='Here_are_our_fa_1008102903'))
					{$fp=fopen('/var/www/android-lifestyle_t2/blog/postsBuffer/Here_are_our_fa_1008102903','a'); fwrite($fp, '<h1>POSTED</h1>'); fclose($fp);}
				if($fileContent=file_get_contents('/var/www/android-lifestyle_t2/blog/postsBuffer/Here_are_our_fa_1008102903'))
					{echo $fileContent;}
				?>
				<br>
					<form style=' clear:both;' action='/android-lifestyle_t2/blog/postsFilter.php' method='post'>
						<input type='hidden' name='filename' value='Here_are_our_fa_1008102903' />
						<input type='hidden' name='authorName' value='Philip' />
						<input type='hidden' name='date' value='10.08.2014 10:29' />		
					<!--	<input type='hidden' name='postTitle' value='Here are our favorite game releases for March 2014' />  -->
						<input type='hidden' name='shortDescription' value='dsfdsgfdg' />

						Title: <input type='text' name='postTitle' size='70' value='Here are our favorite game releases for March 2014'  /><br><br>
						Author Name: <b>Philip</b><br><br>
								
						Post Content:<textarea name='editorContent_Here_are_our_fa_1008102903' cols='45' rows='5'><p>fdsgdfgfdg</p>
</textarea>
						<script type='text/javascript'> CKEDITOR.replace('editorContent_Here_are_our_fa_1008102903');</script><br>
								
				  <!--  <input type='hidden' name='category' value='AndroidOS' /> -->
				  		Enter manual Id if needed (for example: idn_1234_en):	
				  		<input id='miCheck_Here_are_our_fa_1008102903' type='checkbox' name='manualIdcheck_Here_are_our_fa_1008102903' onclick='checkManualId_Here_are_our_fa_1008102903()'/>
				  		<input id='manualId_Here_are_our_fa_1008102903' type='text' name='manualId_Here_are_our_fa_1008102903' size='20' disabled/><br>
				 		Select the language of post:	
				  		<select name='language'>
				  		<option value='en'>English</option>
				  		<option value='ru'>Russian</option>
				  		</select>
				  		<br>
						<select name='category' >
						<option value='General' >General</option>
						<option value='AndroidOS' selected>AndroidOS</option>
						<option value='AndroidDevices' >AndroidDevices</option>
						<option value='Developing' >Developing</option>
						<option value='Games' >Games</option>
						<option value='Applications' >Applications</option>
						</select><br>
						Additional Category (use , as a separator without space, for example: General,AndroidOS,AndroidDevices,Developing,Games,Applications): 
								<input type='text' name='addCat' /><br>
						<br>
						<input type='submit' name='post' value='POST'/>
						<input type='submit' name='delete' value='DELETE'/>
					  </form>
				<hr style='height: 10px; border: 0px; background-color:black;'>
			</div>
				<br>
			
