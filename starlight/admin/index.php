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

	session_start();
	
	require '../../config.php';
	require 'adminFunctions.php';
	
	//if(isset($_GET['do']) and isset($_SESSION['logged'])) {
	//	if($_GET['do'] == 'process')
	//		adminDoProcess();
	//}
	
	//if(!isset($_SESSION['logged'])) {
	//	adminDoLogin();
	//}
	
	if(!isset($_SESSION['ld'])) {
		$title = "Login";
		$message = "";
		$url = "../../";
		
		if(isset($_POST['p_userid']) and isset($_POST['p_password'])) {
			$users = array();
			$users = $redis->lrange('slight.config.users',0,2); # get all of them. TODO!!!
			if($_POST['p_userid'] == $user[0] and  $_POST['p_password'] == $user[1]) {
				$_SESSION['ld'] = true;
				header("Location: ?do=");
			} else {
				$message = "Invalid information";
			}
		}
		include 'data/header.tpl.php';
		include 'data/login.realm.php';
	} else {
		if(isset($_GET['do']) and $_GET['do'] != "") {
			switch($_GET['do']) {
				case 'new'		: 
					include 'data/new.realm.php'; 
				break;
				case 'process'	: include 'data/process.realm.php'; break;
				case 'settings'	: include 'data/settings.realm.php'; break;
			}
		} else {
			include 'data/dashboard.realm.php';
		}
	}
	include 'data/footer.tpl.php';
?>
