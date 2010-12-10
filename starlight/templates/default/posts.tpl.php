<?php
	include 'header.tpl.php'; # Makesure we have the header included

	if($this->nav[1])
		echo "Go back";
	if($this->nav[0])
		echo "Go next";
?>
<?php for ($i = $this->posts[1]; $i >= $this->posts[0]; $i--): ?>
	<?php if(isset($this->posts[2][$i])): 
			$info = (object) array('id' => _i($this->posts[2][$i],0),'title' => _i($this->posts[2][$i],1), 'date' => _i($this->posts[2][$i],2), 'body' => _i($this->posts[2][$i],3));
	?>
			<div class="post" id="post-4">
				<h2><a href="?f=post/<?php echo gS($info->id); ?>" rel="bookmark"><?php echo $info->title; ?></a></h2>
			    <small><?php echo $info->date; ?></small>
				<div class="entry">
					<?php echo $info->body; ?>
				</div>
				<p class="postmetadata">
					Posted in <a href="http://wp-themes.com/?cat=6" title="View all posts in First Child Category" rel="category">First Child Category</a> | <span>Comments Off</span>
				</p>
			</div>
	<?php endif; ?>
<?php endfor; ?>

<?php
	include 'footer.tpl.php'; # Makesure we have the header included
?>