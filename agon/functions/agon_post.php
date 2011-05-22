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

	function get_post_meta($id) {
		global $redis;
		if($redis->exists('agon.'.$id)) {
			return $redis->hgetall('agon.'.$id);
		} else {
			return false;
		}
	}
	
	function show_post($id) {
		global $tpl, $textile;
		
		plugin_trigger_event('post_before_load');

		$meta = get_post_meta($id);
		if(!$meta)
			die('404, page not found. '.$id);
		
		$tpl->id = $id;
		$tpl->slug = $_GET['f'];
		$tpl->title = $meta['title'];
		$tpl->date = $meta['timestamp'];
		//$tpl->pclass = $meta['class'];

		if (s('markdown') == 'textile')
			$tpl->body = $textile->TextileThis($meta['content']);
		else
			$tpl->body = $meta['content'];
		
		plugin_trigger_event('page_before_template');

		$tpl->display("agon/templates/" . s('template') . "/post.tpl.php");
		
		plugin_trigger_event('post_after_load');
	}

?>
