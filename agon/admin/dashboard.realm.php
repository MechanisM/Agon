<?php 
	require 'theme/header.tpl.php';
?>	
				<div id='main'>	
					<div id='location' class='c2'>
						<div class='col'>
							<h2>Exhibits: Main</h2>
						</div>
						<div class='col right'>
							 <a href="?a=exhibits&amp;q=settings">Settings</a> <a href="#" id="toggle-pform">New</a>		</div>
				
						<div class='cl'><!-- --></div>		
					</div>
					<!-- BODY BEGIN -->
					<div id='tab'>
						<form name='mform' action='?f=edit' method='post' >
							<div id='add-page' class='bg-grey'>
								<div class='c3'>
									<div class='col'>				
										<label>Name <span class='small-txt'>Required</span> </label>
										<input type="text" name="newposttitle" value=""   maxlength='50' />
									</div>
								<div class='col'>
									<label>Section <span class='small-txt'>Required</span> </label>
									<select name='section_id'>
										<option value="3">Resource</option>
										<option value="2">Page</option>
										<option value="1" selected="selected">Post</option>
									</select>
								</div>
								<div class='col'>
									<input type="submit" name="add_page" value="Create"  />
								</div>
								<div class='cl'><!-- --></div>
							</div>
						</div>
					</form>
					</div>
					
					<ul class='sortable'>
						<li class='group'><span class='inplace1' id='s3'>Posts</span><span class='options switchBox' style='color: #000;'>&nbsp;</span></li>
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
							echo '<li class="sortableitem published" id="item2">'.$z[2].'<span class="options" style="color: #000;"><a href="?a=exhibits&amp;q=prv&amp;id=2">Preview</a> <a href="?f=edit&amp;id='.$z[0].'">Edit</a></span></li>';
						}
						?>
					
					</ul>
					<ul class='sortable'>
						<li class='group'><span class='inplace1' id='s2'>Pages</span><span class='options switchBox' style='color: #000;'>&nbsp;</span></li>
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
							echo '<li class="sortableitem published" id="item2">'.$z[1].'<span class="options" style="color: #000;"><a href="?a=exhibits&amp;q=prv&amp;id=2">Preview</a> <a href="?f=edit&amp;q='.$z[0].'">Edit</a></span></li>';
						}
						?>
					</ul>
					
					<ul class='sortable'>
						<li class='group'><span class='inplace1' id='s1'>Latest Comments</span><span class='options switchBox' style='color: #000;'>&nbsp;</span></li>
						<li class='sortableitem published' id='item2'>About this site<span class='options' style='color: #000;'><a href="?a=exhibits&amp;q=prv&amp;id=2">Preview</a> <a href="?a=exhibits&amp;q=edit&amp;id=2">Edit</a></span><span class='hidden'>Hidden</span> </li>
						<li class='sortableitem published' id='item1'>Main<span class='options' style='color: #000;'><a href="?a=exhibits&amp;q=prv&amp;id=1">Preview</a> <a href="?a=exhibits&amp;q=edit&amp;id=1">Edit</a></span></li>
					</ul>
				
			<?php 
				require 'theme/footer.tpl.php';
			?>	