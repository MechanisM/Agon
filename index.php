<?php
	//index.php file for Starlight. Yo
	if(!file_exits("config.php"))
		die("Starlight has not been installed or the config file is corrupt. Please go <a href='starlight/install/install.php'>Here to start the installer</a>");
	
	require("config.php");
	require("system/starlight.php");
	
	if($_GET['f'])
		$s->addvar($_GET['f']);
	
	$s->start();
?>