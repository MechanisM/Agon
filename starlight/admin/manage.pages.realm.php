<?php 
	require 'theme/header.tpl.php';
?>
<table>
	<tr>
		<th>Title</th>
	    <th>Actions</th>
	</tr>
<?php
	/*
	 * 0 Slug
	 * 1 Title
	 * 2 Body
	 * 3 null
	 * 4 Syntax 
	 */
	$posts = $redis->keys("slight.page.*");
	$h = count($posts);
	for($x = 0; $x<$h; $x++) {
		$z = $redis->lrange($posts[$x],0,9);
		echo "<tr>
				    <td>".$z[1]."</td>
				    <td><a href='?f=edit.page&edit=".$z[0]."'>Edit</a></td>
				</tr>";
	}
	?>
</table>
	<?php 
	require 'theme/footer.tpl.php';
?>