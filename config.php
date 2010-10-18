<?php
	$single_server = array(
    	'host'     => '127.0.0.1', 
    	'port'     => 6379, 
    	'database' => 0
	);
	require ("starlight/classes/predis/Predis.php");	# Make sure we have the interface online
	$redis = new Predis_Client($single_server);		# Start the Redis connection
	
	function _c ($j) {	# Shorthand for $redis->get
		global $redis;
		return $redis->get($j);
	}
	
	require ("starlight/starlight.php");	# We need to include the system files
		require ("starlight/classes/starlight.page.php");	# Page listing library	
		require ("starlight/classes/starlight.post.php");	# Single post
		require ("starlight/classes/starlight.static.php");
		
		$s = new starlight();	# Start the basic classes
			$s = new page();	# Start the sub classes
			$s = new post();
?>