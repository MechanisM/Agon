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
	
	function meta2obj($arr) {
	        global $redis;
	        return (object) array( 'id' => _i($arr,0),
	                                'slug' => _i($arr,1),
	                                'title' => _i($arr,2),
	                                'date' => _i($arr,3),
	                                'author' => _i($arr,4),
	                                'body' => truncate(_i($arr,5),((int)$redis->get('slight.config.trim'))),
	                             );
	}

	function url($place) {
		if(_c('slight.config.cleanurl') == 'true')
			return _c('slight.config.siteurl').'/'.$place;
	}
    
	function truncate($str, $n, $delim='...') {
		if($n == 0) {
			return $str;
		} else {
			$len = strlen($str);
			if ($len > $n) {
				preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
				return rtrim($matches[1]) . $delim;
			} else {
				return $str;
			}
		}
	}
?>