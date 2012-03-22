<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: tracker_list.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// Issue tracker list plugin (a part of tracker plugin)

require_once(PLUGIN_DIR . 'tracker.inc.php');

function plugin_tracker_list_init()
{
	if (function_exists('plugin_tracker_init'))
		plugin_tracker_init();
}
?>
