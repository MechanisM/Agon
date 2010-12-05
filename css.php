<?php
$single_server = array(
	'host'     => '127.0.0.1', 
	'port'     => 6379, 
	'database' => 10
);
require ("starlight/classes/predis/Predis.php");	# Make sure we have the interface online
$redis = new Predis_Client($single_server);		# Start the Redis connection
var_dump($redis->lrange("test",0,3));
?>