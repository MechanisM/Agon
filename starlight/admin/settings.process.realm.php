<?php
	# Update title
	$redis->set("slight.config.name",$_POST['title']);
	$redis->set("slight.config.desc", $_POST['desc']);
	
	if(is_int($_POST['ppp'])) # If we have an interger
		$redis->set("slight.config.list",$_POST['ppp']);
	else # Set it back to 5
		$redis->set("slight.config.list",5);
		
	header("Location: ?f=settings");
	
	