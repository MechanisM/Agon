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
include '../config.php';
include 'kickstarter.php';
if(!s_admin)
	fail("The Admin has been hard disabled","hardAdminDisabled",'503 Service Unavailable');

if (!isset($_SESSION['s.admin'])) {
	if($_POST) {
		$u = $redis->lrange('slight.config.users',0,2);
		if ($_POST['u'] != $u[0] or md5($_POST['p']) != $u[1]) {
			fail("Invalid login information","AdminInvalidInfo");
		} else {
			$_SESSION['s.admin'] = true;
			header("Location: ?");
		}
	} else {
		include 'admin/login.tpl.php';
		die();
	}
}

if(isset($_POST['realm']) and isset($_POST['function'])) {
	if(!include 'admin/'.$_POST['realm'].'.process.realm.php')
		fail('The requested process realm was not fouund', 'AdminRealmNotFound');	
} else if (isset($_GET['f'])) {
	if(!include 'admin/'.$_POST['realm'].'.realm.php')
		fail('The requested realm was not fouund', 'AdminRealmNotFound');	
} else {
	# Default to write
	include 'admin/write.realm.php';
}

?>
