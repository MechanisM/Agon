<?php
	class page extends starlight {
		public function showpage($num){
			global $redis;
			
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
			$min = ( $num * $limit ) - $limit ; # We need to get 0 from 1 1*5-5=0
			$max = ( $num * $limit ); # For max we need to get 
			echo "<pre>Array:\r\n";
			for($i = $min; $i < $max; $i++) {
				if($posts[$i])
					echo $posts[$i][1]."\r\n"; # Here we just tell the templatting class to do its stuff
			}
			# Check if need a go back button
			if($num > 1) {
				echo "\r\n<a href='?f=page/1'>Back</a>";
			}
			# Check if we have another page
			if($max < intval(_c("com.posts.total"))) {
				echo "\r\n<a href='?f=page/2'>Next</a>";
			}
			
		}
	}
?>