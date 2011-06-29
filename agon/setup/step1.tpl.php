<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>Indexhibit :: Login</title>

			<link rel="stylesheet" type="text/css" href="../admin/theme/css/style.css" />
		</head>
		<body>
			<div id='main'>
				<div id='all'>
					<div>
						<form method='post' action='?'>
							<h1>Agon. Database Info</h1>
							<br />
							<?php
								$fh = fopen("../../config.php", 'w') or echo("<p>Can not open config.php for writing</p>");
								//$sv = fopen("http://api.archangel.io/level-1/agon/verson-check/".codebase_version, "r") or echo("<p>Can not connect to API server</p>");
								//	if($sv) { 
								//		$data = json_decode($sv); 
								//		
								//	}
							?>
							
							<p>Latest Version</p>
							<p><strong>Redis Host:</strong>
								<input name='Host' type='text' maxlength='12' value='127.0.0.1' /></p>
							<p><strong>Database:</strong> (Leave blank for default) 
								<input name='Database' type='text' maxlength='12' /></p>
							<p><strong>Password:</strong> (Leave empty for none)
								<input name='pwd' type='password' maxlength='12' /></p>
							<p><strong>Use PHP-Redis:</strong> (Only if you know Its installed) <br />
								<input type="checkbox" name="sd" id="sd" /></p>
								<input type="hidden" name="step" value="1" />
							<p><input name='submitLogin' type='submit' value='Login' class='login-button' /></p>
						</form>
					</div>
					Safari and Firefox are recommended. 
				</div>	
			</div>
		</body>
	</html>