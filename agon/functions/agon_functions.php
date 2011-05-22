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
    /*
    * Function the retreave a setting name
    * @author Colum McGaley <c.mcgaley@gmail.com>
    * @global $redis The Database connection
    * @param string $setting The setting to retreave
    */
    function s( $setting ) {
        global $redis;
        $r = $redis->hget('agon.config', $setting);
        if(!$r)
            echo "Error in retreaving the requested setting ($setting)";
        else
            return $r;
    }
    
    function __( $code ) {
        $lang = _('curr_lang'); # Get the current language
        require_once _PATH_ . '/lang/' . $lang . '.php'; # Include it
        
        if ( !isset($l) ) # Check if we have the $l variable, which is the wrapper
            echo "Malformed Language File. Please reinstall";
        else if ( !isset($l[$code]) ) # Check if we have the code
            echo "Malformed Language File or Malformed Language code. Please reinstall";
        else # Return said code
            return $l[$code];
    }
    
    function process_url( $url ) {
        global $redis;
        $u = $redis->hget('agon.url_layout', $url);
        if(!$u) {
            if( $url == null or $url == "")
                return array('page', 1);
            else
                return false;
        }
        else {
            $j = explode( ':', $u);
            $j[] = $u;
            return $j; # [0] => function (s = static page, p = post) [1] = ID
        }
    }
    function agon(){}
?>