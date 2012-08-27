<?php
// PukiWiki - Yet another WikiWikiWeb clone.
// $Id: pukiwiki.skin.php,v 1.3 2012/03/20 17:34:32 yamazaki Exp $
// Copyright (C)
//   2002-2005 PukiWiki Developers Team
//   2001-2002 Originally written by yu-ji
// License: GPL v2 or (at your option) any later version
//
// PukiWiki default skin

// ------------------------------------------------------------
// Settings (define before here, if you want)

// Set site logo
//$_IMAGE['skin']['logo']     = 'pukiwiki.png';
//$_IMAGE['skin']['logo']     = 'xoinu.jpg';
// define( 'LOGO_WIDTH', 72 );
// define( 'LOGO_HEIGHT', 72 );

$_IMAGE['skin']['logo']     = 'yamwiki.png';
//define( 'LOGO_WIDTH', 205 );
//define( 'LOGO_HEIGHT', 48 );
define( 'LOGO_WIDTH', 200 );
define( 'LOGO_HEIGHT', 80 );

// SKIN_DEFAULT_DISABLE_TOPICPATH
//   1 = Show reload URL
//   0 = Show topicpath
if (! defined('SKIN_DEFAULT_DISABLE_TOPICPATH'))
    define('SKIN_DEFAULT_DISABLE_TOPICPATH', 1); // 1, 0

// Show / Hide navigation bar UI at your choice
// NOTE: This is not stop their functionalities!
if (! defined('PKWK_SKIN_SHOW_NAVBAR'))
    define('PKWK_SKIN_SHOW_NAVBAR', 1); // 1, 0

// Show / Hide toolbar UI at your choice
// NOTE: This is not stop their functionalities!
if (! defined('PKWK_SKIN_SHOW_TOOLBAR'))
    define('PKWK_SKIN_SHOW_TOOLBAR', 0); // 1, 0

// ------------------------------------------------------------
// Code start

// Prohibit direct access
if (! defined('UI_LANG')) die('UI_LANG is not set');
if (! isset($_LANG)) die('$_LANG is not set');
if (! defined('PKWK_READONLY')) die('PKWK_READONLY is not set');

$lang  = & $_LANG['skin'];
$link  = & $_LINK;
$image = & $_IMAGE['skin'];
$rw    = ! PKWK_READONLY;

// Decide charset for CSS
$css_charset = 'iso-8859-1';
switch(UI_LANG){
case 'ja': $css_charset = 'Shift_JIS'; break;
}

// ------------------------------------------------------------
// Output

// HTTP headers
pkwk_common_headers();
header('Cache-control: no-cache');
header('Pragma: no-cache');
header('Content-Type: text/html; charset=' . CONTENT_CHARSET);

// HTML DTD, <html>, and receive content-type
if (isset($pkwk_dtd)) {
    $meta_content_type = pkwk_output_dtd($pkwk_dtd);
} else {
    $meta_content_type = pkwk_output_dtd();
}

// Make a backlink. searching-link of the page name, by the page name, for the page name
function make_path_link($page)
{
	global $script;

	$s_page = htmlspecialchars($page);
	$r_page = rawurlencode($page);
    $pages = explode("/", $s_page);
    $page_name = "";
    $page_name_r = "";
	$link = '';


    if (count($pages) > 1) {
        $link = $link . '<ul class="breadcrumbs">';
        $page_name = array_shift($pages);
        $page_name_r = $page_name;
        $link = $link . '<li><a href="' . $script . '?' . $page_name_r . '">' . $page_name . '</a></li>';

        while (count($pages) > 0) {
            $page_name = array_shift($pages);
            $page_name_r = $page_name_r . rawurlencode('/') . $page_name;
            $link = $link . '<li><a href="' . $script . '?' . $page_name_r . '">' . $page_name . '</a></li>';
        }
        //$page_name = array_shift($pages);
        //$link = $link . '<li><a href="' . $script . '?plugin=related&amp;page=' . $r_page . '">' . $page_name . '</a></li>';
        $link = $link . '</ul>';
        echo $link;
    }
}
?>
<head>
<?php echo $meta_content_type ?>
<meta http-equiv="content-style-type" content="text/css" />
<?php if ($nofollow || ! $is_read)  { ?> <meta name="robots" content="NOINDEX,NOFOLLOW" /><?php } ?>
<?php if (PKWK_ALLOW_JAVASCRIPT && isset($javascript)) { ?>
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<?php } ?>

 <title><?php echo $title ?> - <?php echo $page_title ?></title>

<link rel="stylesheet" type="text/css" href="skin/kickstart/css/kickstart.css" media="all" /> <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" media="screen" href="skin/pukiwiki.css.php?charset=<?php echo $css_charset ?>" charset="<?php echo $css_charset ?>" />
<link rel="stylesheet" type="text/css" media="print"  href="skin/pukiwiki.css.php?charset=<?php echo $css_charset ?>&amp;media=print" charset="<?php echo $css_charset ?>" />
<link rel="stylesheet" type="text/css" href="skin/kickstart/style.css" media="all" />         <!-- CUSTOM STYLES -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $link['rss'] ?>" /><?php // RSS auto-discovery ?>
<?php echo $head_tag ?>
</head>
<body>

<a id="navigator"></a>
<a id="top-of-page"></a>
<div id="wrap" class="clearfix">
<?php if(PKWK_SKIN_SHOW_NAVBAR) { ?>
 <ul class="menu">
  <li><a href="#toggle" id="toggle-menubar">&laquo;</a></li>
<?php
  function _navigator($key, $value = '', $javascript = '', $icon = ''){
      $lang = & $GLOBALS['_LANG']['skin'];
      $link = & $GLOBALS['_LINK'];
      if (! isset($lang[$key])) { echo 'LANG NOT FOUND'; return FALSE; }
      if (! isset($link[$key])) { echo 'LINK NOT FOUND'; return FALSE; }
      if (! PKWK_ALLOW_JAVASCRIPT) $javascript = '';

      echo '<a href="' . $link[$key] . '" ' . $javascript . '>';
      if ($icon != '') {
          echo '<span class="icon" data-icon="' . $icon . '"></span>';
      }
      echo (($value === '') ? $lang[$key] : $value);
      echo '</a>';

      return TRUE;
                                                     }
?>
<li><?php _navigator('top', '', '', 'I') ?></li>
<?php if ($rw) { ?>
<li><?php _navigator('edit', '', '', '7') ?></li>
<?php   if ((bool)ini_get('file_uploads')) { ?>
<li><?php _navigator('upload', '', '', ')') ?></li>
<?php   } ?>
<?php } ?>
<?php if ($is_page) { ?>
<li><a href="">More...</a>
 <ul>
<?php if ($rw) { ?>
                 <li><?php _navigator('new', '', '', '+') ?></li>
                 <li><?php _navigator('rename', '', '', '.') ?></li>
<?php if ($is_read && $function_freeze) { ?>
                                          <li><?php (! $is_freeze) ? _navigator('freeze') : _navigator('unfreeze') ?></li>
<?php } ?>
<?php } ?>
     <li><?php _navigator('diff') ?></li>
<?php if ($do_backup) { ?>
     <li><?php _navigator('backup') ?></li>
<?php } ?>
     <!--li><?php _navigator('reload') ?></li-->
<?php } ?>
     <li><?php _navigator('list') ?></li>
<?php if (arg_check('list')) { ?>
          <li><?php _navigator('filelist') ?></li>
<?php } ?>
<li><?php _navigator('search') ?></li>
<li><?php _navigator('recent') ?></li>
<li><?php _navigator('help')   ?></li>
<?php if ($trackback) { ?>
<li><?php _navigator('trackback', $lang['trackback'] . '(' . tb_count($_page) . ')',
                     ($trackback_javascript == 1) ? 'onclick="OpenTrackback(this.href); return false"' : '') ?></li>
<?php } ?>
<?php if ($referer)   { ?>
<li><?php _navigator('refer') ?></li>
<?php } ?>
</ul>
</li>
<?php }
?>
</ul>
<?php if (arg_check('read') && exist_plugin_convert('menu')) { ?>
<?php if ($is_page) { ?>
<div class="col_4" id="menubar"><div class="menubar well"><?php echo do_plugin_convert('menu') ?></div></div>
 <div class="col_8" id="contents">
<?php } else { ?>
<div class="col_12" id="contents">
<?php } ?>
<?php make_path_link($title) ?>
<h1 class="title"><?php echo $page ?></h1>
 <!--
<?php if ($is_page) { ?>
<?php if(SKIN_DEFAULT_DISABLE_TOPICPATH) { ?>
                                           <a href="<?php echo $link['reload'] ?>"><span class="small"><?php echo $link['reload'] ?></span></a>
<?php } else { ?>
      <span class="small"><?php require_once(PLUGIN_DIR . 'topicpath.inc.php'); echo plugin_topicpath_inline(); ?></span>
<?php } ?>
<?php } ?>
-->
<?php echo $body ?></div>
<?php } else { ?>
<div class="col_12"><?php echo $body ?></div>
<?php } ?>

<div class="col_12">

<?php if ($notes != '') { ?><div id="note"><?php echo $notes ?></div><?php } ?>
<?php if ($attaches != '') { ?><div id="attach"><?php echo $hr ?><?php echo $attaches ?></div><?php } ?>

<?php if (PKWK_SKIN_SHOW_TOOLBAR) { ?>
<!-- Toolbar -->
<div id="toolbar">
<?php
// Set toolbar-specific images
 $_IMAGE['skin']['reload']   = 'reload.png';
$_IMAGE['skin']['new']      = 'new.png';
$_IMAGE['skin']['edit']     = 'edit.png';
$_IMAGE['skin']['freeze']   = 'freeze.png';
$_IMAGE['skin']['unfreeze'] = 'unfreeze.png';
$_IMAGE['skin']['diff']     = 'diff.png';
$_IMAGE['skin']['upload']   = 'file.png';
$_IMAGE['skin']['copy']     = 'copy.png';
$_IMAGE['skin']['rename']   = 'rename.png';
$_IMAGE['skin']['top']      = 'top.png';
$_IMAGE['skin']['list']     = 'list.png';
$_IMAGE['skin']['search']   = 'search.png';
$_IMAGE['skin']['recent']   = 'recentchanges.png';
$_IMAGE['skin']['backup']   = 'backup.png';
$_IMAGE['skin']['help']     = 'help.png';
$_IMAGE['skin']['rss']      = 'rss.png';
$_IMAGE['skin']['rss10']    = & $_IMAGE['skin']['rss'];
$_IMAGE['skin']['rss20']    = 'rss20.png';
$_IMAGE['skin']['rdf']      = 'rdf.png';

function _toolbar($key, $x = 20, $y = 20){
    $lang  = & $GLOBALS['_LANG']['skin'];
    $link  = & $GLOBALS['_LINK'];
    $image = & $GLOBALS['_IMAGE']['skin'];
    if (! isset($lang[$key]) ) { echo 'LANG NOT FOUND';  return FALSE; }
    if (! isset($link[$key]) ) { echo 'LINK NOT FOUND';  return FALSE; }
    if (! isset($image[$key])) { echo 'IMAGE NOT FOUND'; return FALSE; }

    echo '<a href="' . $link[$key] . '">' .
    '<img src="' . IMAGE_DIR . $image[$key] . '" width="' . $x . '" height="' . $y . '" ' .
    'alt="' . $lang[$key] . '" title="' . $lang[$key] . '" />' .
    '</a>';
    return TRUE;
}
?>
<?php _toolbar('top') ?>

<?php if ($is_page) { ?>
&nbsp;
<?php if ($rw) { ?>
<?php _toolbar('edit') ?>
<?php if ($is_read && $function_freeze) { ?>
<?php if (! $is_freeze) { _toolbar('freeze'); } else { _toolbar('unfreeze'); } ?>
<?php } ?>
<?php } ?>
<?php _toolbar('diff') ?>
<?php if ($do_backup) { ?>
<?php _toolbar('backup') ?>
<?php } ?>
<?php if ($rw) { ?>
<?php if ((bool)ini_get('file_uploads')) { ?>
<?php _toolbar('upload') ?>
<?php } ?>
<?php _toolbar('copy') ?>
<?php _toolbar('rename') ?>
<?php } ?>
<?php _toolbar('reload') ?>
<?php } ?>
&nbsp;
<?php if ($rw) { ?>
<?php _toolbar('new') ?>
<?php } ?>
<?php _toolbar('list')   ?>
<?php _toolbar('search') ?>
<?php _toolbar('recent') ?>
&nbsp; <?php _toolbar('help') ?>
    &nbsp; <?php _toolbar('rss10', 36, 14) ?>
        </div>
<?php } // PKWK_SKIN_SHOW_TOOLBAR
?>

<?php if ($lastmodified != '') { ?>
    <div id="lastmodified">Last-modified: <?php echo $lastmodified ?></div>
<?php } ?>

<?php if ($related != '' && false) { ?>
    <div id="related">Link: <?php echo $related ?></div>
<?php } ?>

    <div id="footer">
Site admin: <a href="<?php echo $modifierlink ?>"><?php echo $modifier ?></a><p />
<?php echo S_COPYRIGHT ?>.
Powered by PHP <?php echo PHP_VERSION ?>. HTML convert time: <?php echo $taketime ?> sec.
</div>

</div>
</div>

<?php if (PKWK_ALLOW_JAVASCRIPT) { // Load JavaScript in the end so that pages can be loaded faster.
?>
    <script type="text/javascript" src="skin/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="skin/kickstart/js/prettify.js"></script>  <!-- PRETTIFY -->
    <script type="text/javascript" src="skin/kickstart/js/kickstart.js"></script> <!-- KICKSTART -->
    <script type="text/javascript" src="skin/pukiwiki.skin.js"></script>
<?php   if ($trackback_javascript) { ?>
    <script type="text/javascript" src="skin/trackback.js"></script>
<?php       } ?>
<?php   } ?>
    </body>
</html>
