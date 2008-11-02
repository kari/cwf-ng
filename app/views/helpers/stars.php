<?php
class StarsHelper extends AppHelper {
		var $helpers = array('Html');
    function draw($num=0, $max=6) {
        $str = "";
				for($i=1;$i<=$num;$i++) {
				# for($i = 1; $i <= $num; $i++) {
					$str .= $this->Html->image("/img/icons/star.png");
				}
				for($i=1;$i<=($max-$num);$i++) {
					$str .= $this->Html->image("/img/icons/plugin_disabled.png");
				}
				return $this->output($str);
    }
}

?>