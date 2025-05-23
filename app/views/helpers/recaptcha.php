<?php 
# http://bakery.cakephp.org/articles/view/recaptcha-component-helper-for-cakephp

class RecaptchaHelper extends AppHelper {
	var $helpers = array('form'); 
	
	function display_form($output_method = 'return', $error = null, $use_ssl = false){
		$data = $this->__form(Configure::read("Recaptcha.pubKey"),$error,$use_ssl);
		if($output_method == "echo")
			echo $data;
		else
			return $data;
	}
	
	function hide_mail($email = '',$output_method = 'return') {
		if (! function_exists ("mcrypt_encrypt")) {
			return "<span title=\"MCRYPT_MISSING\">E-mail hidden</span>";
			#die ("To use reCAPTCHA Mailhide, you need to have the mcrypt php module installed.");
		}
		$data = $this->recaptcha_mailhide_html(Configure::read('Mailhide.pubKey'), Configure::read('Mailhide.privateKey'), $email);
		if($output_method == "echo")
			echo $data;
		else
			return $data;
	}
	
	/**
	 * Gets the challenge HTML (javascript and non-javascript version).
	 * This is called from the browser, and the resulting reCAPTCHA HTML widget
	 * is embedded within the HTML form it was called from.
	 * @param string $pubkey A public key for reCAPTCHA
	 * @param string $error The error given by reCAPTCHA (optional, default is null)
	 * @param boolean $use_ssl Should the request be made over ssl? (optional, default is false)
	 * @return string - The HTML to be embedded in the user's form.
	 */
	function __form($pubkey, $error = null, $use_ssl = false){
		if ($pubkey == null || $pubkey == '') {
			return "reCAPTCHA public key missing. Commenting disabled.";
			# die ("To use reCAPTCHA you must get an API key from <a href='http://recaptcha.net/api/getkey'>http://recaptcha.net/api/getkey</a>");
		}
		
		if ($use_ssl) {
	                $server = Configure::read('Recaptcha.apiSecureServer');
	        } else {
	                $server = Configure::read('Recaptcha.apiServer');
	        }
	
	        $errorpart = "";
	        if ($error) {
	           $errorpart = "&amp;error=" . $error;
	        }
	        return '<script type="text/javascript" src="'. $server . '/challenge?k=' . $pubkey . $errorpart . '"></script>
	
		<noscript>
	  		<iframe src="'. $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
	  			<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
				<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
	  		<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
		</noscript>';
	}

	# For some reason, this function was missing from the original helper!?
	function _recaptcha_aes_pad($val) {
		$block_size = 16;
		$numpad = $block_size - (strlen ($val) % $block_size);
		return str_pad($val, strlen ($val) + $numpad, chr($numpad));
	}
	
	/* Mailhide related code */
	function _recaptcha_aes_encrypt($val,$ky) {
		$mode=MCRYPT_MODE_CBC;   
		$enc=MCRYPT_RIJNDAEL_128;
		$val=$this->_recaptcha_aes_pad($val);
		return mcrypt_encrypt($enc, $ky, $val, $mode, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0");
	}
	
	function _recaptcha_mailhide_urlbase64 ($x) {
		return strtr(base64_encode ($x), '+/', '-_');
	}
	
	/* gets the reCAPTCHA Mailhide url for a given email, public key and private key */
	function recaptcha_mailhide_url($pubkey, $privkey, $email) {
		if ($pubkey == '' || $pubkey == null || $privkey == "" || $privkey == null) {
			die("Mailhide keys missing. E-mail display disabled."); # FIXME: Don't die. Check this before entering this function. (Returning this doesn't do much.)
			# die ("To use reCAPTCHA Mailhide, you have to sign up for a public and private key, you can do so at <a href='http://mailhide.recaptcha.net/apikey'>http://mailhide.recaptcha.net/apikey</a>");
		}
		
	
		$ky = pack('H*', $privkey);
		$cryptmail = $this->_recaptcha_aes_encrypt ($email, $ky);
		
		return "http://mailhide.recaptcha.net/d?k=" . $pubkey . "&c=" . $this->_recaptcha_mailhide_urlbase64 ($cryptmail);
	}
	
	/**
	 * gets the parts of the email to expose to the user.
	 * eg, given johndoe@example,com return ["john", "example.com"].
	 * the email is then displayed as john...@example.com
	 */
	function _recaptcha_mailhide_email_parts ($email) {
		$arr = preg_split("/@/", $email );
	
		if (strlen ($arr[0]) <= 4) {
			$arr[0] = substr ($arr[0], 0, 1);
		} else if (strlen ($arr[0]) <= 6) {
			$arr[0] = substr ($arr[0], 0, 3);
		} else {
			$arr[0] = substr ($arr[0], 0, 4);
		}
		return $arr;
	}
	
	/**
	 * Gets html to display an email address given a public an private key.
	 * to get a key, go to:
	 *
	 * http://mailhide.recaptcha.net/apikey
	 */
	function recaptcha_mailhide_html($pubkey, $privkey, $email) {
		$emailparts = $this->_recaptcha_mailhide_email_parts ($email);
		$url = $this->recaptcha_mailhide_url ($pubkey, $privkey, $email);
		if (count($emailparts)<>2) { return $email; } # We couldn't parse it, so it's invalid and there's no need to hide it.
		return htmlentities($emailparts[0]) . "<a href='" . htmlentities ($url) .
			"' onclick=\"window.open('" . htmlentities ($url) . "', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;\" title=\"Reveal this e-mail address\">...</a>@" . htmlentities ($emailparts [1]);
	
	}
		

}
?>