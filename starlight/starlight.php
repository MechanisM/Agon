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
	* Main class for working with the system
	*
	* @copyright 2010 Colum McGaley
	* @license GUN Public Licence
	* @version Release: @package_version@
	* @link http://(domain)/redir/starlight
	* @since Class available since Release 0.0.1
	*/ 
	class starlight {
		
		public $func = "";
		public $prams = "";
		
	  /**
		* This function is used to define the current function for the system
		*
		* @param URI $v The request URi 
		* @throws Nothing
		* @return Nothing
		*/ 
		public function addvar($v) {
			if($v) {	# Make sure we actually have data to read, if we dont, we dont want errors to displayed.
				$v = explode("/",$v); # Here we will seperate page and the number
				$this->func = $v[0]; # Set the function to the requested function
				$this->prams = $v[1]; # Here we set the prameters to the id or page name that we want. Maybe a user profile?
			}
		}
		
	  /**
		* Function to start the system, and does all the processing
		*
		* @return Output
		*/ 
		public function start(){
			if($this->func and $this->prams) { # Check if we have a function that we need to run
				switch($this->func){ # Switchboard for the functions in which we will call localized functions
					case 'page': 
						$this->showpage($this->prams); 	break;
					case 'post':
						$this->showpost($this->prams); 	break;
					case 'static': 
						$this->showstatic($this->prams);break;
					case 'comment':
						$this->addcomment($this->prams);break;
				}
			} else { # Just do the generic list latest posts in the database
				$this->showpage(1);
			}
		}
	  /**
		* Function called to show the posts for the inputted page number
		*
		* @param integer $num The current page number
		* @throws Predis_Error If a redis query fails
		* @return Output of query
		*/ 
		# This is the function to show the post list
		public function showpage($num){
			global $redis, $tpl;
			
			# First we need to add the post ids to an array so we make sure we have valid posts that we can access
			$posts = $redis->keys('slight.post.*');
			
			# If we have page 1, we need to show posts 0-4 from the array
			$limit = $redis->get("slight.config.list"); # The number to show per page

			$tpl->posts = array(
				(( $num * $limit ) - $limit), 
				(( $num * $limit )),
				$posts
			);
			$tpl->nav = array(
				(($num * $limit) < count($posts) ? true : false), # Back
				($num > 1 ? true : false) # Next?
			);
			$tpl->display("starlight/templates/".$redis->get('slight.config.template')."/posts.tpl.php");
		}
	  /**
		* Function called to show a single post
		*
		* @param string $num The slug of the post
		* @throws Predis_Error If a redis query fails
		* @return Displays the theme
		*/ 
		private function showpost($num){
			global $redis, $tpl, $textile;
			
			$id = gS($num);
			$tpl->id = $id;
			$tpl->slug = $num;
			$tpl->title = $redis->lindex(('slight.post.'.$id),2);
			$tpl->date = $redis->lindex(('slight.post.'.$id),3);
			
			if($redis->lindex(('slight.post.'.$id),8) == '1')
				$tpl->body =  $textile->TextileThis($redis->lindex(('slight.post.'.$id),5));
			else
				$tpl->body =  $redis->lindex(('slight.post.'.$id),5);
				
			$tpl->display("starlight/templates/".$redis->get('slight.config.template')."/page.tpl.php");
		}
		
	  /**
		* Function called to show the comments for a post
		*
		* @param int $id The ID of the bost
		* @throws Predis_Error If a redis query fails
		* @return void
		*/ 		
		public function readcomments($id){
			global $redis, $tpl, $textile;
			
			$comments = $redis->keys('slight.comments.'.$id.'.*');

			if($redis->get('slight.config.comment-list') == 'true') # We allow the user to change the order
				$comments = array_reverse($comments);
				
			for($i = 0; $i < count($comments); $i++){
				$tpl->$i = (object) true; # We just need something to tell the object is an object, so we dont get errors below
				$tpl->$i->num   = $i; # Comment number
				
				$tpl->$i->name  = $redis->lindex($comments[$i],1);
				$tpl->$i->date  = $redis->lindex($comments[$i],2);
				$tpl->$i->email = $redis->lindex($comments[$i],3);
				//TODO: Add website field
				if($redis->get('slight.config.usetextile') == '1') {
					if(!class_exists($textile)) {
						echo "Textile not loaded. This is a bug...";
					} else {
						$tpl->$i->body  = $textile->TextileThis($redis->lindex($comments[$i],4));	
					}
				} else {
					$tpl->$i->body  = strip_tags($redis->lindex($comments[$i],4));
				}
			}
			$tpl->max = $i;
			$tpl->display("starlight/templates/".$redis->get('slight.config.template')."/comments.tpl.php");
		}

		public function addcomment($slug, $in) {
			global $redis;
			if(!$in and $slug)
				header("Location: ?f=post/".$slug);
			else if(!$in and !$slug)
				header("Location: ?f=page/1");
				
			if(trim($in['name']) == "" or trim($in['email']) == "" or trim($in['body']) == "" or trim($in['human']) == "") {
				die("One of the required fields was not filled in");
			}	
				if(!eregi("^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $in['email'])){
					die("Invalid Email");
				}
			if($in['human'] != 'yes') {
				die("You are not human");
			}
			$comments = $redis->keys('slight.comments.'.$slug.'.*');
			$r = count($comments);
			$d = ($redis->lindex($comments[($r - 1)],0)) + 1;
			
			$redis->rpush('slight.comments.'.$slug.'.'.$d,$d);
			$redis->rpush('slight.comments.'.$slug.'.'.$d,$in['name']); //TODO Add removal of tags
			$redis->rpush('slight.comments.'.$slug.'.'.$d,'date');
			$redis->rpush('slight.comments.'.$slug.'.'.$d,$in['email']);
			$redis->rpush('slight.comments.'.$slug.'.'.$d,$in['body']); //TODO Add removal of tags
			header("Location: ?f=post/".$slug);			
		}
	  /**
		* Function called to show a static page
		*
		* @param str $slug The page slug
		* @throws Predis_Error If a redis query fails
		* @return void
		*/
		public function showstatic($slug) {
			global $redis, $textile, $tpl;
			$page = $redis->lrange("slight.page.".$slug,0,4);
			
			$tpl->slug = $slug;
			$tpl->title = $page[1];
			
			if($page[4] == '1')
				$tpl->body =  $textile->TextileThis($page[2]);
			else
				$tpl->body =  $page[2];
				
			$tpl->display("starlight/templates/".$redis->get('slight.config.template')."/static.tpl.php");
			
		}
	}
?>