<?php
define('PLUGIN_LS3_ANCHOR_PREFIX', '#content_1_');
define('PLUGIN_LS3_ANCHOR_ORIGIN', 0);
define('PLUGIN_LS3_LIST_COMPACT', FALSE);

//-----------------------------------------------------------------------------

function plugin_ls3_action()
{
	global $vars, $_ls3_msg_title;

	$params = array();
	foreach (array('title', 'include', 'reverse', 'tree') as $key)
		$params[$key] = isset($vars[$key]);

	$prefix = isset($vars['prefix']) ? $vars['prefix'] : '';
	$body = plugin_ls3_show_lists($prefix, $params);

	return array('body'=>$body,
		'msg'=>str_replace('$1', htmlspecialchars($prefix), $_ls3_msg_title));
}

//-----------------------------------------------------------------------------

function plugin_ls3_convert()
{
	global $script, $vars, $_ls3_msg_title;

	$params = array(
		'link'    => FALSE,
		'title'   => FALSE,
		'include' => FALSE,
		'tree'    => FALSE,	// Added for 'tree' option //
		'reverse' => FALSE,
		'compact' => PLUGIN_LS3_LIST_COMPACT,
		'_args'   => array(),
		'_done'   => FALSE
	);

	$args = array();
	$prefix = '';
	if (func_num_args()) {
		$args   = func_get_args();
		$prefix = array_shift($args);
	}
	if ($prefix == '') $prefix = strip_bracket($vars['page']) . '/';

	array_walk($args, 'plugin_ls3_check_arg', & $params);

	$title = (! empty($params['_args'])) ? join(',', $params['_args']) :   // Manual
		str_replace('$1', htmlspecialchars($prefix), $_ls3_msg_title); // Auto

	if (! $params['link'])
		return plugin_ls3_show_lists($prefix, $params);

	$tmp = array();
	$tmp[] = 'plugin=ls3&amp;prefix=' . rawurlencode($prefix);
	if (isset($params['title']))   $tmp[] = 'title=1';
	if (isset($params['include'])) $tmp[] = 'include=1';

	return '<p><a href="' . $script . '?' . join('&amp;', $tmp) . '">' .
		$title . '</a></p>' . "\n";
}

//-----------------------------------------------------------------------------

function plugin_ls3_show_lists($prefix, & $params)
{
	global $_ls3_err_nopages;

	$pages = array();
    $pages_assoc = array(); //yam

	if ($prefix != '') {
		foreach (get_existpages() as $_page) {
            $path_components = split("/", $_page);
            $parent_page = "";

			if (strpos($_page, $prefix) === 0) {
                foreach ($path_components as $path_compo) {
                    if (empty($parent_page))
                        $parent_page = $path_compo;
                    else
                        $parent_page = $parent_page . "/" . $path_compo;

                    if (strlen($parent_page) < strlen($prefix))
                        continue;

                    if (!array_key_exists($parent_page, $pages_assoc) && !array_key_exists($parent_page . "/", $pages_assoc)) {
                        $pages[] = $parent_page;
                        $pages_assoc[$parent_page] = 1;
                        $pages_assoc[$parent_page . "/"] = 1;
                    }
                }
            }
        }
	} else {
		foreach (get_existpages() as $_page) {
            $path_components = split("/", $_page);
            $parent_page = "";

            foreach ($path_components as $path_compo) {
                if (empty($parent_page))
                    $parent_page = $path_compo;
                else
                    $parent_page = $parent_page . "/" . $path_compo;

                if (! array_key_exists($parent_page, $pages_assoc)) {
                    $pages[] = $parent_page;
                    $pages_assoc[$parent_page] = 1;
                }
            }
        }
	}

	natcasesort($pages);
	if ($params['reverse']) $pages = array_reverse($pages);

	foreach ($pages as $page) $params["page_$page"] = 0;

	if (empty($pages)) {
		return str_replace('$1', htmlspecialchars($prefix), $_ls3_err_nopages);
	} else {
		$params['result'] = $params['saved'] = array();
		foreach ($pages as $page)
			plugin_ls3_get_headings($page, $prefix, $params, 1);
		return join("\n", $params['result']) . join("\n", $params['saved']);
	}
}

//-----------------------------------------------------------------------------

function plugin_ls3_get_headings($page, $prefix, & $params, $level, $include = FALSE)
{
	global $script;
	static $_ls3_anchor = 0;

	$is_done = (isset($params["page_$page"]) && $params["page_$page"] > 0);
	if (! $is_done) $params["page_$page"] = ++$_ls3_anchor;

	$r_page = rawurlencode($page);
	$s_page = htmlspecialchars($page);
	$title  = $s_page . ' ' . get_pg_passage($page, FALSE);

	//------------------------------------------------------------//
	// for 'tree' option                                          //
	//                                                            //
	// add '$prefix' as a parameter to plugin_ls3_get_headings    //
	//                                                            //
	if ($params['tree'])
	{
		if($prefix != '' and strpos($s_page,$prefix)===0)
			$s_page = substr($s_page,strlen($prefix));
		while(strstr($s_page,'/'))
		{
			$s_page = substr($s_page,strpos($s_page,'/')+1);
			$level++;
		}
	}
	//                                                            //
	//------------------------------------------------------------//

	$href   = $script . '?cmd=read&amp;page=' . $r_page;

	plugin_ls3_list_push($params, $level);
	$ret = $include ? '<li>include ' : '<li>';

	if ($params['title'] && $is_done) {
		$ret .= '<a href="' . $href . '" title="' . $title . '">' . $s_page . '</a> ';
		$ret .= '<a href="#list_' . $params["page_$page"] . '"><sup>&uarr;</sup></a>';
		array_push($params['result'], $ret);
		return;
	}

	$ret .= '<a id="list_' . $params["page_$page"] . '" href="' . $href .
		'" title="' . $title . '">' . $s_page . '</a>';
	array_push($params['result'], $ret);

	$anchor = PLUGIN_LS3_ANCHOR_ORIGIN;
	$matches = array();
	foreach (get_source($page) as $line) {
		if ($params['title'] && preg_match('/^(\*{1,3})/', $line, $matches)) {
			$id    = make_heading($line);
			$level = strlen($matches[1]);
			$id    = PLUGIN_LS3_ANCHOR_PREFIX . $anchor++;
			plugin_ls3_list_push($params, $level + strlen($level));
			array_push($params['result'],
				'<li><a href="' . $href . $id . '">' . $line . '</a>');
		} else if ($params['include'] &&
			preg_match('/^#include\((.+)\)/', $line, $matches) &&
			is_page($matches[1]))
		{
			plugin_ls3_get_headings($matches[1], $prefix, $params, $level + 1, TRUE);
		}
	}
}

//-----------------------------------------------------------------------------
//リスト構造を構築する
function plugin_ls3_list_push(& $params, $level)
{
	global $_ul_left_margin, $_ul_margin, $_list_pad_str;

	$result = & $params['result'];
	$saved  = & $params['saved'];
	$cont   = TRUE;
	$open   = '<ul%s>';
	$close  = '</li></ul>';

	while (count($saved) > $level || (! empty($saved) && $saved[0] != $close))
		array_push($result, array_shift($saved));

	$margin = $level - count($saved);

	// count($saved)を増やす
	while (count($saved) < ($level - 1)) array_unshift($saved, '');

	if (count($saved) < $level) {
		$cont = FALSE;
		array_unshift($saved, $close);

		$left = ($level == $margin) ? $_ul_left_margin : 0;
		if ($params['compact']) {
			$left  += $_ul_margin;   // マージンを固定
			$level -= ($margin - 1); // レベルを修正
		} else {
			$left += $margin * $_ul_margin;
		}
		//$str = sprintf($_list_pad_str, $level, $left, $left);
		//array_push($result, sprintf($open, $str));
        array_push($result, ($level < 2) ? '<ul class="toggle-tree-closed">' : '<ul>');
	}

	if ($cont) array_push($result, '</li>');
}

//-----------------------------------------------------------------------------
// オプションを解析する
function plugin_ls3_check_arg($value, $key, & $params)
{
	if ($value == '') {
		$params['_done'] = TRUE;
		return;
	}

	if (! $params['_done']) {
		foreach (array_keys($params) as $param) {
			if (strtolower($value)  == $param &&
			    preg_match('/^[a-z]/', $param)) {
				$params[$param] = TRUE;
				return;
			}
		}
		$params['_done'] = TRUE;
	}

	$params['_args'][] = htmlspecialchars($value); // Link title
}
?>
