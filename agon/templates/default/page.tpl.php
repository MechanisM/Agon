<?php
    if($this->nav[1])
        $navBACK = true;
    if($this->nav[0])
        $navNEXT = true;

    include 'header.tpl.php'; # Makesure we have the header included
?>
<?php for ($i= $this->limits[0]; $i < $this->limits[1]; $i++): ?>
<?php if(isset ($this->posts[$i])): ?> <!-- If there is a value -->
<!-- We need a better way to do this. Maybe a better theme engine? -->
<?php $info = meta2obj($this->posts[$i]); ?>
<!--
Valid Commands
$info->id The ID of the post
$info->title The title of the post
$info->body The Content of the post
$info->author The author of the post
$info->date The date of the post
-->
<div id="post-">
<h2 class="entry-title">
<a href="?f=<?php echo $info->slug; ?>" title="Permalink to <?php echo $info->title; ?>" rel="bookmark"><?php echo $info->title; ?></a>
</h2>
<div class="entry-meta">
<span class="meta-prep meta-prep-author">By </span><span class="author vcard"><a class="url fn n">Colum</a></span><span class="meta-sep meta-sep-entry-date"> | </span><span class="meta-prep meta-prep-entry-date">Published: </span><span class="entry-date"><abbr class="published"><?php echo $info->date; ?></abbr></span>
</div><!-- .entry-meta -->
<div class="entry-content">
<?php echo $info->body; ?>
<div class="entry-utility"><span class="cat-links">Posted in <a href="http://themeshaper.com/demo/thematic/?cat=4" title="View all posts in Examples" rel="category">Examples</a>, <a href="http://themeshaper.com/demo/thematic/?cat=6" title="View all posts in News" rel="category">News</a>, <a href="http://themeshaper.com/demo/thematic/?cat=8" title="View all posts in SubCategoryA" rel="category">SubCategoryA</a>, <a href="http://themeshaper.com/demo/thematic/?cat=10" title="View all posts in SubCategoryB" rel="category">SubCategoryB</a></span> <span class="meta-sep meta-sep-tag-links">|</span><span class="tag-links"> Tagged <a href="http://themeshaper.com/demo/thematic/?tag=comments" rel="tag">comments</a>, <a href="http://themeshaper.com/demo/thematic/?tag=headings" rel="tag">headings</a>, <a href="http://themeshaper.com/demo/thematic/?tag=quotes" rel="tag">quotes</a></span> <span class="meta-sep meta-sep-comments-link">|</span> <span class="comments-link"><a href="http://themeshaper.com/demo/thematic/?p=23#comments" title="Comment on A paginated post">21 Comments</a></span></div><!-- .entry-utility -->
</div>
</div>
<?php endif;?>
<?php endfor; if(count($this->posts) == 0): ?>
Sorry, there are no posts at this time.
<?php endif; ?>

<?php
    include 'footer.tpl.php'; # Makesure we have the header included
?>