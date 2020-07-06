<?php
require_once('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LeUS_gSAAAAAKXRwswa5VgeobGaRDj6UPT79sPW";
$privatekey = "6LeUS_gSAAAAAIQlAMF05RLbgBDF8ZcrIRjUsEFA";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
	$resp = recaptcha_check_answer ($privatekey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);

	if ($resp->is_valid) {
		echo "You got it!";
	} else {
		# set the error code so that we can display it
		$error = $resp->error;
	}
}

?>