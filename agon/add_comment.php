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
	require_once '../config.php';
        require_once _PATH_ . "/classes/predis/Predis.php";
 	require_once _PATH_ . "/functions/agon_functions.php";        
	require_once _PATH_ . "/functions/agon_error.php";
	require_once _PATH_ . "/functions/agon_plugins.php";
	require_once _PATH_ . "/functions/agon_comments.php";
       
        $redis   = new Predis_Client($single_server);
        
	plugin_trigger_event('before_add_comment');
	
        if(isset($_GET['slug']) and $_GET['slug'])
            add_comment(process_url($_GET['slug']));
        else
	    die("Invalid Access");
