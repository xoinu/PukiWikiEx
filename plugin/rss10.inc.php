<?php
// RSS 1.0 plugin - had been merged into rss plugin
// $Id: rss10.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $

function plugin_rss10_action()
{
	pkwk_headers_sent();
	header('Status: 301 Moved Permanently');
	header('Location: ' . get_script_uri() . '?cmd=rss&ver=1.0'); // HTTP
	exit;
}
?>
