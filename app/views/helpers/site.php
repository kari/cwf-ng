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

	# Site's version of $html->image
	# $options["width"] and $options["height"] are understood as dimensions to fit the image into and aspect ratio is maintained.
	function image($url,$options=array()) {	 
		$cached_url = $this->image_url($url,$options);
		if (!file_exists(WWW_ROOT.$cached_url)) {
			$new_size = $this->image_resize($url,WWW_ROOT.$cached_url,$options);
			if (!$new_size) {
				$cached_url = "/img/cwf_nosshot.png"; # Caching failed, show placeholder instead.
			}	else {
				$options["width"] = $new_size[0]; # new dimensions for HTML attributes.
				$options["height"] = $new_size[1]; 
			}
		} else {
			if (isset($options["width"]) and isset($options["height"])) {
				# If both width and height are set, we cannot be certain that they retain the
				# images original aspect ratio, therefore we throw away the smaller of them.
				# Another way to do this would be opening the image and checking the size out
				# (or even storing it in DB), but that's a bit over-kill.
				if ($options["width"] >= $options["height"]) {
					unset($options["height"]);
				} else {
					unset($options["width"]);
				}
			}
		}
		$str = $this->Html->image($cached_url,$options);
		return $this->output($str);
	}
	
	function image_url($url,$options=array()) { # Return the cached url 
		$def_options = array("width"=>null,"height"=>null);
		$options = array_merge($def_options,$options);

		# FIXME: messy code below...
		$width = $options["width"];
		$height = $options["height"];

		if($width and $height) {
			if ($width >= $height) {
				$type = "-".$width."w";
			} else {
				$type = "-".$height."h";
			}
		} elseif ($width and !($height)) {
			$type = "-".$width."w";
		} elseif ($height and !($width)) {
			$type = "-".$width."h";
		} else {
			$type = "";
		}
		$ext = substr($url,-4,4);
		$image = basename($url,$ext);
		# $cached = "/img/cache/".$image."-".md5($url)."-".$type.strtolower($ext);
		
		$cached = "/img/cache/".$image;
		if (isset($type)) { $cached .= $type; }
		$cached .= strtolower($ext);
		
		return $this->output($cached);	
	}
	
	function image_resize($image="../cwf_nosshot.png",$filename,$options=array()) {
		$def_options = array("width"=>null,"height"=>null);
		$options = array_merge($def_options,$options);	
		$width = $options["width"];
		$height = $options["height"];
		$file = WWW_ROOT."img/originals/".basename($image); # FIXME: We assume originals are at /img/originals/
		if (!file_exists($file)) {
			return false; # Original image does not exist.
		}
		if (!extension_loaded("gd")) { 
			return false; # GD not installed
		}
		$o_img = imagecreatefrompng($file); # FIXME: We assume originals are PNGs
		if (!$o_img) { return false; } # Original image failed to load (not png?)

		$o_width = imagesx($o_img);
		$o_height = imagesy($o_img);
		
		if ($width and $height) {
			if ($o_width >= $o_height) {
				$height = $o_height/$o_width*$width; # recalculate height to fit aspect ratio
			} else {
				$width = $o_widht/$o_height*$height; # recalculate width to fit aspect ratio
			}
		} elseif ($width and !($height)) {
			$height = $o_height/$o_width*$width; # calculate new height to fit aspect ratio
		} elseif ($height and !($width)) {
			$width = $o_width/$o_height*$height; # calculate new width to fit aspect ratio
		} else {
			$width = $o_width; # no resizing.
			$height = $o_height;
		}
		
		$img = imagecreatetruecolor($width,$height);
		imagecopyresampled($img,$o_img,0,0,0,0,$width,$height,$o_width,$o_height);
		
		if (imagesx($img)>300 or imagesy($img)>300) { # If target size is wider/taller than 300px, we watermark it
			$wm = imagecreatefrompng("/img/cwf_watermark.png");
			if ($wm) {
					imagecopymerge($img,$wm,imagesx($img)-imagesx($wm)-2,imagesy($img)-imagesy($wm)-2,0,0,imagesx($wm),imagesy($wm),75); # right-margin = 2, bottom-margin = 2, opacity = 75%
			}
		}
		if (!imagepng($img,$filename)) { # Saved as PNG.
			return false; # image saving failed
		} else {
			return array($width,$height); # return new dimensions
		}
	}
	
	
	function avatar($user,$options=array()) { # Decodes Avatar path from phpbb2 db.
		$avatar_path = "/img/avatars/";
		$str = "";
		switch ($user['user_avatar_type']) {
		  case 1:
		  case 3:
		    $str = $this->Html->image($avatar_path.$user["user_avatar"],$options);
		    break;
		  case 2:
		    $str = $this->Html->image($user["user_avatar"],$options);
		    break;
		  case 0: # Avatar missing
			default:
			  $str = $this->Html->image("/img/avatars/2816567684410642349aab.gif",$options); # FIXME: No avatar -picture.
				break;
		}
		return $this->output($str);
	}
}

?>