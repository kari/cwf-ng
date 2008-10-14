<?php
/**
 * 
 *
 * @author Kari Silvennoinen
 * @copyright 2008
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 **/

class BBCodeHelper extends AppHelper {
        
    function decode($bbcode,$phpbb_code = null) {
        App::import('Vendor','lib_bbcode');
        if ($phpbb_code) {
          $bbcode = preg_replace("/:".$phpbb_code."/", "", $bbcode);
        }
        return $this->output(bbcode_format($bbcode));
    }
}

?>