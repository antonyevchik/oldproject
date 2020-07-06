<?php

define(__DOCUMENT_ROOT_PATH, $_SERVER['DOCUMENT_ROOT'].'/android-lifestyle_t2/');
define(__ROOT_PATH, '/android-lifestyle_t2/');
//define(__DOCUMENT_ROOT_PATH, $_SERVER['DOCUMENT_ROOT'].'/');
//define(__ROOT_PATH, 'http://android-lifestyle.com/');

define(__CURRENT_URL, $_SERVER['REQUEST_URI']);


$langs_array=array('en','ru');
//define(__LANGS_ARRAY, $langs_array);
$replaceNeedle = array('?l=en', '?l=ru', '&l=en', '&l=ru');
$iclWithout_l = str_replace($replaceNeedle,'',__CURRENT_URL);   // replacing language set: ?l=en, &l=en, ...
define(__CURL_WITHOUT_LANG, $iclWithout_l);

//define(__CURENT_LANG, $_GET['l']);

//$rootPath = $_SERVER['DOCUMENT_ROOT'].'/android-lifestyle_t2/';
//$htmRP = '/android-lifestyle_t2/';
$rootPath = __DOCUMENT_ROOT_PATH;
$htmRP = __ROOT_PATH;

$icl = $_SERVER['REQUEST_URI'];




// Constants requiring accounting user language 
$cntry0=explode(",",$_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$cntry=explode("-",$cntry0[0]);

if($cntry[0]=='uk') $langCase='ru';
if($cntry[0]=='be') $langCase='ru';
if($cntry[0]=='kk') $langCase='ru';
if($cntry[0]=='ru') $langCase='ru';

if($cntry[0]!='en'&&$langCase!='ru') $langCase='en';
if($cntry[0]=='en') $langCase='en';

if(($langCase=='en'||!$langCase)||$_GET['l']=='en')
{
	
	//GENERAL SYSTEM VARIABLES
	$lg='en';
	
	//SYSTEM TITLES
	
	
	//SYSTEM HEADERS
	$home_lg='Home';
	$apps_lg='Applications';
	$blog_lg='Blog';
	$news_lg='News';
	$games_lg='Games';
	
	$srchResHeader_lg='Search results for ';
	$randAppHeader_lg='Random application';
	$suggestApp_lg='We suggest';
	$addapp_lg='Add application';
	$Description_lg='Description';
	$Screenshots_lg='Screenshots';
	$Messages_lg='Comments';
	$terms_lg='Tems of Use';
	
	//GENERAL SYSTEM MESSAGES
	$recuired_fields_lg='Please fill in the required fields!';
	$enterCaptchaCode_lg='Enter the reCaptcha code and submit:';
	$afterSubmitMes_lg='Thanks for the post! Your article will be published after validation.';
	$msg_thanking_lg='Thanks for the post, it will be published after approval by a moderator.';
	$msg_incorrectdata='Please Enter a correct data.';
	
	//SYSTEM BUTTONS NAMES
	$Search_lg='Search';
	$Preview_lg='Preview';
	$postPreview_lg='Post preview';
	$submitPost_lg='Submit';
	$editPost_lg='Back';
	$msg_submit_lg='Submit';
	$but_back_lg='Back';
	
	// sorting bar variables
	$sort_lg='Sort:';
	$sort_appNameAZ_lg='App`s name (A > Z)';
	$sort_appNameZA_lg='App`s name (Z > A)';
	$sort_DeveloperAZ_lg='Developer (A > Z)';
	$sort_DeveloperZA_lg='Developer (Z > A)';
	$sort_PublishingDateNEW_lg='Publishing Date (New first)';
	$sort_PublishingDateOLD_lg='Publishing Date (old first)';
	$sort_Rating_lg='Rating';
	$sort_TitleAZ_lg='Title (A > Z)';
	$sort_TitleZA_lg='Title (Z > A)';
	$sort_AuthorNameAZ_lg='Author Name (A > Z)';
	$sort_AuthorNameZA_lg='Author Name (Z > A)';
	
	//Center box post language variables
	$langCntrBoxBar_lg='Post language:';
	
	$more_lg='more';
	$posted_by_lg='Posted by:';
	$version_lg='Version:';
	$os_lg='OS:';
	$size_lg='Size:';
	$download_lg='Download';
	$rate_lg='Rating:';
	$votes_lg='votes:';
	$qrCode_lg='QR-code';
	$additLink_lg='Additional links:';
	
	$appsCategories_lg='Choose apps category:';
	$appName_lg='Application name:';
	$appVersion_lg='Application version:';
	$OS_lg='OS (for example: Jelly Bean, KitKat or Android 2.2, 4.4.x):';
	$developer_lg='Developer:';
	$developer_link_lg='Developer link (URL or e-mail):';
	$downloading_link_lg='Downloading link (direct link to the *.apk file):';
	$main_screenshot_link_lg='Please, specify the URL of main screenshot:';
	$other_screenshot_links_lg='Please add links to additional screenshots in the amount of';
	$app_size_lg='Size (Mb):';
	
	// APPS TOPICS
	$BooksReference_lg='Books and Reference';
	$Business_lg='Business';
	$EducationScience_lg='Education and Science';
	$Entertainment_lg='Entertainment';
	$Finance_lg='Finance';
	$HealthMedicine_lg='Health and Medicine';
	$Multimedia_lg='Multimedia';
	$Office_lg='Office';
	$Shopping_lg='Shopping';
	$SocialCommunication_lg='Social and Communication';
	$Tools_lg='Tools';
	$Travel_lg='Travel';
	$ViewersReaders_lg='Viewers and Readers';
	$Wallpapers_lg='Wallpapers';
	$Weather_lg='Weather';
	$Widgets_lg='Widgets';
	$Other_lg='Other';
	$ThreeDgames_lg='3D-games';
	$ArcadeAction_lg='Arcade and Action';
	$CardsCasino_lg='Cards and Casino';
	$LogicPuzzle_lg='Logic and Puzzle';
	$Online_lg='Online';
	$SportsGames_lg='Sports Games';
	$Strategy_lg='Strategy';
	$Shooting_lg='Shooting';
	$Quests_lg='Quests';
	// NEWS VARIABLES
	$addnews_lg='Add news';
	//	$randApp='Random application';
	
	// BLOG VARIABLES
	$blogHeader_lg='Last blog post';
	$addpostHeader_lg='Add post';
	$postPrevHeader_lg='Post preview';
	$postSubmittedHeader_lg='Post submission';
	$addpost_lg='Add blog post';
	$userName_lg='Your name';
	$blogTopics_lg='Choose the blog topic';
	$blogPostTitle_lg='Post title';
	$shotDescription_lg='Shot description (without any HTML tags)';
	$postContent_lg='Your blog post';
	$blog_topics_lg='Blog topics';
	$AuthorName_lg='Author:';
	$postDate_lg="publishing date:";
	
	// BLOG TOPICS
	$General_lg='General';
	$AndroidOS_lg='Android OS';
	$AndroidDevices_lg='Android Devices';
	$Developing_lg='Developing';
	$Games_lg='Games';
	$Applications_lg='Applications';
	
	// MESSAGES CONSTANTS (using by /classes/messages/messagesClass.php)
	$msg_yourname_lg='Your Name:';
	$msg_message_lg='Message:';
	$msg_entercode_lg='Enter the code on the picture:';
	
	
	
}
if(($langCase=='ru'&&$_GET['l']!='en')||$_GET['l']=='ru')
{
	
	//GENERAL SYSTEM VARIABLES
	$lg='ru';
	
	//SYSTEM TITLES
	
	
	//SYSTEM HEADERS
	$home_lg='�������';
	$apps_lg='���������';
	$blog_lg='����';
	$news_lg='�������';
	$games_lg='����';
	
	$srchResHeader_lg='���������� ������ ��� ';
	$randAppHeader_lg='��������� ����������';
	$suggestApp_lg='�� ����������';
	$addapp_lg='�������� ����������';
	$Description_lg='��������';
	$Screenshots_lg='���������';
	$Messages_lg='�����������';
	$terms_lg='������� �������������';
	
	//GENERAL SYSTEM MESSAGES
	$recuired_fields_lg='����������, ��������� ������������ ����!';
	$enterCaptchaCode_lg='������� ��� reCaptha � ������� "���������":';
	$afterSubmitMes_lg='������� �� ����! ���� ������ ����� ������������ ����� �������� ��������������.';
	$msg_thanking_lg='������� �� ���������, ��� ����� ������������ ����� �������� �����������.';
	$msg_incorrectdata='����������, ������� ���������� ������.';
	
	//SYSTEM BUTTONS NAMES
	$Search_lg='�����';
	$Preview_lg='������������';
	$postPreview_lg='������������';
	$submitPost_lg='������������';
	$editPost_lg='�����';
	$msg_submit_lg='���������';
	$but_back_lg='�����';
	
	// sorting bar variables
	$sort_lg='�����������:';
	$sort_appNameAZ_lg='��� ���������� (� > �)';
	$sort_appNameZA_lg='��� ���������� (� > �)';
	$sort_DeveloperAZ_lg='����������� (� > �)';
	$sort_DeveloperZA_lg='����������� (� > �)';
	$sort_PublishingDateNEW_lg='���� ���������� (����� �������)';
	$sort_PublishingDateOLD_lg='���� ���������� (������ �������)';
	$sort_Rating_lg='�������';
	$sort_TitleAZ_lg='��������� (� > �)';
	$sort_TitleZA_lg='��������� (� > �)';
	$sort_AuthorNameAZ_lg='��� ������ (� > �)';
	$sort_AuthorNameZA_lg='��� ������ (� > �)';
	
	//Center box post language variables
	$langCntrBoxBar_lg='���� �����:';
	
	$more_lg='�����';
	$posted_by_lg='�������(�):';
	$version_lg='������:';
	$os_lg='��:';
	$size_lg='������:';
	$download_lg='�������';
	$rate_lg='������:';
	$votes_lg='�������:';
	$qrCode_lg='QR-���';
	$additLink_lg='�������������� ������:';
	$appsCategories_lg='�������� ��������� ����������:';
	$appName_lg='�������� ���������:';
	$appVersion_lg='������ ���������:';
	$OS_lg='�� (��������: Jelly Bean, KitKat ��� Android 2.2, 4.4.x):';
	$developer_lg='�����������:';
	$developer_link_lg='������ ������������ (URL ��� e-mail):';
	$downloading_link_lg='������ ��� �������� (������ ������ �� *.apk ����):';
	$main_screenshot_link_lg='����������, ������� URL �������� ���������:';
	$other_screenshot_links_lg='����������, �������� �������������� ������ �� ��������� � ����������';
	$app_size_lg='������ (Mb):';
	
	// APPS TOPICS
	$BooksReference_lg='����� � c������';
	$Business_lg='������';
	$EducationScience_lg='����������� � �����';
	$Entertainment_lg='�����������';
	$Finance_lg='�������';
	$HealthMedicine_lg='�������� � ��������';
	$Multimedia_lg='�����������';
	$Office_lg='����';
	$Shopping_lg='�������';
	$SocialCommunication_lg='������� � �����';
	$Tools_lg='�����������';
	$Travel_lg='�����������';
	$ViewersReaders_lg='�������� � ������';
	$Wallpapers_lg='����';
	$Weather_lg='������';
	$Widgets_lg='�������';
	$Other_lg='������';
	$ThreeDgames_lg='3D-����';
	$ArcadeAction_lg='������ � ����';
	$CardsCasino_lg='����� � ������';
	$LogicPuzzle_lg='���������� � �����������';
	$Online_lg='������';
	$SportsGames_lg='����������';
	$Strategy_lg='���������';
	$Shooting_lg='���������';
	$Quests_lg='������';

	// NEWS VARIABLES
	$addnews_lg='�������� �������';
	//	$randApp='��������� ����������';
	
	// BLOG VARIABLES
	$blogHeader_lg='��������� ����� � �����';
	$addpostHeader_lg='�������� ����';
	$postPrevHeader_lg='������������ �����';
	$postSubmittedHeader_lg='�������� �����';
	$addpost_lg='�������� ���� � �����';
	$userName_lg='���� ���';
	$blogTopics_lg='�������� ���� �����';
	$blogPostTitle_lg='��������� �����';
	$shotDescription_lg='�������� �������� (�� ������ ��������� HTML �����)';
	$postContent_lg='��� ���� � �����';
	$blog_topics_lg='���� �����';
	$AuthorName_lg='�����:';
	$postDate_lg="���� ����������:";
	
	// BLOG TOPICS
	$General_lg='�����';
	$AndroidOS_lg='������� ��';
	$AndroidDevices_lg='������� ����������';
	$Developing_lg='����������';
	$Games_lg='����';
	$Applications_lg='����������';
	
	// MESSAGES CONSTANTS (using by /classes/messages/messagesClass.php)
	$msg_yourname_lg='���� ���:';
	$msg_message_lg='���������:';
	$msg_entercode_lg='������� ��� �� ��������:';
	

}

//SYSTEM HEADERS
define(__HOME_LG,$home_lg);
define(__APPS_LG,$apps_lg);
define(__BLOG_LG,$blog_lg);
define(__NEWS_LG,$news_lg);


//SYSTEM BUTTONS NAMES
define(__BUT_BACK_LG,$but_back_lg);

//GENERAL SYSTEM MESSAGES



// OVERALL CONSTANTS
define(__QRCODE_LG, $qrCode_lg);
define(__POSTEDBY_LG, $posted_by_lg);
define(__VERSION_LG, $version_lg);
define(__OS_LG, $os_lg);
define(__SIZE_LG, $size_lg);
define(__DOWNLOAD_LG, $download_lg);


define(__SHORTDESCRIPTION_LG, $shotDescription_lg);
define(__DESCTRIPTION_LG, $Description_lg);
define(__REQUIRED_FIELDS_LG, $recuired_fields_lg);

define(__ENTER_CAPTCHA_CODE_LG, $enterCaptchaCode_lg);

// sorting bar variables
define(__SORT_LG, $sort_lg);
define(__SORT_APPNAME_AZ_LG, $sort_appNameAZ_lg);
define(__SORT_APPNAME_ZA_LG, $sort_appNameZA_lg);
define(__SORT_DEVELOPER_AZ_LG, $sort_DeveloperAZ_lg);
define(__SORT_DEVELOPER_ZA_LG, $sort_DeveloperZA_lg);
define(__SORT_PUBLISHINGDATE_NEW_LG, $sort_PublishingDateNEW_lg);
define(__SORT_PUBLISHING_OLD_LG, $sort_PublishingDateOLD_lg);
define(__SORT_RATING_LG, $sort_Rating_lg);
define(__SORT_TITLE_AZ_LG, $sort_TitleAZ_lg);
define(__SORT_TITLE_ZA_LG, $sort_TitleZA_lg);
define(__SORT_AUTHORNAME_AZ_LG, $sort_AuthorNameAZ_lg);
define(__SORT_AUTHORNAME_ZA_LG, $sort_AuthorNameZA_lg);

//Center box post language variables
define(__LANG_CNTRBOX_LG, $langCntrBoxBar_lg);


// APPS ADDAPP CONSTANTS
define(__ADDAPP_APPSCATEGORY_LG,$appsCategories_lg);
define(__ADDAPP_APPNAME_LG,$appName_lg);
define(__ADDAPP_APPVERSION_LG,$appVersion_lg);
define(__ADDAPP_OS_LG,$OS_lg);
define(__ADDAPP_DEVELOPER_LG,$developer_lg);
define(__ADDAPP_DEVELOPERLINK_LG,$developer_link_lg);
define(__ADDAPP_DOWNLOADINGLINK_LG,$downloading_link_lg);
define(__ADDAPP_MAINSCREENSHOTLINK_LG, $main_screenshot_link_lg);
define(__ADDAPP_OTHERSCREENSHOTSLINKS_LG, $other_screenshot_links_lg);

define(__ADDAPP_APPSIZE_LG, $app_size_lg);

// APPS TOPICS CONSTANTS
define(__ATOPS_BOOKSREFERENCE_LG,$BooksReference_lg);
define(__ATOPS_BUSINESS_LG,$Business_lg);
define(__ATOPS_EDUCATIONSCIENCE_LG,$EducationScience_lg);
define(__ATOPS_ENTERTAIMENT_LG,$Entertainment_lg);
define(__ATOPS_FINANCE_LG,$Finance_lg);
define(__ATOPS_HEALTHMEDICINE_LG,$HealthMedicine_lg);
define(__ATOPS_MULTIMEDIA_LG,$Multimedia_lg);
define(__ATOPS_OFFICE_LG,$Office_lg);
define(__ATOPS_SHOPPING_LG,$Shopping_lg);
define(__ATOPS_SOCIALCOMMUNICATION_LG,$SocialCommunication_lg);
define(__ATOPS_TOOLS_LG,$Tools_lg);
define(__ATOPS_TRAVEL_LG,$Travel_lg);
define(__ATOPS_VIEWERSREADERS_LG,$ViewersReaders_lg);
define(__ATOPS_WALLPAPERS_LG,$Wallpapers_lg);
define(__ATOPS_WEATHER_LG,$Weather_lg);
define(__ATOPS_WIDGETS_LG,$Widgets_lg);
define(__ATOPS_OTHER_LG,$Other_lg);
define(__ATOPS_TREEDGAMES_LG,$ThreeDgames_lg);
define(__ATOPS_ARCADEACTION_LG,$ArcadeAction_lg);
define(__ATOPS_CARDSCASINO_LG,$CardsCasino_lg);
define(__ATOPS_LOGICPUZZLE_LG,$LogicPuzzle_lg);
define(__ATOPS_ONLINE_LG,$Online_lg);
define(__ATOPS_SPORTSGAMES,$SportsGames_lg);
define(__ATOPS_STRATEGY_LG,$Strategy_lg);
define(__ATOPS_SHOOTING_LG,$Shooting_lg);
define(__ATOPS_QUESTS_LG,$Quests_lg);

// BLOG TOPICS CONSTANTS
define(__BTOPS_GENERAL_LG,$General_lg);
define(__BTOPS_ANDROIDOS_LG,$AndroidOS_lg);
define(__BTOPS_ANDROIDDEVICES_LG,$AndroidDevices_lg);
define(__BTOPS_DEVELOPING_LG,$Developing_lg);
define(__BTOPS_GAMES_LG,$Games_lg);
define(__BTOPS_APPLICATIONS_LG,$Applications_lg);



// SEARCH FORM CONSTANTS (using by /classes/searchform/searchformClass.php)
define(__SRCH_SEARCH_LG, $Search_lg);
// MESSAGES CONSTANTS (using by /classes/messages/messagesClass.php)
define(__MSG_YOURNAME_LG, $msg_yourname_lg);
define(__MSG_MESSAGE_LG, $msg_message_lg);
define(__MSG_ENTERCODE_LG, $msg_entercode_lg);
define(__MSG_SUBMIT_LG, $msg_submit_lg);
define(__MSG_THANKING_LG, $msg_thanking_lg);
define(__MSG_INCORRECTDATA_LG, $msg_incorrectdata);

?>