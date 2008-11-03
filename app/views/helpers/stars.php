<?php
class StarsHelper extends AppHelper {
		var $helpers = array('Html');
    function draw($num=0, $max=6, $half=true) {
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
}

?>