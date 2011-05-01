<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>Agon - <?php echo codebase_version; ?></title>
			<link type='text/css' rel='stylesheet' href='admin/theme/css/style.css' />
			<script type="text/javascript" src='admin/theme/mootools.js'></script>
			<script type="text/javascript" src='admin/theme/mootools-more.js'></script>
			<script type="text/javascript">
				document.addEvent('domready',function(){
					Element.implement({
						//implement show
				 		show: function() {
							this.setStyle('display','');
						},
						//implement hide
						hide: function() {
							this.setStyle('display','none');
						}
					});
					if($('add-page')) {
						var addpageslide = new Fx.Slide('add-page').hide();
						$('toggle-pform').addEvent('click',function(e){
							addpageslide.toggle();
						});
					}
					if($('toggle-asettings')) { // Edit Page
						var asettingsslide = new Fx.Slide('adt-options').hide();
						$('toggle-asettings').addEvent('click',function() {
							asettingsslide.toggle();
						});

						$('p-on').addEvent('click',function() {
							this.addClass('active');
							$('p-off').removeClass('active');
							$('p-form').value = 'true';
						});
						$('p-off').addEvent('click',function() {
							this.addClass('active');
							$('p-on').removeClass('active');
							$('p-form').value = 'false';
						});

						
						$('c-on').addEvent('click',function() {
							this.addClass('active');
							$('c-off').removeClass('active');
							$('c-select').show();
							$('c-label').show();
							$('c-form').value = 'true';
						});
						$('c-off').addEvent('click',function() {
							this.addClass('active');
							$('c-on').removeClass('active');
							$('c-select').hide();
							$('c-label').hide();
							$('c-form').value = 'false';
						});
					}
				});
			</script>
		</head>
		<body>
			<div id='all'>
				<div id='top'><!-- --></div>
				<div id='header' class='c2'>
					<div class='col'>
						<ul id='nav'>
							<li class='on'><a href="?">Content</a></li>
							<li class='off'><a href="?f=comments">Comments</a></li>
						</ul>
					</div>
					<div class='col right'> 
						<a href="../" class='prefs'><strong>View Your Site</strong></a> <a href="?f=settings" class='prefs'>Preferences</a> <a href="http://projects.archangel.io/starlight/help" class='prefs'>Help</a> <a href="?f=logout" class='prefs'>Logout</a>
					</div>	
					<div class='cl'><!-- --></div>	
				</div>
