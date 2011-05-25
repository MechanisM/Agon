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

	/**
	 * Function to show a single page
	 * @author Colum McGaley <c.mcgaley@gmail.com>
	 * @license GUN Public Licence
	 * @param string $slug
	 * @since starlight-0.0.3-TRUNK
	 */
	function showstatic($slug) {
		global $redis, $textile, $tpl;
		$page = $redis->lrange("slight.page.".$slug,0,4);

		$tpl->id = $page[0];
		$tpl->slug = $slug;
		$tpl->title = $page[1];

		if($page[4] == '1')
			$tpl->body =  $textile->TextileThis($page[2]);
		else
			$tpl->body =  $page[2];

		$tpl->display("starlight/templates/".$redis->get('slight.config.template')."/static.tpl.php");
	}
?>
