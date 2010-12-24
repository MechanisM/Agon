<?php
	/* 0 ID
	 * 1 Slug
	 * 2 Title
	 * 3 Date
	 * 4 Author
	 * 5 Body
	 * 6 Comments
	 * 7 Disable Time
	 * 8 Syntax
	 * 9 
	 */
	if(!isset($_POST['title']) or !isset($_POST['title'])) { # Make sure we have a title
		die("One of the feilds was left empty");
	}
	# TODO generate ID
	$y = $redis->keys("slight.post.*");
		$max = explode(".", $y[(count($y) - 1)]);
		$id = ($max[2]) + 1;
	
	$redis->rpush("slight.post.".$id,$id);	
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
		
	$redis->set("slight.slug.".$slug, $id);	# Set the slug, so we can access it
	$redis->set("slight.slug.".$id, $slug); # We can access the post via id or slug
	
	$redis->rpush("slight.post.".$id, $slug);	
	$redis->rpush("slight.post.".$id, strip_tags(trim($_POST['title']))); # Set the title in the 3rd place
	$redis->rpush("slight.post.".$id, time()); # Time
	$redis->rpush("slight.post.".$id, "Admin"); # Set the title in the 3rd place
	$redis->rpush("slight.post.".$id, $_POST['body']); # Set the title in the 3rd place

	$redis->rpush("slight.post.".$id, "true"); # Comments enabled?
	$redis->rpush("slight.post.".$id, "6"); # Time (in weeks) to disable comments after
	$redis->rpush("slight.post.".$id, "textile"); # Markup language
header("Location: ?f=manage");
