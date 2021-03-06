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
	 * Function to read the comments for a given article
	 * @author Colum McGaley <c.mcgaley@gmail.com>
	 * @license GUN Public Licence
	 * @param int $id
	 * @since starlight-0.1.3-TRUNK
	 */ 		
	function readcomments($id){
		global $redis, $tpl, $textile;

		$pid = process_url($id);
		$comments = $redis->keys('agon.'.$pid[2].'.c:*'); # We get all the keys that are comments to this post
		sort($comments);
		
		//if($redis->get('slight.config.comment-list') == 'true') # We allow the user to change the order
		//	$comments = array_reverse($comments);

		for($i = 0; $i < count($comments); $i++){
			$tpl->$i = (object) true; # We just need something to tell the object is an object, so we dont get errors below
			$tpl->$i->num   = $i; # Comment number

			$u = $redis->hgetall($comments[$i]);
			$tpl->$i->name  = $u['name'];
			$tpl->$i->date  = $u['timestamp'];
			$tpl->$i->email = $u['email'];
			//TODO: Add website field
			if(s('markdown') == '1') {
				if(!class_exists($textile)) {
					echo "Textile not loaded. This is a bug...";
				} else {
					$tpl->$i->body  = $textile->TextileThis($u['content']);	
				}
			} else {
				$tpl->$i->body  = strip_tags($u['content']);
			}
		}
		$tpl->max = $i;
		$tpl->display("agon/templates/".s('template')."/comments.tpl.php");
	}
	/**
	 * Fuunction to add a comment to a post
	 * @author Colum McGaley <c.mcgaley@gmail.com>
	 * @license GUN Public Licence
	 * @param int $slug
	 * @since starlight-0.1.4-TRUNK
	 * @todo Make sure this function uses the ID of a post, not the slug
	 */
	function add_comment($id) {
		global $redis;
		if(!$_POST) {
			header("Location: ?");
		}

		if(trim($_POST['author']) == "" or trim($_POST['email']) == "" or trim($_POST['comment']) == "" or trim($_POST['human']) == "") {
			die(__('error', 'empry_field'));
		}	
			if(!eregi("^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email'])){
				die(__('error', 'invalid_email'));
			}
		if($_POST['human'] != '5') { # 2 + 3
			die(__('error', 'invalid_human'));
		}
		$comments = $redis->keys('agon.'.$id.'.c:*');
		$cid = count($comments) + 1;
		
		$redis->hset('agon.p:'.$id[1].'.c:'.$cid, 'name', $_POST['author']);
		$redis->hset('agon.p:'.$id[1].'.c:'.$cid, 'email', $_POST['email']);
		$redis->hset('agon.p:'.$id[1].'.c:'.$cid, 'content', $_POST['comment']);
		$redis->hset('agon.p:'.$id[1].'.c:'.$cid, 'timestamp', 'TIMESTAMP'); // Todo, TIMESTAMP
		
		header("Location: ../?f=".$_GET['slug']);			
	}
	function get_gravatar( $email, $img = false, $s = 80, $d = 'mm', $r = 'g', $atts = array() ) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		echo $url;
	}
?>
