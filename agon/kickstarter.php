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
	
	define('codebase_version', 'agon-0.5.3-stable');
	define('AGON_DEBUGGING', 3); # 3 = Show all errors, 2 = Show debugging errors, 1 = Show critical Errors only
	
	require_once _PATH_ . "/functions/agon_db_integrity.php";
	require_once _PATH_ . "/functions/agon_error.php";
	require_once _PATH_ . "/functions/agon_plugins.php";
	require_once _PATH_ . "/functions/agon_comments.php";
	require_once _PATH_ . "/functions/agon_theme.php";
	
	require_once _PATH_ . "/functions/start.php";
	require_once _PATH_ . "/classes/predis/Predis.php";	# Database
	require_once _PATH_ . '/classes/Savant3.php';		# Formatting
	require_once _PATH_ . '/classes/classTextile.php';	# Formatting
	
	$redis = new Predis_Client($single_server);			# Start the Redis connection
	$tpl = new Savant3();									
	$textile = new Textile();
?>
