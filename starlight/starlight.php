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
					case 'page': $this->showpage($this->prams); break;
					case 'post': $this->showpost($this->prams); break;
					case 'static': $this->showstatic($this->prams); break;
				}
			} else { # Just do the generic list latest posts in the database
				$this->showpage(1);
			}
		}
	}
?>