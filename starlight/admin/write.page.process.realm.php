<?php
	/*
	 * 0 Slug
	 * 1 Title
	 * 2 Body
	 * 3 Comments
	 * 4 Disable Time
	 * 5 Syntax 
	 */
	if(!isset($_POST['title']) or !isset($_POST['title'])) { # Make sure we have a title
		die("One of the feilds was left empty");
	}
	
	# Generate post slug
		if(isset($_POST['slug']) and $_POST['slug'] != "") {
			$slug = strtolower(str_replace(' ', '-', $_POST['slug']));
		} else {
			$slug = strtolower(str_replace(' ', '-', $_POST['title']));
		}
		$o = 2; # We will just add another number to the end of the slug
		do {
			$slug .= "-".$o;
			$o++; # Increase the number
		} while ($redis->get("slight.slug.".$slug));
	
	$redis->rpush("slight.page.".$id, $slug);	
	$redis->rpush("slight.post.".$id, strip_tags(trim($_POST['title']))); # Set the title in the 3rd place
	$redis->rpush("slight.post.".$id, time()); # Time
	$redis->rpush("slight.post.".$id, "Admin"); # Set the title in the 3rd place
	$redis->rpush("slight.post.".$id, $_POST['body']); # Set the title in the 3rd place

	$redis->rpush("slight.post.".$id, "true"); # Comments enabled?
	$redis->rpush("slight.post.".$id, "6"); # Time (in weeks) to disable comments after
	$redis->rpush("slight.post.".$id, "textile"); # Markup language
header("Location: ?f=manage");
