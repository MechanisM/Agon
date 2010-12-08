<?php

	function doAddNewPage() {
		$err = array();
		if($_POST['title'] == "" or $_POST['title'] == " ")
			$err[] = "No Title Entered, which you need to do";
		if($_POST['slug'] == " ")
			$err[] = "You need to leave the slug field blank to auto-gen one";
		if($_POST['body'] == "" or $_POST['body'] == " ")
			$err[] = "You need to enter a body";
		
		if(count($err) > 0)
			return $err;
		
		if($_POST['slug'])
			$slug = strtolower(str_replace(' ', '-', $_POST['slug']));
		else
			$slug = strtolower(str_replace(' ', '-', $_POST['title']));
			
				# Get the latest ID and add one to it
		$id = intval(_c("slight.post.latest")) + 1;
			$redis->set("slight.post.latest",$id);

		$redis->rpush(("slight.post.".$id),$_POST['title']);
		$redis->rpush(("slight.post.".$id),$_POST['body']);
		
		$redis->set(("slight.slug.".$slug),$id);
		
		header("Location: ?do=home&secuess=new-post");
	}

	function adminDoProcess() {
		if($_POST['method'] == 'new-page')
			doAddNewPage();
	}
?>