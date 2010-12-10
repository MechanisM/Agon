<?php
	include 'header.tpl.php'; # Makesure we have the header included
?>
	<div class="post">
		<h2><a href="?f=post/<?php echo $this->slug; ?>" rel="bookmark"><?php echo $this->title; ?></a></h2>
	    <small>20th June, 2008 <!-- by Theme Admin --></small>
		<div class="entry">
			<?php echo $this->body; ?>
		</div>
		<div>
			Comments go here
		</div>
	</div>

<?php
	include 'footer.tpl.php'; # Makesure we have the header included
?>