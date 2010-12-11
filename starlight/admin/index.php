<?php
# Copyright (c) 2010, Colum McGaley
# All rights reserved.

# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

	session_start();
	
	require '../../config.php';
	require 'adminFunctions.php';
	
	if(isset($_GET['do']) isset($_SESSION['logged']) and $_GET['do'] == 'process') {
		adminDoProcess();
	}
	
	if(!isset($_SESSION['logged'])) {
		adminShowLogin();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Starlight</title>
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
								<label for="slug">Slug <small>Must contain alpha-numeric characters.</small></label>
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
								<input type="hidden" value="new-post" name="method" />
								<input type="reset" value="Reset" />
								<input type="submit" value="Post" />
							</p>
						</div>
					</form>
			<?php
				elseif(isset($_GET['do']) and $_GET['do'] == 'manage'):
			?>
			<div class="grid_16">
				<table>
					<thead>
						<tr>
							<th>Post Name</th>
							<th>Slug</th>
							<th>Date</th>
							<th colspan="2" width="10%">Actions</th>
						</tr>
					</thead>
					<tbody>
<?php
	$posts = $redis->keys('slight.post.*');
	for($i = count($posts); $i >= 0; $i--):
		if(isset($posts[$i])):
			$q = (object) array(
				'id' 	=> _i($posts[$i],0),
				'title' => _i($posts[$i],1), 
				'date' 	=> _i($posts[$i],2), 
				'slug' 	=> gS(_i($posts[$i],0))
			);
?>
	<tr>
		<td><?php echo $q->title; ?></td>
		<td><?php echo $q->slug; ?></td>
		<td><?php echo $q->date; ?></td>
		<td><a href="?do=edit&id=<?php echo $q->id; ?>" class="edit">Edit</a></td>
		<td><a href="?do=del&did=<?php echo $q->id; ?>" class="delete">Delete</a></td>
	</tr>
<?php
		endif;
	endfor;
?>
</tbody>

				</table>
			</div>
			<?php
				# End manage
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