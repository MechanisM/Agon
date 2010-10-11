<?php
	class page extends s {
		public function showpage($num){
			# First we need to add the post ids to an array so we make sure we have valid posts that we can access
			$posts = array();
			$latest = intval(count(_c("com.post.latest")));
			for($i = $latest; $i > 0; $i--) {
				
			}
			# If we have page 1, we need to show posts 0-4 from the array
			$limit = _c("com.post.list"); # The number to show per page
			$min = ( $num * $limit ) - $num; # We need to get 5 from 2
			$max = ( $num * $limit ) - 1; # For max we need to get 
		}
	}
?>