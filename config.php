<?php
    define("s_version", "0.4.6a");
    define("s_release", true); # Set to false for develoment
    define("s_admin", true); # Set to false to disable the admin
    define("_PATH_", dirname(__FILE__).'/agon');
    
	$single_server = array(
	    'host'     => '127.0.0.1', 
	    'port'     => 6379, 
	    'database' => 0,
		#'password' => ''
	);
?>