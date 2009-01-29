<?php
/**
 * 
 *
 * @author Kari Silvennoinen
 * @copyright 2008
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 **/

class BBCodeHelper extends AppHelper {
  
	var $search = array(
 		'/\</',
		'/\>/',
		'/\[b\](.*?)\[\/b\]/is',                                 
    '/\[i\](.*?)\[\/i\]/is',                                 
    '/\[u\](.*?)\[\/u\]/is',                                 
    '/\[url\=(.*?)\](.*?)\[\/url\]/is',                          
    '/\[url\](.*?)\[\/url\]/is',                              
    '/\[align\=(left|center|right)\](.*?)\[\/align\]/is',     
    '/\[img\](.*?)\[\/img\]/is',
    '/\[img\=(.*?)\](.*?)\[\/img\]/is',
		'/\[img +src\=\"(.*?)\".*?title\=\"(.*?)\".*?\]/is',
    '/\[mail\=(.*?)\](.*?)\[\/mail\]/is',                     
    '/\[mail\](.*?)\[\/mail\]/is',                             
    '/\[font\=(.*?)\](.*?)\[\/font\]/is',                     
    '/\[size\=(.*?)\](.*?)\[\/size\]/is',                     
    '/\[color\=(.*?)\](.*?)\[\/color\]/is',
		'/\[quote\=(.*?)\](.*?)\[\/quote\]/is',
		'/\[quote\](.*?)\[\/quote\]/is',
   	);

	var $decode = array( 
		'&lt;',
		'&gt;',
    '<strong>$1</strong>', 
    '<em>$1</em>', 
    '<u>$1</u>', 
    '<a href="$1">$2</a>', 
    '<a href="$1">$1</a>', 
    '<div style="text-align: $1;">$2</div>', 
    '<img src="$1" />',
		'<img src="$1" title="$2" />',
		'<img src="$1" title="$2" />',
    '<a href="mailto:$1">$2</a>', 
    '<a href="mailto:$1">$1</a>', 
    '<span style="font-family: $1;">$2</span>', 
    '<span style="font-size: $1;">$2</span>', 
    '<span style="color: $1;">$2</span>',
		'[quote]$2[/quote]',
		'[quote]$1[/quote]',
    );

  var $strip = array( 
		'&lt;',
		'&gt;',
    '$1', 
    '$1', 
    '$1', 
    '<a href="$1">$2</a>', 
    '<a href="$1">$1</a>', 
    '$2', 
    '',
		'',
		'',
    '$2', 
    '$1', 
    '$2', 
    '$2', 
    '$2',
		'$1',
		'$2',
    );

  var $strip_all = array( 
		'&lt;',
		'&gt;',
    '$1', 
    '$1', 
    '$1', 
    '$2', 
    '$1', 
    '$2', 
    '',
		'',
		'',
    '$2', 
    '$1', 
    '$2', 
    '$2', 
    '$2',
		'$1',
		'$2',
    );

	function decode($bbcode="",$phpbb_code = null) {
    if ($phpbb_code) {
    	$bbcode = preg_replace("/:".$phpbb_code."/", "", $bbcode);
    }
		$phpver = phpversion(); # FIXME: For legacy DB. DOESN'T WORK IN PHP4! (can't decode multibyte chars) Solution: Fix DB?
		if (substr($phpver,0,1) == "5") {
    	$bbcode = html_entity_decode($bbcode,ENT_QUOTES,"UTF-8"); 
		} else { # PHP4:
			$bbcode = iconv("UTF-8","ISO-8859-1//IGNORE",$bbcode);
			$bbcode = html_entity_decode($bbcode,ENT_QUOTES);
			$bbcode = iconv("ISO-8859-1","UTF-8",$bbcode);
		}
		$str = preg_replace ($this->search, $this->decode, $bbcode); 
    $str = $this->bbcode_quote($str); 
    $str = nl2br($str);
    return $this->output($str);
  }

	# $bbcode->strip($bbcode string, $all boolean)
	# $all	true = strip all (default), false = decode links
	function strip($bbcode="",$all=true) {
		$phpver = phpversion(); # FIXME: For legacy DB. DOESN'T WORK IN PHP4! (can't decode multibyte chars) Solution: Fix DB?
		if (substr($phpver,0,1) == "5") {
			$bbcode = html_entity_decode($bbcode,ENT_QUOTES,"UTF-8");
		} else { # PHP4:
			$bbcode = iconv("UTF-8","ISO-8859-1//IGNORE",$bbcode);
			$bbcode = html_entity_decode($bbcode,ENT_QUOTES);
			$bbcode = iconv("ISO-8859-1","UTF-8",$bbcode);
		}
		if ($all) {
    	$str = preg_replace ($this->search, $this->strip_all, $bbcode);
		} else {
			$str = preg_replace ($this->search, $this->strip, $bbcode); 
		}
		return $this->output($str);
	}


	function bbcode_quote ($str) { 
    $open = '<blockquote>'; 
    $close = '</blockquote>'; 

    // How often is the open tag? 
    preg_match_all ('/\[quote\]/i', $str, $matches); 
    $opentags = count($matches['0']); 

    // How often is the close tag? 
    preg_match_all ('/\[\/quote\]/i', $str, $matches); 
    $closetags = count($matches['0']); 

    // Check how many tags have been unclosed 
    // And add the unclosing tag at the end of the message 
    $unclosed = $opentags - $closetags; 
    for ($i = 0; $i < $unclosed; $i++) { 
        $str .= '</blockquote>'; 
    } 

    // Do replacement 
    $str = str_replace ('[' . 'quote]', $open, $str); 
    $str = str_replace ('[/' . 'quote]', $close, $str); 

    return $str; 
	}
}
?>