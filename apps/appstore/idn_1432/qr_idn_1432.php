<?php $fullappPath=file_get_contents('/var/www/android-lifestyle_t2/apps/appstore/idn_1432/downloadlink_idn_1432.php'); $fullappPath=str_replace(" ","%20", $fullappPath);  QRcode::png($fullappPath,'/var/www/android-lifestyle_t2/apps/appstore/idn_1432/qr_idn_1432.png','L', 3,1);  echo "<a href=".$fullappPath."><img border='0' src='/android-lifestyle_t2/apps/appstore/idn_1432/qr_idn_1432.png' /></a>"; ?>