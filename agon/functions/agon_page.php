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

	function show_page($num) {
		global $redis, $tpl;
		
		plugin_trigger_event('page_before_load');

		$post = $redis->keys('slight.post.*');
		$limit = $redis->get("slight.config.list"); # The number to show per page

		$c = count($post);
		for ($i = 0; $i < $c; $i++) {
			if ($redis->lindex($post[$i], 9) == 'false')
				unset($post[$i]);
		}
		if ($limit == 1) {
			$tpl->limits = array(
				0, # Min
				1 # Max
			);
		} else {
			$tpl->limits = array(
				(( $num * $limit ) - $limit), # Min
				(( $num * $limit )) # Max
			);
		}
		$tpl->posts = $post;
		$tpl->nav = array(
			(($num * $limit) < count($post) ? true : false), # Back
			($num > 1 ? true : false) # Next?
		);
		$tpl->display("agon/templates/" . $redis->get('slight.config.template') . "/page.tpl.php");
		
		plugin_trigger_event('page_after_load');
	}

?>
