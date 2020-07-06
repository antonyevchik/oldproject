<?php
class messagesClass
{
	
	
	function __construct()
	{
		
	}
	
	
	public static function messages($itemTitle,$mesPath,$mesBufferPath,$itemid)
	{
		
		
		//BEGIN HTML FORM -->
		echo "
			<div id='msgForm'>
				<form action='".__CURRENT_URL."' method='post'>
					".__MSG_YOURNAME_LG."
					<br>
					<input type='text' name='name' size='25' />
					<br>
					".__MSG_MESSAGE_LG."
					<br>
					<textarea name='comment' rows='5' cols='32'></textarea>
					 <!--	<script type='text/javascript'>
							CKEDITOR.replace('comment');
							</script> -->
					<br>
					
				<!--	<img src='".__ROOT_PATH."secpic/secpic.php' alt=''/>
					<br>
					<input type='text' name='secpic' size='7' style=''/> -->
						";
		echo  "<div style='margin-left:23%;margin-right:23%;'>".recaptchaClass::recaptchaClass_recaptcha_get_html()."</div>";
		echo "
					<input type='submit' name='submit' value='".__MSG_SUBMIT_LG."' />
				</form>
			</div>";
					//END HTML FORM -->
		
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		$recaptcha_answer=recaptchaClass::recaptchaClass_recaptcha_check_answer();
		if ($recaptcha_answer=='true')
		{
		
		if(!empty($_POST['name'])&&!empty($_POST['comment']))
		{
			//echo "TEST IS CORRECT!";
		
			$name = $_POST['name'];
			//		$email = $_POST['email'];
			//		$perm_email = $_POST['perm_email'];
			$comment = $_POST['comment'];
			$date = date('H:i, d.m.Y');
			$date1 = date('Y-m-d_H-i-s');

			$text= "<br>
			<table id='tabMes' cellspacing='0px'>
			<tr>
			<td id='tdMesName'>
			$name &nbsp;
			</td>
			<td id='tdMesDate'>
			$date
			</td>
			</tr>
			</table>

			<table cellspacing='0px' id='tabMesComment'>
			<tr>
			<td id='tdComment'> $comment </td>
			</tr>
			</table>
			<br>";

			$fh = fopen($mesBufferPath.'mesfile'.$date1.'_'.$itemid.'.txt','a') or die("messagesClass.php: cannot open file:".$mesBufferPath.'mesfile'.$date1.'_'.$itemid.'.txt');
			$fw=fwrite($fh,$text);
			flock($fh,LOCK_UN);
			fclose($fh);

			$mesBufferText='<h3>'.$itemTitle.'</h3>
					<?php 
						if(file_exists(\''.$mesBufferPath.'mesfile'.$date1.'_'.$itemid.'.txt\')) 
						{
							$fr=file_get_contents(\''.$mesBufferPath.'mesfile'.$date1.'_'.$itemid.'.txt\');
							echo $fr;
						} 
						else echo \'File has deleted!\'; 
					?>
			
					<form action=\''.__ROOT_PATH.'setts/mesFilter.php\' method=\'post\'>
						<input type=\'hidden\' name=\'mesFile\' value='.$mesPath.'mesfile_'.$itemid.' />
						<input type=\'hidden\' name=\'mesBufferFile\' value='.$mesBufferPath.'mesfile'.$date1.'_'.$itemid.'.txt />
						<input type=\'submit\' name=\'post\' value=\'POST\'/>
						<input type=\'submit\' name=\'remove\' value=\'REMOVE\'/>
					</form>';
			
			
			
			$mesBuffer_r=fopen(__DOCUMENT_ROOT_PATH.'messages/mesBuffer.php','a') or die('mesBuffer.php file opening error');
			$mesBuffer_w=fwrite($mesBuffer_r,$mesBufferText);
			flock($mesBuffer_r,LOCK_UN);
			fclose($mesBuffer_r);


			
			echo __MSG_THANKING_LG;
			//if($lg=='en') { echo "Thanks for the post, it will be published after approval by a moderator."; }
  			//else { echo "Спасибо за сообщение, оно будет опубликовано после проверки модератором."; }

			
		} 
			
			else
			{
			
			echo __MSG_INCORRECTDATA_LG;
			//$lg = $_POST['lg'];
  			//if($lg=='en') { echo "Please Enter a correct data"; }
  			//else { echo "Пожалуйста, введите правильные данные"; }
					// header('Location: /?cnt=ainfo&category='.$category.'&app='.$itemid.'&an='.$an.'&l=en');
			
			}
			
			
	}
	else
	{
		echo "<br>The reCAPTCHA wasn't entered correctly. Go back and try it again.<br><br>";
	}
	
	}
	



			if(fopen($mesPath.'mesfile_'.$itemid,'a'))
			{
				$fr = file_get_contents($mesPath.'mesfile_'.$itemid);
				echo $fr;
			}
			
	}

}
?>