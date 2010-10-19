<?php
	class post extends page {
		public function showpost($num){
			echo "<pre>"._c("com.posts.post.".$num);
			echo "\r\n"._c("com.posts.post.".$num.".data");
		}
	}
?>