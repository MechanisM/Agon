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
	session_start();
	define('codebase_version', 'agon-0.2.1-dev'); # This should match kickstarter
	
	
	if($_POST['step'] == '1') { # We are processing data from Step 1
		$d = array();
		//var_dump($_POST);
		if( $_POST['Host'] == "" ) $d['host'] = '127.0.0.1';
			else $d['host'] = $_POST['Host'];
		if( $_POST['Database'] == "" ) $d['database'] = '0';
			else $d['database'] = $_POST['Database'];
		if( $_POST['pwd'] == "" ) $d['password'] = '';
			else $d['password'] = $_POST['pwd'];
		
		# Start building config file
		$s = "<?php\n";
		$s .= "define('s_release', false); # Set to false for develoment\n";
		$s .= "define('s_admin', true); # Set to false to disable the admin\n";
		$s .= "define('_PATH_', dirname(__FILE__).'/agon');\n";
		
		if( $_POST['sd'] == 'on' ) {
			if(!class_exists('Redis'))
				die('PHP Redis not found. Please uncheck use "PHP Redis"');
			
			$redis = new Redis();
			if(!$redis->connect($d['host'], 6379, 10)) # Try the connection
				die('Can not connect to the database running on '.$d["host"].':6379. Please check your connection settings and your filewall.');
			
			if($d['password']) {
				if(!$redis->auth($d['password']))
					die('Can not connect with the provided password');
			}
			
			if(!$redis->select($d['database']))
				die('Can not select the database');
				
			# We have a connection
			$s .= "$redis = new Redis();\n";
			$s .= "$redis->connect(".$d['host'].", 6379, 10);\n";
			if($d['password'])
				$s .= "	$redis->auth('".$d['password']."');\n";
			$s .= "$redis->select(".$d['database'].");\n";
		} else {
			try {
				new Predis_Client(array(
	    			'host'     => $d['host'], 
	    			'database' => $d['database'],
					'password' => $d['password']
				));
			} catch (Exception $e) {
				die("Execption caught: ".$e->getMessage());
			}
			$s .= "require_once _PATH_ . '/classes/predis/Predis.php';\n";
			$s .= "$redis   = new Predis_Client(array(\n";
			$s .= "'host'     => '".$d['host']."', \n";
			$s .= "'database' => ".$d['database'].",\n";
			if($d['password'])
				$s .= "'password' => '".$d['password']."',\n";
			$s .= "));\n";
		}
		
		// Write Config
		$myFile = "testFile.txt";
		$fh = fopen("../../config.php", 'w') or die("Can't open config.php for writing");

		fwrite($fh, $stringData);
		fclose($fh);
		require 'step2.tpl.php';
	} else if($_POST['step'] == '2') {
	
		$err = array();
		$data = array();
		if ($_POST['blogname'] == "" or count($_POST['blogname']) < 6) $err[] = "Invalid Blog Name";
			else $data['blogname'] = $_POST['blogname'];
		if ($_POST['blogdesc'] == "" or count($_POST['blogdesc']) < 6) $err[] = "Invalid Blog Description";
			else $data['blogdesc'] = $_POST['blogdesc'];
		if ($_POST['uid'] == "" or count($_POST['uid']) < 6) $err[] = "Invalid Admin Username";
			else $data['username'] = $_POST['uid'];
		
		list($username,$domain) = split('@',$_POST['email']);
		
		if ($_POST['email'] == "" or !checkdnsrr($domain,'MX')) $err[] = "Invalid Email";
			else $data['emai;'] = $_POST['email'];
		if ($_POST['pwd'] == "" or count($_POST['pwd']) < 6) $err[] = "Invalid Password";
			else $data['password'] = $_POST['pwd'];
		
		if(count($err > 0))
			die(var_dump($err));
		else {
			require '../config.php';
		}
	} else { # Display the 1st page
		require 'step1.tpl.php';
	}
	