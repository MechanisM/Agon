	<ol>
		<?php for($j = 0; $j<$this->max; $j++): ?>
			<?php $i = $this->$j; ?>
			<li id="comment-<?php echo $i->num; ?>" class="comment c c-y2007 c-m04 c-d08 c-h16 alt depth-1">
				<div class="comment-author vcard"><?php get_gravatar($i->email, true); ?> <span class="fn n"><a href='http://www.example.com/vishnu' rel='external nofollow' class='url url'><?php echo $i->name; ?></a></span></div>
				<div class="comment-meta">Posted April 8, 2007 at 9:08 pm <span class="meta-sep">|</span> <a href="#comment-12" title="Permalink to this comment">Permalink</a></div>
				<div class="comment-content">
					<?php echo $i->body; ?>
				</div>
			</li>
   		<?php endfor; ?>
	</ol>