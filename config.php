<?php
	$single_server = array(
    	'host'     => '127.0.0.1', 
    	'port'     => 6379, 
    	'database' => 0
	);
	require ("starlight/classes/predis/Predis.php");	# Make sure we have the interface online
	$redis = new Predis_Client($single_server);		# Start the Redis connection
	
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
	
	require ("starlight/starlight.php");	# We need to include the system files		
	$s = new starlight();	# Start the basic classes
	require_once 'starlight/classes/Savant3.php';
	$tpl = new Savant3();
?>