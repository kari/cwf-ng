<?php 
/* 
Originally from http://www.phpit.net/code/bbcode-format-function/

*/ 
# FIXME: Outputs XHTML. ("<img />")
# FIXME: Doesn't handle attributes enclosed in double quotes.

function bbcode_format ($str) { 
    $str = htmlentities($str,ENT_QUOTES,"UTF-8",false); // ENT_QUOTES added by zyx (ENT_NOQUOTES)

    $simple_search = array( 
                '/\[b\](.*?)\[\/b\]/is',                                 
                '/\[i\](.*?)\[\/i\]/is',                                 
                '/\[u\](.*?)\[\/u\]/is',                                 
                '/\[url\=(.*?)\](.*?)\[\/url\]/is',                          
                '/\[url\](.*?)\[\/url\]/is',                              
                '/\[align\=(left|center|right)\](.*?)\[\/align\]/is',     
                '/\[img\](.*?)\[\/img\]/is',
                '/\[img\=(.*?)\](.*?)\[\/img\]/is', // added by zyx
  							'/\[img +src\=\"(.*?)\".*?title\=\"(.*?)\".*?\]/is', // added by zyx, will not match anything beacuse of htmlentities coding above. Not true BBCode anyway.
                '/\[mail\=(.*?)\](.*?)\[\/mail\]/is',                     
                '/\[mail\](.*?)\[\/mail\]/is',                             
                '/\[font\=(.*?)\](.*?)\[\/font\]/is',                     
                '/\[size\=(.*?)\](.*?)\[\/size\]/is',                     
                '/\[color\=(.*?)\](.*?)\[\/color\]/is',         
                ); 

    $simple_replace = array( 
                '<strong>$1</strong>', 
                '<em>$1</em>', 
                '<u>$1</u>', 
                '<a href="$1">$2</a>', 
                '<a href="$1">$1</a>', 
                '<div style="text-align: $1;">$2</div>', 
                '<img src="$1" />',
								'<img src="$1" title="$2" />', // added by zyx
								'<img src="$1" title="$2" />', // added by zyx, see above.
                '<a href="mailto:$1">$2</a>', 
                '<a href="mailto:$1">$1</a>', 
                '<span style="font-family: $1;">$2</span>', 
                '<span style="font-size: $1;">$2</span>', 
                '<span style="color: $1;">$2</span>', 
                ); 

    // Do simple BBCode's 
    $str = preg_replace ($simple_search, $simple_replace, $str); 

    // Do <blockquote> BBCode 
    $str = bbcode_quote ($str); 
    
    // Do nl2br
    
    $str = nl2br($str); // added by zyx

    return $str; 
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
?>