<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
		<head profile="http://gmpg.org/xfn/11">
			<title>The Thematic Theme Framework | <?php echo _c("slight.config.name"); ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="description" content="Just another WordPress weblog" />
			<link rel="stylesheet" type="text/css" href="http://themeshaper.com/demo/thematic/wp-content/themes/thematic/style.css" />
		</head>
		<body class="">
			<div id="wrapper" class="hfeed">
				<div id="header">
					<div id="branding">
						<div id="blog-title"><span><a href="http://themeshaper.com/demo/thematic/" title="<?php echo _c("slight.config.name"); ?>" rel="home"><?php echo _c("slight.config.name"); ?></a></span></div>
							<h1 id="blog-description"><?php echo _c("slight.config.desc"); ?></h1>
						</div><!--  #branding -->
				    	<div id="access">
			            <div class="menu">
			            	<ul class="sf-menu">
			            		<li class="page_item page-item-24"><a href="http://themeshaper.com/demo/thematic/?page_id=24" title="About">About</a>
			            		<ul>
			            			<li class="page_item page-item-25"><a href="http://themeshaper.com/demo/thematic/?page_id=25" title="Archives">Archives</a></li>
			            			<li class="page_item page-item-26"><a href="http://themeshaper.com/demo/thematic/?page_id=26" title="Links">Links</a></li>
								</ul>
								</li>
							</ul>
						</div>
		        	</div><!-- #access -->
		        </div><!-- #header-->
				<div id="main"> 
					<div id="container">
						<div id="content">
							<div id="nav-above" class="navigation">
								<?php if(@$navBACK): ?>
								<div class="nav-previous">
									<a href="" ><span class="meta-nav">&laquo;</span> Older posts</a>
								</div>
								<?php endif; ?>
								<?php if(@$navNEXT): ?>
								<div class="nav-next">
									<a href="" ><span class="meta-nav">&laquo;</span> Older posts</a>
								</div>
								<?php endif; ?>
							</div>	