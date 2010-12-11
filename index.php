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

	//index.php file for Starlight. Yo
	if(!file_exists("config.php"))
		die("Starlight has not been installed or the config file is corrupt. Please go <a href='starlight/install/install.php'>Here to start the installer</a>");
	
	require("config.php");
	
	if(isset($_GET['f']))
		$s->addvar($_GET['f']);
	
	$s->start();

?>