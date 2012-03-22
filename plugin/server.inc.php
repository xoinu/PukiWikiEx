<?php
// $Id: server.inc.php,v 1.1 2012/03/19 18:21:25 yamazaki Exp $
//
// Server information plugin
// by Reimy http://pukiwiki.reimy.com/

function plugin_server_convert()
{

	if (PKWK_SAFE_MODE) return ''; // Show nothing

	return '<dl>' . "\n" .
		'<dt>Server Name</dt>'     . '<dd>' . SERVER_NAME . '</dd>' . "\n" .
		'<dt>Server Software</dt>' . '<dd>' . SERVER_SOFTWARE . '</dd>' . "\n" .
		'<dt>Server Admin</dt>'    . '<dd>' .
			'<a href="mailto:' . SERVER_ADMIN . '">' .
			SERVER_ADMIN . '</a></dd>' . "\n" .
		'</dl>' . "\n";
}
?>
