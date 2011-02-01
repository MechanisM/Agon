<?php 
	require 'theme/header.tpl.php';
?>
		<form action="?" method="post">
			<fieldset>
				<legend>New Page</legend>
				<table class="nostyle">
					<tr>
						<td style="width:70px;">Title:</td>
						<td><input type="text" size="40" name="title" class="input-text" /></td>
					</tr>
					<tr>
						<td style="width:70px;">Slug:</td>
						<td><input type="text" size="40" name="slug" class="input-text" /></td>
					</tr>
					<tr>
						<td class="va-top">Body:</td>
						<td><textarea cols="100" rows="15" class="input-text" name="body"></textarea></td>
					</tr>
					<tr>
						<td colspan="2" class="t-right"><input type="submit" class="input-submit" value="Submit" /></td>
					</tr>
				</table>
			</fieldset>
			<input type="hidden" name="realm" value="write.page" />
			<input type="hidden" name="function" value="page" />
		</form>
<?php 
	require 'theme/footer.tpl.php';
?>