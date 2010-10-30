<?php
	class starlight {
		public $func = "";
		public $prams = "";
		# Welcome to the s class. Here we will do most of the work that we need to get data from redis, format it, and then pass it on to the template class
		# First we need to work on the add var function, which will be triggered if we have a f var in the url. 
		public function addvar($v) {
			if($v) {	# Make sure we actually have data to read, if we dont, we dont want errors to displayed.
				# The data is in the format of ?f=page/2 or ?f=post/3 or ?f=static/page name
				# $v will be page/3 or something like that
				$v = explode("/",$v); # Here we will seperate page and the number
				$this->func = $v[0]; # Set the function to the requested function
				$this->prams = $v[1]; # Here we set the prameters to the id or page name that we want. Maybe a user profile?
			}
		}
		
		# Now we need to add a start function
		public function start(){
			if($this->func and $this->prams) { # Check if we have a function that we need to run
				switch($this->func){ # Switchboard for the functions in which we will call localized functions
					case 'page': 
						$this->showpage($this->prams); break;
					case 'post':
						$this->showpost($this->prams); break;
					case 'static': 
						$this->showstatic($this->prams); break;
				}
			} else { # Just do the generic list latest posts in the database
				$this->showpage(1);
			}
		}
		# This is the function to show the post list
		public function showpage($num){
			global $redis, $tpl;
			
			# First we need to add the post ids to an array so we make sure we have valid posts that we can access
			$posts = array();
			$latest = intval(_c("com.posts.latest"));
			for($i = $latest; $i > 0; $i--) {
				$return  = _c("com.posts.".$i);
				if($return)
					$posts[] = array($i,$return);
			}
			
			# If we have page 1, we need to show posts 0-4 from the array
			$limit = _c("com.posts.list"); # The number to show per page

			$tpl->posts = array(
				(( $num * $limit ) - $limit), 
				(( $num * $limit )),
				$posts
			);
			$tpl->nav = array(
				($max < intval(_c("com.posts.total")) ? true : false), # Back
				($num > 1 ? true : false) # Next?
			);
			$tpl->display("starlight/templates/default/posts.tpl.php");
			
			
		}
		
		
		public function showpost($num){
			echo "<pre>"._c("com.posts.post.".$num);
			echo "\r\n"._c("com.posts.post.".$num.".data");
		}
	}
?>