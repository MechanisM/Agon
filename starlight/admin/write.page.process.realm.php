<?php
	/*
	 * 0 Slug
	 * 1 Title
	 * 2 Body
	 * 3 null
	 * 4 Syntax 
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
	
	$redis->rpush("slight.page.".$slug, $slug);	
	$redis->rpush("slight.page.".$slug, strip_tags(trim($_POST['title']))); # Set the title
	$redis->rpush("slight.page.".$slug, $_POST['body']); # Set the body

	$redis->rpush("slight.page.".$slug, "null"); # ?
	$redis->rpush("slight.page.".$id, "textile"); # Markup language
header("Location: ?f=manage.pages");
