	<ol>
		<?php for($j = 0; $j<$this->max; $j++): ?>
			<?php $i = $this->$j; ?>
    	<li id="comment-<?php echo $i->num; ?>" class="comment c c-y2007 c-m04 c-d08 c-h16 alt depth-1">
    		<div class="comment-author vcard"><img alt='' src='http://www.gravatar.com/avatar/3fe55405d32fad7423b70008aeb07c10?s=80&amp;d=http%3A%2F%2Fwww.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D80&amp;r=G' class='photo avatar avatar-80 photo' height='80' width='80' /> <span class="fn n"><a href='http://www.example.com/vishnu' rel='external nofollow' class='url url'><?php echo $i->name; ?></a></span></div>
    		<div class="comment-meta">Posted April 8, 2007 at 9:08 pm <span class="meta-sep">|</span> <a href="#comment-12" title="Permalink to this comment">Permalink</a></div>
                <div class="comment-content">
                <?php echo $i->body; ?>
	    		</div>
   		</li>
   		<?php endfor; ?>
	</ol>