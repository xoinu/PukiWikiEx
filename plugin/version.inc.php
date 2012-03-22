<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: version.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// Show PukiWiki version

function plugin_version_convert()
{
	if (PKWK_SAFE_MODE) return ''; // Show nothing

	return '<p>' . S_VERSION . '</p>';
}

function plugin_version_inline()
{
	if (PKWK_SAFE_MODE) return ''; // Show nothing

	return S_VERSION;
}
?>
