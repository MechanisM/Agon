<?php 
	require 'theme/header.tpl.php';
	if($_POST) {
		if(trim($_POST['title']) != "" and $_POST['title'] != _c("slight.config.name"))
			$redis->set("slight.config.name",$_POST['title']);
			
		if(trim($_POST['desc']) != "" and $_POST['desc'] != _c("slight.config.desc"))
			$redis->set("slight.config.desc",$_POST['desc']);
			
		if(trim($_POST['posts_per_page']) and $_POST['posts_per_page'] != _c("slight.config.list"))
			$redis->set('slight.config.list', $_POST['posts_per_page']);
		
		$redis->set("slight.config.list",$_POST['posts_per_page']);
		/*if(trim($_POST['password']) == trim($_POST['cpassword'])) {
			$redis->lindex('slight.config.users',0,$_POST['userid']);
			$redis->lindex('slight.config.users',1,md5($_POST['password']));
		}*/
		echo "
			<h2 id='updated_h2'>Updated</h2>
			<script type='text/javascript'>
				//$('updated_h2').fla();
				//Do some kind of flash then hide above
			</script>
		";
	}
?>
				<div id='main'>	
					<form name='mform' action='' method='post' >
						<div class='c3 bg-grey'>
							<div class='col'>
								<label>Site Title <span class='small-txt'>Required</span> </label>
								<input type="text" name="title" value="<?php echo _c("slight.config.name"); ?>" />
								<label>Site Description </label>
								<input type="text" name="desc" value="<?php echo _c("slight.config.desc"); ?>" />
								<label>Post Per Page <span class='small-txt'>Number of Posts to show per page</span> </label>
								<select name='posts_per_page'>
									<?php for($i = 1;$i<15;$i++) { echo "<option value='$i'";
											if(_c("slight.config.list") == "$i") echo 'selected="selected"';
											echo ">$i</option>\n"; } ?>
									</select>
								<!-- <label>Comment Order <span class='small-txt'>Required 6-12 chars</span> </label>
								<select name='comment_order'>
									<option value="flip" <?php if(_c("slight.config.list") == 'flip') echo 'selected="selected"'; ?>>Newest First</option>
									<option value="dont" <?php if(_c("slight.config.list") == 'dont') echo 'selected="selected"'; ?>>Oldest First</option>
								</select>-->
				
								<label>Time Format  </label>
								<select name='user_format'>
									<option value="%d %B %Y"  selected="selected">05 February 2011</option>
									<option value="%A, %H:%M %p" >Saturday, 23:04 PM</option>
									<option value="%Y-%m-%d %T" >2011-02-05 23:04:44</option>
								</select>
                                
								<label>Characters per each post <span class='small-txt'>Leave as 0 for unlimited</span></label>
								<input type="text" name="trim" value="<?php echo _c("slight.config.trim"); ?>" />
                                
								<input type="submit" name="upd_user" value="Update"  />
							</div>
							<div class='col'>
								<label>Login <span class='small-txt'>Required 6-12 chars</span> </label>
								<input type="text" name="userid" value="<?php echo $redis->lindex('slight.config.users',0); ?>"   maxlength='12' />
								<label>Change Password <span class='small-txt'>Required 4-12 chars</span> </label>
								<input type="password" name="password" value=""   maxlength='12' />
								<label>Confirm Password <span class='small-txt'>if changing</span> </label>
								<input type="password" name="cpassword" value=""   maxlength='12' />
								<p>System Status</p>
								<table width="100%" border="0">
								  <tr>
								  	<?php if(!is_writable('../config.php')) { echo '<td style="width:50px; color:green">NO</td>';}
								  	else {echo '<td style="width:50px; color:red">YES</td>';}?>
								    <td>Config Writeable</td>
								  </tr>
								  <tr>
								    <td>&nbsp;</td>
								    <td>&nbsp;</td>
								  </tr>
								</table>
							</div>
							<div class='col'>
								<p>Theme Config</p>
								<label>Current Theme</label>
								<select name='comment_order'>
									<option value="flip" <?php if(_c("slight.config.list") == 'flip') echo 'selected="selected"'; ?>>Newest First</option>
									<option value="dont" <?php if(_c("slight.config.list") == 'dont') echo 'selected="selected"'; ?>>Oldest First</option>
								</select>
								<?php
									if(file_exists('templates/'.$redis->get('slight.config.template').'/settings.php')) {
                                        include 'templates/'.$redis->get('slight.config.template').'/settings.php';
										if($_POST) {
											save_settings();
										} else {
											display_settings();
										}
									}
								?>
							</div>
							<div class='cl'><!-- --></div>
						</div>	
					</form>
<?php 
	require 'theme/footer.tpl.php';
?>