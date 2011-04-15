<?php
	include 'header.tpl.php'; # Makesure we have the header included
?>
	<div class="post">
		<h2><a href="?f=post/<?php echo $this->slug; ?>" rel="bookmark"><?php echo $this->title; ?></a></h2>
		<div class="entry">
			<?php echo $this->body; ?>
		</div>
	</div>

<?php
	include 'footer.tpl.php'; # Makesure we have the header included
?>