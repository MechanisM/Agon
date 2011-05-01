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

	function agon() {
		
		check_db_integrity();
		
		plugin_trigger_event('before_routing_function');
		
		$v = explode("/",(isset($_GET['f']) ? $_GET['f'] : null)); # Here we will seperate page and the number
		switch($v[0]){ # Switchboard for the functions in which we will call localized functions
			case 'page': 
				require _PATH_ . '/functions/agon_page.php';
				show_page($v[1]);
			break;
			case 'post':
				require _PATH_ . '/functions/agon_post.php';
				show_post($v[1]);
			break;
			case 'static': 
				require _PATH_ . '/functions/agon_static_page.php';
				show_static_page($v[1]);
			break;
			case 'comment':
				add_comment($v[1]);
			break;
			case 'rss' :
				$this->makerss();		
			break;
			default :
				require _PATH_ . '/functions/agon_page.php';
				show_page(1);
			break;
        }
		
		plugin_trigger_event('after_routing_function');

	}
?>
