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

	function show_post($num) {
		global $redis, $tpl, $textile;
		
		plugin_trigger_event('post_before_load');

		$id = $redis->get('slight.slug.' . $num);
		$tpl->id = $id;
		$tpl->slug = $num;
		$tpl->title = $redis->lindex('slight.post.' . $id, 2);
		$tpl->date = $redis->lindex(('slight.post.' . $id), 3);
		$tpl->class = $redis->lindex('slight.post.' . $id, 10);

		if ($redis->lindex(('slight.post.' . $id), 8) == '1')
			$tpl->body = $textile->TextileThis($redis->lindex(('slight.post.' . $id), 5));
		else
			$tpl->body = $redis->lindex(('slight.post.' . $id), 5);
		
		plugin_trigger_event('page_before_template');

		$tpl->display("starlight/templates/" . $redis->get('slight.config.template') . "/page.tpl.php");
		
		plugin_trigger_event('post_after_load');
	}

?>
