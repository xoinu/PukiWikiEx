<?php
// $Id: bugtrack_list.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// PukiWiki BugTrack-list plugin - A part of BugTrack plugin
//
// Copyright
// 2002-2005 PukiWiki Developers Team
// 2002 Y.MASUI GPL2 http://masui.net/pukiwiki/ masui@masui.net

require_once(PLUGIN_DIR . 'bugtrack.inc.php');

function plugin_bugtrack_list_init()
{
	plugin_bugtrack_init();
}
?>
