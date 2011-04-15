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

	function check_plugin_integerity($d) {
		if(is_array($d)) {
			foreach($d as $g) {
				$file = _PATH_ . '/plugins/' . $g .'.plugin.php';
				if(!file_exists($file)) {
					log_error('plugin_not_found',$file,2);
				}
				# TODO Check for valid functions?
				# TODO Check for valid security clearence
			}
		}
	}
	
	function get_activated_plugins() {
		global $redis;
		
		$c = $redis->llength(); # TODO find correct function
		$plugins = $redis->lrange('slight.config.plugins_enabled',0,$c);
		
		if(AGON_DEBUGGING > 2) {
			check_plugin_integerity($plugins); # Will override list if plugin not found
														  # It will thow an error code 2
		}
		
		return $plugins;
	}
	
	function plugin_trigger_event($func){
		
	}

?>
