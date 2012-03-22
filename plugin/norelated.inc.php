<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: norelated.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// norelated plugin
// - Stop showing related link automatically if $related_link = 1

function plugin_norelated_convert()
{
	global $related_link;
	$related_link = 0;
	return '';
}
?>
