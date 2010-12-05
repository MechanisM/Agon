<?php
	if($_POST){
		include '../config.php';
		# Get the latest ID and add one to it
		$id = _c("com.posts.latest");
		$id = intval($id) + 1;

		# To encode something with JSON, we need an array
		$arr = array("title"=>$_POST['title']);
		
		$redis->set(("com.posts.".$id),json_encode($arr));	# Set the base data							com.posts.1
		$redis->set("com.posts.".$id.".data",$_POST['body']); # Set the content			com.posts.1.content
		$redis->set("com.posts.latest",$id);
	}
?>
<form id="form1" name="form1" method="post" action="">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" />
    
    <label for="body">Body</label>
    <textarea name="body" id="body" cols="45" rows="5"></textarea>
    
    <input type="submit" name="button" id="button" value="Submit" />
</form>