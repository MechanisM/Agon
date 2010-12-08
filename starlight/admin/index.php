<?php
	require '../../config.php';
	require 'adminFunctions.php';
	
	if(isset($_GET['do']) and $_GET['do'] == 'process') {
		adminDoProcess();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Steal My Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>

		<h1 id="head">Starlight .0.0.1</h1>
		
		<ul id="navigation">
			<li><span class="active">Overview</span></li>
			<li><a href="?do=new-post">New Post</a></li>
			<li><a href="?do=new-page">New Page</a></li>
			<li><a href="?do=manage">Manage</a></li>
			<li><a href="?do=settings">Settings</a></li>
		</ul>
		
			<div id="content" class="container_16 clearfix">
			<?php
				if(isset($_GET['do']) and $_GET['do'] == 'new-post'):
			?>
				<div id="content" class="container_16 clearfix">
					<form method="post" action="?do=process">
						<div class="grid_16">
							<h2>Submit New Post</h2>
 						</div>		
						<div class="grid_5">
							<p>
								<label for="title">Title <small>Must contain alpha-numeric characters.</small></label>
								<input type="text" name="title" />
							</p>
						</div>
						<div class="grid_5">
							<p>
								<label for="title">Slug <small>Must contain alpha-numeric characters.</small></label>
								<input type="text" name="slug" />
							</p>							
						</div>
						<div class="grid_6">
							<p>
								<label for="title">Category</label>
								<select name="status">
									<option value="false">Draft</option>
									<option value="true">Published</option>
								</select>
							</p>
						</div>

						<div class="grid_16">
							<p>
								<label>Article <small>Use Textile Syntax.</small></label>
								<textarea class="big" name="body"></textarea>
							</p>
							<p class="submit">
								<imput type="hidden" value="new-post" name="method" />
								<input type="reset" value="Reset" />
								<input type="submit" value="Post" />
							</p>
						</div>
					</form>
					
				</div>
			<?php
				else:
			?>
				<div class="grid_5">
					<div class="box">
						<h2>Mathew</h2>
						<div class="utils">
							<a href="#">View More</a>
						</div>
						<p><strong>Last Signed In : </strong> Wed 11 Nov, 7:31<br /><strong>IP Address : </strong> 192.168.1.101</p>
					</div>
					<div class="box">
						<h2>CMS Updates</h2>
						<div class="utils">
							<a href="#">Check</a>
						</div>
						<p class="center">You are running the latest version.</p>
					</div>
				</div>
				<div class="grid_6">
					<div class="box">
						<h2>Quick Post</h2>
						<div class="utils">
							<a href="#">Advanced</a>
						</div>
						<form action="#" method="post">
							<p>
								<label for="title">Title <small>Alpha-numeric characters only.</small> </label>
								<input type="text" name="title" />
							</p>
							<p>
								<label for="post">Post <small>Parsed by Markdown.</small> </label>
								<textarea name="post"></textarea>
							</p>
							<p>
								<input type="submit" value="post" />
							</p>
						</form>
					</div>
				</div>
				<div class="grid_5">
					<div class="box">
						<h2>Statistics</h2>
						<div class="utils">
							<a href="#">View More</a>
						</div>
						<table>
							<tbody>
								<tr>
									<td>News</td>
									<td>+ 120%</td>
								</tr>
								<tr>
									<td>Downloads</td>
									<td>+ 220%</td>
								</tr>
								<tr>
									<td>Users</td>
									<td>- 10%</td>
								</tr>
							</tbody>
						</table>
					</div>
				<?php
					endif;
				?>
				</div>
			</div>
		<div id="foot">
			<div class="container_16 clearfix">
				<div class="grid_16">
					<a href="#">Contact Me</a>
				</div>
			</div>
		</div>
	</body>
</html>