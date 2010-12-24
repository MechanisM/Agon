<?php
	if(!isset($_SESSION['s.admin'])) {
		fail("You are not logged in","AdminNoSession");
	}
	
	$err = array();
	if($_POST['title'] == "" or $_POST['title'] == " ")
		$err[] = "No Title Entered";
	if($_POST['slug'] == " ")
		$err[] = "You need to leave the slug field blank to auto-generate one";
	//if($_POST['body'] == "" or $_POST['body'] == " ")
	//		$err[] = "You need to enter a body";
		
	if(count($err) > 0) {
		die(var_dump($err));
	}
		
	if($_POST['slug']) {
		$slug = strtolower(str_replace(' ', '-', $_POST['slug']));
		//TODO Check if there is already a slug in the database with the same value
	} else {
		$slug = strtolower(str_replace(' ', '-', $_POST['title']));
	}
	# We can not rely on the count() because there might be spaces
	$a = $redis->keys('slight.post.*');
	$c = count($a);

	$id = $c + 1; # Get a new id

	$redis->rpush(("slight.post.".$id),$id);
	$redis->rpush(("slight.post.".$id),$_POST['title']);
	$redis->rpush(("slight.post.".$id),date('F j, Y'));
	$redis->rpush(("slight.post.".$id),$_POST['body']);
		
	$redis->set(("slight.slug.".$slug),$id);
	$redis->set(("slight.slug.".$id),$slug);
		
	header("Location: ?do=home&secuess=new-post");