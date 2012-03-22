<?php
// PukiWiki - Yet another WikiWikiWeb clone.
// $Id: filelist.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// Filelist plugin: redirect to list plugin
// cmd=filelist

function plugin_filelist_action()
{
	return do_plugin_action('list');
}
?>
