<?php
	include 'header.tpl.php'; # Makesure we have the header included
	for($i = $this->posts[0]; $i < $this->posts[1]; $i++) {
		if($this->posts[2][$i])
			echo $this->posts[2][$i][1]."<br />"; # Here we just tell the templatting class to do its stuff
	}
	if($this->nav[1])
		echo "Go back";
	if($this->nav[0])
		echo "Go next";
?>

<?php
	include 'footer.tpl.php'; # Makesure we have the header included
?>