<?php
# Copyright (c) 2010, Colum McGaley
# All rights reserved.

# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

# Based off the indexhibit install script by Vaska

	// turn this on if you want to check things
	//error_reporting(E_ALL);

// Update your values here. Going to do this a better way next release
define('R_HOST', '127.0.0.1');
define('R_PORT', 6379);
define('R_DATA', 0);

    // Update this file every release
    define('VERSION', '0.3.2');

	//require_once 'defaults.php';
	$s = array (
        'slight.config.name' => 'Starlight Testing',
        'slight.config.desc' => 'This is a test of the starlght blogging system',
        'slight.config.template' => 'Default',
        'slight.config.list' => '5',
        'slight.config.comment-list' => 'true'
    );
    
    
	function writeConfig( $host, $port, $database, $password )
	{
		$config = dirname(__FILE__) . "/config.php";
		
		$somecontent = "
<?php
    define(\"s_version\", ".VERSION.");
	define(\"s_release\", true); # Set to false for develoment
	define(\"s_admin\", true); # Set to false to disable the admin
	define(\"_PATH_\", dirname(__FILE__).'/starlight');
	
	\$single_server = array(
    	'host'     => '".$host."', 
    	'port'     => ".$port.", 
    	'database' => '".$database."',
		#'password' => '".$password."'
	);
?>";

		if (is_writable($path)) 
		{
			if (!$handle = fopen($filename, 'w')) 
			{
				return FALSE;
			}

			if (fwrite($handle, $somecontent) === FALSE) 
			{
				return FALSE;
			}

			fclose($handle);
			return TRUE;
		}

		return FALSE;
	}
	
	header ('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Install : starlight</title>

<link type="text/css" rel='stylesheet'  href="asset/css/style.css" />
	
<style type='text/css'>
body { font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 10px; }
h1, h2 { margin: 6px 0 0 3px; }
h2 { margin-bottom: 6px; }
p { margin: 0 0 6px 3px; font-size: 12px; width: 300px; }
p.red { color: #c00; }
code { margin: 18px 0; font-size: 12px; }
.ok { color: #0c0; padding-right: 9px; }
.ok-not { color: #f00; padding-right: 9px; }
#footer { border-top: none; }
#log-form { margin-left: 3px; }
</style>
</head>

<body>
<div id='all'>

<h1>Indexhibit</h1>

<div id='main'>

<form action='' method='post'>
	
<?php

	if ((is_writable('./config.php')))
	{
		$c = true;
		echo "<p><span class='ok'>OK</span>Config Writeable</p>\n";
        $redis = new Predis_Client(array(
		    'host'     => $s['host'],
		    'password' => $s['password'], 
		    'database' => $s['database'], 
		));
		# Because Predis does not thorw an error when the class is created
		# We can check because this command will return an array if true
		# String if it is false
		$cmdSet = $redis->createCommand('keys');
		$cmdSet->setArguments('*');
		@$cmdGetReply = $redis->executeCommand($cmdSet);
		if(!is_array($cmdGetReply))
			echo "<p><span class='ok'>XX</span>Database not accessable</p>\n";
        else {
            if(writeConfig(R_HOST, R_PORT, R_DATA, null)) {
                echo "<p><span class='ok'>OK</span>Config Written</p>\n";
                $redis->mset($s);
                $redis->rpush('slight.config.users','admin');
                $redis->rpush('slight.config.users','5f4dcc3b5aa765d61d8327deb882cf99'); # Password, is password
                echo "<p><span class='ok'>OK</span>Database Written</p>\n";
                echo "<p>Admin login is at /starlight. Username is 'admin' and the password is 'password'";
              
                
            } else {
                echo "<p><span class='ok'>XX</span>Config Write error</p>\n";
            }
        }
	}
	else
	{
		echo "<p><span class='ok-not'>XX</span>Config not Writeable</p>";
	}
?>
</form>

<div class='cl'><!-- --></div>

</div>

<div id='footer' class='c2'>
	<div class='col'><a href='<?php echo BASEURL.BASENAME ?>/license.txt'>License</a></div>
	<div class='cl'><!-- --></div>
</div>
	
</div>
</body>
</html>
