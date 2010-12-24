<?php
	if(isset($_GET['d']) and $_GET['d'] == 'page' ) {
		$data = $redis->keys('slight.pages.*');
	} else {
		$data = $redis->keys('slight.posts.*');		
	}
	
	# Header info here
	$c = count($data);
	for($i = 0; $i<$c; $i++) {
		
	}