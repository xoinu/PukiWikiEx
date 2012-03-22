<?php
// $Id: nofollow.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
// Copyright (C) 2005 PukiWiki Developers Team
// License: The same as PukiWiki
//
// NoFollow plugin

// Output contents with "nofollow,noindex" option
function plugin_nofollow_convert()
{
	global $vars, $nofollow;

	$page = isset($vars['page']) ? $vars['page'] : '';

	if(is_freeze($page)) $nofollow = 1;

	return '';
}
?>
