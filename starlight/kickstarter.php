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

	define("s_version", "0.0.4");
	define("s_release", false); # Set to false for develoment
	define("s_admin", true); # Set to false to disable the admin
	
	
	require_once "starlight/classes/predis/Predis.php";	# Database
	require_once "starlight/starlight.php";				# Core		
	require_once 'starlight/classes/Savant3.php';		# Themeing
	require_once 'starlight/classes/classTextile.php';	# Formatting
	
	$redis = new Predis_Client($single_server);			# Start the Redis connection
	$s = new starlight();								# Start the basic classes
	$tpl = new Savant3();									
	$textile = new Textile();
	
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
	function gC($i){
		global $s;
		$s->readcomments($i);
	}
	
	function fail($msg,$code, $header = false) {
		if($header)
			header($header);
			
		die($msg."<br />Read more on this error <a href='http://in.decay.me/bouncer/starlight/?bounce=error&code=".$code."'>here</a>");
	}

