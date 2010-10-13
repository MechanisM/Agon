<?php
	class page extends starlight {
		public function showpage($num){
			global $redis;
			
			# First we need to add the post ids to an array so we make sure we have valid posts that we can access
			$posts = array();
			$latest = intval(count(_c("com.posts.latest")));
			for($i = $latest; $i > 0; $i--) {
				$return  = _c("com.posts.".$i);
				if($return)
					$posts[] = $i;
			}
			# If we have page 1, we need to show posts 0-4 from the array
			$limit = _c("com.posts.list"); # The number to show per page
			$min = ( $num * $limit ) - $num; # We need to get 5 from 2
			$max = ( $num * $limit ) - 1; # For max we need to get 
			
			for($i = $max; $i > $min; $i--) {
				echo "Reading posts[".$i."]<br />";
			}
		}
	}
?>