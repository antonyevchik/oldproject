<?php
if(!require_once("../constans.php")) die ("ERROR: constans.php file inclusion error");
if(!require_once(__DOCUMENT_ROOT_PATH."reCaptcha/recaptchalib.php")) die("recaptchaClass.php: recaptchalib.php inclusion error");

class recaptchaClass
{
	public static $publickey='6LeUS_gSAAAAAKXRwswa5VgeobGaRDj6UPT79sPW';
	public static $privatekey='6LeUS_gSAAAAAIQlAMF05RLbgBDF8ZcrIRjUsEFA';
	
	function __construct()
	{
	
	}
	
	public static function recaptchaClass_recaptcha_get_html()
	{
		$return="<br><br>".__ENTER_CAPTCHA_CODE_LG."<br>".recaptcha_get_html(self::$publickey);
		return $return;
	}
	
	public static function recaptchaClass_recaptcha_check_answer()
	{
		//$recaptcha_answer='false';
		//$resp=1;
		//$recaptcha_answer=" <b>TEST0</b> ".$_POST["recaptcha_challenge_field"]." <b>TEST0</b> ".$_POST["recaptcha_response_field"]." <b>TEST0</b> ".$_SERVER["REMOTE_ADDR"];
		
		if ($_POST["recaptcha_response_field"]) 
		{
		
			$resp = recaptcha_check_answer(self::$privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		
			if (!$resp->is_valid) 
			{
				// What happens when the CAPTCHA was entered incorrectly
				//die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
				//	"(reCAPTCHA said: " . $resp->error . ")");
				$recaptcha_answer='false';
			} 
			else 
			{
				$recaptcha_answer='true';
			}
			
		}
		 
		return $recaptcha_answer;
		//return $resp;
	}
	
	
}

?>