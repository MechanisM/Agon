<?php 
	require 'theme/header.tpl.php';
?>
<table>
	<tr>
		<th>Title</th>
		<th>Date</th>
	    <th>Author</th>
	    <th>Actions</th>
	</tr>
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
	$posts = $redis->keys("slight.post.*");
	$h = count($posts);
	for($x = 0; $x<$h; $x++) {
		$z = $redis->lrange($posts[$x],0,9);
		echo "<tr>
				    <td>".$z[2]."</td>
				    <td>".$z[3]."</td>
				    <td>".$z[4]."</td>
				    <td><a href='?f=edit&edit=".$z[0]."'>Edit</a></td>
				</tr>";
	}
	?>
</table>
	<?php 
	require 'theme/footer.tpl.php';
?>