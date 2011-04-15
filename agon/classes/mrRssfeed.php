<?php
echo '<?xml version="1.0" encoding="utf-8"?>
	<rss version="2.0">
		<channel>
			<title>'._c("slight.config.name").'\'s RSS Feed</title>
			<link>http://www.example.com/</link>
			<description>This is my rss 2 feed description</description>
			<lastBuildDate>Mon, 12 Sep 2005 18:37:00 GMT</lastBuildDate>
			<language>en-us</language>';
	
foreach($posts[0] as $a) {
	$info = meta2obj($a);
	echo '<item>
		<title>'.$info->title.'</title>
		<link>http://example.com/item/123</link>
		<guid>http://example.com/item/123</guid>
		<pubDate>'.$info->date.'</pubDate>
		<description>[CDATA[ 
			'.truncate($this->body,500,'').' 
		]]</description>
		</item>';
	}

echo '	
			</channel>
		</rss>
	';
?>
