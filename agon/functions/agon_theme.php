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
		readcomments($i);
	}
	
	function meta2obj($arr) {
	        global $redis;
		$v = $redis->hgetall($arr);
	        return (object) array( 'id' => 		$v['id'],
	                                'slug' => 	$v['full_url'],
	                                'title' =>	$v['title'],
	                                'date' => 	$v['timestamp'],
	                                'author' => 	'Admin',
	                                'body' => 	truncate($v['content'],((int)1000)),
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