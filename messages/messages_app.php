<?php 

//$lg=$_GET['l'];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(!empty($_POST['name'])&&!empty($_POST['comment'])&&($_SESSION['secpic']==$_POST['secpic']))
  {
		$name = $_POST['name'];
//		$email = $_POST['email'];
//		$perm_email = $_POST['perm_email'];
		$comment = $_POST['comment'];
		$date = date('H:i, d.m.Y');
		$date1 = date('Y-m-d_H-i-s');
		$rootPath = $_POST['rootPath'];
		$aPath = $_POST['aPath'];
		$category = $_POST['category'];
		$app = $_POST['app'];
		$an = $_POST['an'];
		$lg = $_POST['lg'];
		



//		if(!$perm_email)
//		{
//		  $comm_name="<p><a href='mailto:$email'><p>$name</p></a></p>";
//		}
//		else
//		  $comm_name="$name";

    
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

		//header('Location: /?cnt=ainfo&category='.$category.'&app='.$app.'&an='.$an.'&l=en');
/*
		$fh = fopen($aPath.'/mesfile_'.$app.'.txt','a') or die("РЎРѕР·РґР°С‚СЊ С„Р°Р№Р» РЅРµ СѓРґР°Р»РѕСЃСЊ!");
		$fw=fwrite($fh,$text);
		flock($fh,LOCK_UN);
		fclose($fh);
*/
		$fh = fopen($rootPath.'messages/app_mes_files/mesfile'.$date1.'_'.$app.'.txt','a') or die("РЎРѕР·РґР°С‚СЊ С„Р°Р№Р» РЅРµ СѓРґР°Р»РѕСЃСЊ!");
		$fw=fwrite($fh,$text);
		flock($fh,LOCK_UN);
		fclose($fh);
		
		$textAdmin0='<h3>'.$an.'</h3><?php if(fopen($rootPath.\'messages/app_mes_files/mesfile'.$date1.'_'.$app.'.txt\',\'a\')) {$fr=file_get_contents($rootPath.\'messages/app_mes_files/mesfile'.$date1.'_'.$app.'.txt\'); echo $fr;} else echo "File has deleted!"; ?>';
		$textAdmin= $textAdmin0."<form action='/setts/mesSetts.php' method='post'><input type='hidden' name='aPath' value='$aPath' /><input type='hidden' name='date' value='$date1' /><input type='hidden' name='app' value='$app' /><input type='hidden' name='rootPath' value='$rootPath' /><input type='submit' name='post' value='POST'/><input type='submit' name='remove' value='REMOVE'/></form>";	
		$mesAdmin_r=fopen($rootPath.'messages/mesAdmin.php','a') or die('mesAdmin.php file opening error');
		$mesAdmin_w=fwrite($mesAdmin_r,$textAdmin);
		flock($mesAdmin_r,LOCK_UN);
		fclose($mesAdmin_r);
		
		
		if($lg=='en') { echo "Thanks for the post, it will be published after approval by a moderator."; }
  		else { echo "Спасибо за сообщение, оно будет опубликовано после проверки модератором."; }
		
  }
    else 
  {  
  $category = $_POST['category'];
  $app = $_POST['app'];
  $an = $_POST['an'];
  $lg = $_POST['lg'];
  if($lg=='en') { echo "Please Enter a correct data"; }
  else { echo "Пожалуйста, введите правильные данные"; }
 // header('Location: /?cnt=ainfo&category='.$category.'&app='.$app.'&an='.$an.'&l=en');
  }
}



/*
		$rootPath = $_GET['rootPath'];
		$aPath = $_GET['aPath'];
		$category = $_GET['category'];
		$app = $_GET['app'];
		$an = $_GET['an'];
*/



if($lg=='en') 
{
//BEGIN HTML FORM -->
echo "
<div id='msgForm'> 
<form action='?cnt=ainfo&category=".$category."&app=".$app."&an=".$an."&l=en' method='post'>
Your Name:</td>
<br>
<input type='text' name='name' size='25' />
<br>	
Message:
<br>
<textarea name='comment' rows='5' cols='32'></textarea>
<br>
Enter the code:
<br>
<img src='".$htmRP."secpic/secpic.php' alt=''/> 
<br>
<input type='text' name='secpic' size='7' style=''/>
<input type='hidden' name='rootPath' value='$rootPath' />
<input type='hidden' name='aPath' value='$aPath' />
<input type='hidden' name='category' value='$category' />
<input type='hidden' name='app' value='$app' />
<input type='hidden' name='an' value='$an' />
<input type='hidden' name='lg' value='$lg' />
<input type='submit' name='submit' value='Send' />
</form>
</div>";
//END HTML FORM -->
}
else
{
	//BEGIN HTML FORM -->
echo "
<div id='msgForm'> 
<form action='?cnt=ainfo&category=".$category."&app=".$app."&an=".$an."&l=ru' method='post'>
Ваше имя:</td>
<br>
<input type='text' name='name' size='25' />
<br>	
Сообщение:
<br>
<textarea name='comment' rows='5' cols='32'></textarea>
<br>
Введите код:
<br>
<img src='".$htmRP."secpic/secpic.php' alt=''/> 
<br>
<input type='text' name='secpic' size='7' style=''/>
<input type='hidden' name='rootPath' value='$rootPath' />
<input type='hidden' name='aPath' value='$aPath' />
<input type='hidden' name='category' value='$category' />
<input type='hidden' name='app' value='$app' />
<input type='hidden' name='an' value='$an' />
<input type='hidden' name='lg' value='$lg' />
<input type='submit' name='submit' value='Отправить' />
</form>
</div>";
//END HTML FORM -->
}



if(fopen($aPath.'/mesfile_'.$app.'.txt','a'))
{
	$fr = file_get_contents($aPath.'/mesfile_'.$app.'.txt');
	echo $fr;
}
?>
	  
	  
<!-- End Comments Code -->	  