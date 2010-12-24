<?php 
	require 'theme/header.tpl.php';
?>
		<form action="?" method="post">
			<fieldset>
				<legend>Settings</legend>
				<table class="nostyle">
					<tr>
						<td style="width:70px;">Site Title:</td>
						<td><input type="text" size="40" name="title" class="input-text" value="<?php echo _c("slight.config.name"); ?>" /></td>
					</tr>					<tr>
						<td style="width:70px;">Site Description:</td>
						<td><input type="text" size="40" name="desc" class="input-text" value="<?php echo _c("slight.config.desc"); ?>" /></td>
					</tr>					<tr>
						<td style="width:70px;">Posts per page:</td>
						<td><input type="text" size="40" name="ppp" class="input-text" value="<?php echo _c("slight.config.list"); ?>" /></td>
					</tr>					<tr>
						<td style="width:70px;">Comment Order:</td>
						<td><input type="text" size="40" name="comment-order" class="input-text" value="<?php echo _c("slight.config.comment-list"); ?>" /></td>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input type="submit" class="input-submit" value="Submit" /></td>
					</tr>
					
					
				</table>
			</fieldset>
			<input type="hidden" name="realm" value="settings" />
			<input type="hidden" name="function" value="" />
		</form>
<?php 
	require 'theme/footer.tpl.php';
?>