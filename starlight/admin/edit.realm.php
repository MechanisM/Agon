<?php 
	require 'theme/header.tpl.php';
	
	// We are editing a new page
	if(isset($_POST['title'])) {
		if($_POST['section_id'] == '1') {
			$y = $redis->keys("slight.post.*");
				$max = explode(".", $y[(count($y) - 1)]);
				$id = ($max[2]) + 1;
			
			$redis->rpush("slight.post.".$id,$id);	
			$slug = strtolower(str_replace(' ', '-', $_POST['title']));
			$redis->set("slight.slug.".$slug, $id);	# Set the slug, so we can access it
			$redis->set("slight.slug.".$id, $slug); # We can access the post via id or slug
			$redis->rpush("slight.post.".$id, $slug);
			$redis->rpush("slight.post.".$id, strip_tags(trim($_POST['title']))); # Set the title in the 3rd place
			$redis->rpush("slight.post.".$id, null); # We add the time when the post is saved
			$redis->rpush("slight.post.".$id, "Admin"); # TODO Make it add the actual username
			$redis->rpush("slight.post.".$id, null); # Make the body null
	
			$redis->rpush("slight.post.".$id, null); # Comments enabled?
			$redis->rpush("slight.post.".$id, null); # Time (in weeks) to disable comments after
			$redis->rpush("slight.post.".$id, null); # Markup language
			$redis->rpush("slight.post.".$id, false); # Is the post live?
			$title = $_POST['title'];
			$id = $_POST['id'];
		} else if($_POST['section_id'] == '2') {
			$slug = strtolower(str_replace(' ', '-', $_POST['title']));
			$id = $slug;
			$redis->rpush("slight.page.".$slug, $slug);	
			$redis->rpush("slight.page.".$slug, strip_tags(trim($_POST['title']))); # Set the title
			$redis->rpush("slight.page.".$slug, null); # Set the body
			$redis->rpush("slight.page.".$slug, null); # Markup language
			$redis->rpush("slight.page.".$slug, false); # Page is live
		}
	} else if(isset($_POST['edit'])) {
		$id = $_POST['edit'];
		if(is_int($id) and $redis->exists("slight.post.".$id)) { # We have an id. 
			if(trim($_POST['content']) == '') {
				die("You need to enter some content. ".trim($_POST['content']));
			}
	
			$redis->lset("slight.post.".$id, 3, time());
			$redis->lset("slight.post.".$id, 5, $_POST['content']);
			if($_POST['comments'] == 'true') {
				$redis->lset("slight.post.".$id, 6, true);
				$redis->lset("slight.post.".$id, 7, $_POST['distime']);
			} else {
				$redis->lset("slight.post.".$id, 6, false);
				$redis->lset("slight.post.".$id, 7, 0);
			}
			
			$redis->lset("slight.post.".$id, 8, $_POST['marklang']);
			$redis->lset("slight.post.".$id, 9, $_POST['publish']);
			header("Location: ?f=edit&id=".$id);	
		} else if ($redis->exists("slight.page.".$id)) {
			$redis->lset("slight.post.".$id, 3, $_POST['content']);
			$redis->lset("slight.post.".$id, 4, $_POST['marklang']);
			$redis->lset("slight.post.".$id, 5, $_POST['publish']);
			header("Location: ?f=edit&id=".$id);
		}
	} else if($_GET['id']) {
		$id = $_GET['id'];
		if(is_int($id) and $redis->exists("slight.post.".$id)) {
			$title = $redis->lindex('slight.post.'.$id,2);
			$body = $redis->lindex('slight.post.'.$id,5);
		} else if($redis->exists("slight.page.".$id)) {
			$title = $redis->lindex('slight.page.'.$id,2);
			$body = $redis->lindex('slight.page.'.$id,3);
		}
	} else {
		die("You need. ".var_dump($_POST));
	}
	?>
				<div id='main'>
					<div id='location' class='c2'>
						<div class='col'>
							<h2>Page: Edit</h2>
						</div>
						<div class='col right'>
							 <a href="?a=exhibits">Main</a>
						</div>
				
						<div class='cl'><!-- --></div>		
					</div>
				
					<!-- BODY BEGIN -->
					<form name='mform' action='' method='post' >
						<input type="hidden" value='<?php echo $id; ?>' name='edit' />
						<div id='tab'>
							<div class='c5'>
								<div class='colA'>
									<div class='bg-grey'>
										<div>
											<div class='col'>
												<h3><span class='sec-title'>Posts</span> <span class='inplace1'><?php echo $title; ?></span></h3>
											</div>
											<div class='col txt-right'>
												<p id='ajaxhold'>&nbsp;</p>
											</div>
											<div class='cl'><!-- --></div>
										</div>
										<div class='col' style='margin-top:18px;'>
											<a href="#" title='Bold' class='btn btn-off' onClick="edInsertTag(edCanvas, 0);return false;" width='20'><img src='admin/theme/img/bold.gif' alt'[]' id='ed_bold'  /></a><a href="#" title='Italic' class='btn btn-off' onmouseover="this.className='btn btn-over'" onmouseout="this.className='btn btn-off'" onClick="edInsertTag(edCanvas, 1);return false;"><img src='admin/theme/img/italic.gif' alt'[]' id='ed_italic'  /></a><a href="#" title='Underline' class='btn btn-off' onmouseover="this.className='btn btn-over'" onmouseout="this.className='btn btn-off'" onClick="edInsertTag(edCanvas, 3);return false;"><img src='admin/theme/img/under.gif' alt'[]' id='ed_under' /></a><img src="admin/theme/img/line_spcr.gif" border="0">
											<a href="#" title='Links Manager' class='btn btn-off' onClick="OpenWindow('?a=system&amp;q=links','popup','325','350','yes');return false;"><img src='admin/theme/img/link.gif' alt'[]' /></a></div>
											<div class='col txt-right' style='margin-top:18px;'>
<!--											&nbsp;<input name='preview' type='image' src='admin/theme/img/f-prev.gif' title='Preview (without saving)' class='btn btn-off' onmouseover="this.className='btn btn-over'" onmouseout="this.className='btn btn-off'" style='margin-bottom:0;' onclick="previewText(3); return false;" />
-->												<a href="?f=edit&del=<?php echo $id; ?>" title='Delete' class='btn btn-off' onClick="javascript:return confirm('Are you sure?');"><img src='admin/theme/img/delete.gif' alt'[]' /></a>
												<input name='save' type='image' src='admin/theme/img/save.gif' title='Save/Preview'  class='btn btn-off' onmouseover="this.className='btn btn-over'" onmouseout="this.className='btn btn-off'" style='margin-bottom:0;' onclick="updateText(3); return false;" />
											</div>
											<div class='cl'><!-- --></div>

<textarea name='content' class='content' id='jxcontent' style='width:625px;'>
<?php if(isset($body)) echo $body; ?>
</textarea>
											<div class='cl'><!-- --></div>
										</div>
										<div id='img-container'>
											<ul id='boxes'>
												<li>No Images</li>
											</ul>
											<div class='cl'><!-- --></div>
										</div>
									</div>
								</div>
								<div class='colB'>
									<div class='colB-set'>
										<div class='colB-pad'>
											<label>Publish</label><br />
												<ul class='listed' id='p-status'>
													<li id='p-on'>On</li>
													<li class='active' title='0' id='p-off'>Off</li>
												</ul>
												<input name="publish" id='p-form' value='false' type='hidden' />
												
												<label>Comments</label><br />
												<ul class='listed' id='c-status'>
													<li class='active' id='c-on'>On</li>
													<li title='0' id='c-off'>Off</li>
												</ul>
												<input name="comments" id='c-form' value='true' type='hidden' />
												
												<label id='c-label'>Disable Comments after</label>
												<select id='c-select' name='distime'>
													<option value="6" selected="selected" >6 Weeks</option>
													<option value="5">5 Weeks</option>
													<option value="4">4 Weeks</option>
													<option value="3">3 Weeks</option>
													<option value="2">2 Weeks</option>
													<option value="1">1 Week</option>
												</select>
												<input name="publish" id='p-form' value='false' type='hidden' />
												<div style='margin: 3px 0 5px 0;' ">
													<label style='cursor:pointer;' id="toggle-asettings">Additional Settings</label>
													<div id='adt-options' style='padding-top:12px;'>			
														<label>Markup Language</label>
														<select name='marklang'>
															<option value="textile" selected="selected" >Textile</option>
															<option value="none" >Raw HTML</option>
														</select>
													</div>
												</div>
											</div>
									</div>
							</div>
							<div class='cl'><!-- --></div>
						</div>
	</form>
	
	<!-- BODY END -->

	<div class='cl'><!-- --></div>

</div>

	<div id='footer' class='c2'>
		<div class='col'>&copy; 2008</div>

		<div class='col right'><a href='http://www.indexhibit.org/'>Indexhibit<small><sup>TM</sup></small> v0.70d</a></div>
		<div class='cl'><!-- --></div>
	</div>
	
</div>

</body>
</html>