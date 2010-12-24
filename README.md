Introduction
------------
Starlight is a blogging platform that uses Redis as a database

Server Requirements
----------
Php 5.2.6+ (5.3 is recommended)
Redis 2.* (Not tested on 1.3 branch)

Installation
------------
Install Redis from source or from package (apt-get install redis)
Upload files to server directory
Navigate to /starlight/install.php
Make sure you have Redis online, and config.php writeable by the server

Todo
-----
* Add startup database check to prevent Predis Errors
* Add a check to see if site is live or not (access if admin is logged in)
* Comments!
** Add a moderation function (v0.2)

Current Version : v0.0.8