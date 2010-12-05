<?php
	include 'header.tpl.php'; # Makesure we have the header included

	if($this->nav[1])
		echo "Go back";
	if($this->nav[0])
		echo "Go next";
?>

    <?php for ($i = $this->posts[0]; $i < $this->posts[1]; $i++): ?>
		<?php 
			if($this->posts[2][$i][0]):
			$info = json_decode($this->posts[2][$i][1]);
		?>
		<div class="post" id="post-4">
			<h2><a href="?f=post/<?php echo $this->posts[2][$i][0]; ?>" rel="bookmark"><?php echo $info->title; ?></a></h2>
		    <small>20th June, 2008 <!-- by Theme Admin --></small>
			<div class="entry">
				<?php echo $this->posts[2][$i][2]; ?>
			</div>
			<p class="postmetadata">
				Posted in <a href="http://wp-themes.com/?cat=6" title="View all posts in First Child Category" rel="category">First Child Category</a> | <span>Comments Off</span>
			</p>
		</div>
    <?php endif; endfor; ?>
<?php
	include 'footer.tpl.php'; # Makesure we have the header included
?>