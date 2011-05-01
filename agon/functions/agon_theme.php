<?php
	function _c($a) {
		global $redis;
		return $redis->get($a);
	}
	function _i($a,$b) {
		global $redis;
		return $redis->lindex($a,$b);
	}
	function gS($s) {
		return _c("slight.slug.".$s);
	}
	function gC($i){
		global $s;
		//TODO Fix
		$s->readcomments($i);
	}
	
	
?>