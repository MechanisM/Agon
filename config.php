<?php
	session_start();
	
	define("s_version", "0.0.4");
	define("s_release", false); # Set to false for develoment
	define("s_admin", true); # Set to false to disable the admin
	define("_PATH_", dirname(__FILE__).'/starlight');
	
	# Redis Config
	$single_server = array(
    	'host'     => '127.0.0.1', 
    	'port'     => 6379, 
    	'database' => 0,
		#'password' => ''
	);
	
?>