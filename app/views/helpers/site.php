<?php
class SiteHelper extends AppHelper {
		var $helpers = array('Html');
    
function drawStars($num=0, $max=6, $half=true) {
        # if ($num > $max) { $num = $max; }
				$str = "";
				for($i=1;$i<=floor($num);$i++) {
				# for($i = 1; $i <= $num; $i++) {
					$str .= $this->Html->image("/img/icons/star.png");
				}
				if (!(floor($num*2) % 2 == 0) && $half) {
					$str .= $this->Html->image("/img/icons/star_half.png");
					$num += 1;
				}
				for($i=1;$i<=($max-floor($num));$i++) {
					$str .= $this->Html->image("/img/icons/star_gray.png");
				}
				return $this->output($str);
    }

		function image($url,$size=null,$size_by="w",$watermarked=false) {
			$data = fread(fopen($url,"rb"),1048576); # read pictures up to 1 MB
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