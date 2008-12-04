<?php
class SiteHelper extends AppHelper {
		var $helpers = array('Html');
    
		function drawStars($num=0, $max=6, $half=true, $img=array("/img/icons/star.png","/img/icons/star_gray.png","/img/icons/star_half.png")) {
        if ($num > $max) { $num = $max; }
				$str = "";
				for($i=1;$i<=floor($num);$i++) {
					$str .= $this->Html->image($img[0]);
				}
				if (!(floor($num*2) % 2 == 0) && $half) {
					$str .= $this->Html->image($img[2]);
					$num += 1;
				}
				for($i=1;$i<=($max-floor($num));$i++) {
					$str .= $this->Html->image($img[1]);
				}
				return $this->output($str);
		}

	function image_url($url,$options=array()) {
		# Returns url to cached version of image.
		# FIXME: Problem is, this way in a worst case scenario this function is called multiple times and the script might timeout.
		
		# strict =  don't maintain aspect ratio when resizing
		$def_options = array("width"=>null,"height"=>null,"strict"=>false);
		$options = array_merge($def_options,$options);

		# FIXME: messy code below...
		$width = $options["width"];
		$height = $options["height"];
		$strict = $options["strict"];

		if (!($width and $height)) { $strict=false; } # can't be strict if only one dimension is set.
		if ($strict) {
			$type .= $width."x".$height;
		} else {
			if($width and $height) {
				if ($width >= $height) {
					$type = $width."w";
				} else {
					$type = $height."h";
				}
			} elseif ($width and !($height)) {
				$type = $width."w";
			} elseif ($height and !($width)) {
				$type = $width."h";
			} else
			$type = "full"; # FIXME: = null
		}
		$ext = substr($url,-4,4);
		$image = basename($url,$ext); # MAYBEFIXME: currently works only for relative urls?
		# $cached = "/img/cache/".$image."-".md5($url)."-".$type.strtolower($ext);
		
		$cached = "/img/cache/".$image;
		if (isset($type)) { $cached .= "-".$type; }
		$cached .= strtolower($ext);
		
		if (!file_exists(WWW_ROOT.$cached)) {
			# generate image
			$cached = "/img/cwf_nosshot.png";
		}
		# $cached = "/screenshots/show/".$image."-".$type.strtolower($ext);
		return $this->output($cached);
		
	}
	# Site's version of $html->image
	function image($url,$options=array()) {	 
		$cached_url = $this->image_url($url,$options);
		if (isset($options["strict"])) { unset($options["strict"]); }
		if (isset($options["width"])) { unset($options["width"]); }
		if (isset($options["height"])) { unset($options["height"]); }
		$str = $this->Html->image($cached_url,$options);
		return $this->output($str);
	}
		
		function resize_image($url,$size=null,$size_by="w",$watermarked=false) {
			$data = fread(fopen($url,"rb"),2*1048576); # read pictures up to 2 MB
			$im = imagecreatefromstring($data); # requires GD2-library
			if ($im !== false) {
				return $this->output($url);
			} else {
				return $this->output("img/na.jpg");
			}
			#$file=md5($url)."-".$size_by.$size
			
		}
}

?>