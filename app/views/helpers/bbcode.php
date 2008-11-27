<?php
/**
 * 
 *
 * @author Kari Silvennoinen
 * @copyright 2008
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 **/

class BBCodeHelper extends AppHelper {
        
    function decode($bbcode="",$phpbb_code = null) {
        App::import('Vendor','lib_bbcode');
        if ($phpbb_code) {
          $bbcode = preg_replace("/:".$phpbb_code."/", "", $bbcode);
        }
        return $this->output(bbcode_format($bbcode));
    }

		function strip($str="") {
			$match = '/\[[^\]]+\]/'; # FIXME: Doesn't handle images nicely. Implement a better strip() to lib_bbcode
			$str = preg_replace($match,"",$str);
			return $this->output($str);
		}
}

?>