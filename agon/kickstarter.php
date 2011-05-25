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
	
	define('codebase_version', 'agon-0.5.5-dev');
	define('AGON_DEBUGGING', 3); # 3 = Show all errors, 2 = Show debugging errors, 1 = Show critical Errors only
	
	require_once _PATH_ . "/classes/predis/Predis.php";	# Database
	require_once _PATH_ . '/classes/Savant3.php';		# Formatting
	require_once _PATH_ . '/classes/classTextile.php';	# Formatting
	
	$redis   = new Predis_Client($single_server);		# Start the Redis connection
	$tpl     = new Savant3();									
	$textile = new Textile();

        //require_once _PATH_ . "/functions/agon_db_integrity.php";
	require_once _PATH_ . "/functions/agon_functions.php";        
	require_once _PATH_ . "/functions/agon_error.php";
	require_once _PATH_ . "/functions/agon_plugins.php";
	require_once _PATH_ . "/functions/agon_comments.php";
	require_once _PATH_ . "/functions/agon_theme.php";
	
        $d = process_url( (isset($_GET['f']) ? $_GET['f'] : null) ); # We query for the URL info. We should get an array
        if(!is_array($d)) # process_function returns false when no page is found
            die("404 ".var_dump($d));
        
        switch($d[0]) {
            case 'page': 
		require _PATH_ . '/functions/agon_page.php';
	    	show_page($d[1]);
	    break;
	    case 'p':
		require _PATH_ . '/functions/agon_post.php';
    		show_post($d[2]);
	    break;
	    case 's': 
                require _PATH_ . '/functions/agon_static_page.php';
        	show_static_page($d[2]);
            break;
	    case 'rss' :
		$this->makerss();		
	    break;
	    default :
		require _PATH_ . '/functions/agon_page.php';
    		show_page(1);
	    break;
        }
        
?>
