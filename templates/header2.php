<?php

echo "
<link rel='shortcut icon' href='".__ROOT_PATH."favicon.ico' type='image/x-icon' />
<link href='".__ROOT_PATH."main.css' rel='stylesheet' type='text/css'' media='screen' />
<link href='".__ROOT_PATH."css/generalText.css' rel='stylesheet' type='text/css'' media='screen' />
<link href='".__ROOT_PATH."messages/message.css' rel='stylesheet'' type='text/css'' media='screen' />
				
<link href='".__ROOT_PATH."jscripts/SlideShow/css/slideshow.css' rel='Stylesheet' type='text/css'  />
<script src='".__ROOT_PATH."jQuery/jquery-2.1.1.js'></script>
<script src='".__ROOT_PATH."jscripts/SlideShow/js/slideshow.js' type='text/javascript'></script>

<script type='text/javascript' src='".__ROOT_PATH."jscripts/rating.js'></script>
<script type='text/javascript' src='".__ROOT_PATH."jscripts/onload.js'></script>
<script src='".__ROOT_PATH."jQuery/jquery-2.1.1.js'></script>
	";


?>


<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?78"></script>
<script type="text/javascript"> VK.init({apiId: 3353933, onlyWidgets: true});</script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?75"></script>


</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<?php


$big='300px'; $small='200px'; $imHeight='auto'; //Screenshots style varibles. Define in including files in appWin.php and  aptem.php

//echo $icl;
//if(!include($rootPath."pageCount/pageCountClass.php")) die("header2.php: pageCountClass.php inclusion error");
//if(!include '../pageCount/pageCountClass.php') die("header2.php: pageCountClass.php inclusion error");
?>

<div id="mainContainer">
<div id="title">
<div id="titlestrip"></div>
<div id="underTitleStrip">
<div id="titleBottom">




<?php

echo "<a href='http://android-lifestyle.com/?l=$lg' >$home_lg</a>&nbsp;&nbsp;";
echo "<a href='http://android-lifestyle.com/?cnt=news&l=$lg' >$news_lg</a>&nbsp;&nbsp;";


$icl = $_SERVER['REQUEST_URI'];

//echo $EOLink;
$replaceNeedle = array('?l=en', '?l=ru', '&l=en', '&l=ru'); 
$iclWithout_l = str_replace($replaceNeedle,'',$icl);   // replacing language set: ?l=en, &l=en, ...
$EOLink = substr($iclWithout_l, strlen($iclWithout_l)-1); // The last symbol of link
//echo $EOLink;
//echo $iclWithout_l;

if($EOLink=='/')
{	
	echo "
	<a href='".$iclWithout_l."?l=en' ><b>ENG</b></a>
	<a href='".$iclWithout_l."?l=ru' ><b>ÐÓÑ</b></a>
	";
}
else 
{
	echo "
	<a href='".$iclWithout_l."&l=en' ><b>ENG</b></a>
	<a href='".$iclWithout_l."&l=ru' ><b>ÐÓÑ</b></a>
	";
}

?>
</div> <!-- titleBottom -->
</div><!-- underTitletrip -->
