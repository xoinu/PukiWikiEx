<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: clear.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// Clear plugin - inserts a CSS class 'clear', to set 'clear:both'

function plugin_clear_convert()
{
	return '<div class="clear"></div>';
}
?>
