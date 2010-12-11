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

/**
	* Process the add a new page request
	* @return Header redirect on secuess, error log on failure
	*/ 
	function doAddNewPage() {
		global $redis; 
		
		$err = array();
		if($_POST['title'] == "" or $_POST['title'] == " ")
			$err[] = "No Title Entered, which you need to do";
		if($_POST['slug'] == " ")
			$err[] = "You need to leave the slug field blank to auto-gen one";
		if($_POST['body'] == "" or $_POST['body'] == " ")
			$err[] = "You need to enter a body";
		
		if(count($err)) {
			die(var_dump($err));
		}
		
		if($_POST['slug'])
			$slug = strtolower(str_replace(' ', '-', $_POST['slug']));
		else
			$slug = strtolower(str_replace(' ', '-', $_POST['title']));
			
		# We can not rely on the count() because there might be spaces
		$a = $redis->keys('slight.post.*');
		$c = count($a);

		$id = $c + 1;

		$redis->rpush(("slight.post.".$id),$id);
		$redis->rpush(("slight.post.".$id),$_POST['title']);
		$redis->rpush(("slight.post.".$id),'d-m-y');
		$redis->rpush(("slight.post.".$id),$_POST['body']);
		
		$redis->set(("slight.slug.".$slug),$id);
		$redis->set(("slight.slug.".$id),$slug);
		
		header("Location: ?do=home&secuess=new-post");
	}
  /**
	* Function to process the edit request
	* @return Header redirect on secuess, error log on failure
	*/ 
	function doEditPost() {
		gloal $redis;
		
	}

	function adminDoProcess() {
		if($_POST['method'] == 'new-post')
			doAddNewPage();
		else if ($_POST['method'] == 'edit-post')
			doEditPost();
	}
	
	# Login in function
	function adminDoLogin() {
		if($_POST['username'] and $_POST['password']) {
			$users = $redis->lrange('slight.config.users',0,2); # get all of them. TODO!!!
			if($users[0] != $_POST['username'] or $user['password'] != $_POST['password']) {
				echo "<p style='color:red'>The inputted information does not match</p>";
			} else {
				$_SESSION['logged'] = true;
				header("Location: ?do=");
			}
		}
		echo '<form method="post" action=""><p><label for="username">Username: </label>input type="text" name="username" id="username" /></p><p><label for="password">Password: </label><input type="password" name="password" id="password" /></p><p><input type="submit" name="button" id="button" value="Submit" /></p></form>
		';
	}
?>