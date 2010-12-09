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
	* @link http://archandel.io/redir/starlight
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
				# The data is in the format of ?f=page/2 or ?f=post/3 or ?f=static/page name
				# $v will be page/3 or something like that
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
						$this->showpage($this->prams); 		break;
					case 'post':
						$this->showpost($this->prams); 		break;
					case 'static': 
						$this->showstatic($this->prams); 	break;
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
			$limit = _c("slight.config.list"); # The number to show per page

			$tpl->posts = array(
				(( $num * $limit ) - $limit), 
				(( $num * $limit )),
				$posts
			);
			$tpl->nav = array(
				($max < count($posts)) ? true : false), # Back
				($num > 1 ? true : false) # Next?
			);
			$tpl->display("starlight/templates/default/posts.tpl.php");
		}
		
		
		public function showpost($num){
			global $tpl;
			$tpl->meta = array(
					'id'	=> $num,
					'title' => $redis->lindex(('slight.post'.$id),1)
				);
			$tpl->body = $redis->lindex(('slight.post'.$id),1);
			$tpl->display("starlight/templates/default/page.tpl.php");
		}
	}
?>