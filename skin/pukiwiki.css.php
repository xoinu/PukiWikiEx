<?php
// PukiWiki - Yet another WikiWikiWeb clone.
// $Id: pukiwiki.css.php,v 1.5 2012/03/20 18:26:35 yamazaki Exp $
// Copyright (C)
//   2002-2005 PukiWiki Developers Team
//   2001-2002 Originally written by yu-ji
// License: GPL v2 or (at your option) any later version
//
// Default CSS
define( 'BASE_COLOR_1', "#000" );
define( 'BASE_COLOR_2', "#888888" );
define( 'BASE_FONT_FAMILY', "Verdana" );
//define( 'BASE_FONT_FAMILY', "Calibri" );
//define( 'BASE_FONT_FAMILY', "Candara" );

// Send header
header('Content-Type: text/css');
$matches = array();
if(ini_get('zlib.output_compression') && preg_match('/\b(gzip|deflate)\b/i', $_SERVER['HTTP_ACCEPT_ENCODING'], $matches)) {
	header('Content-Encoding: ' . $matches[1]);
	header('Vary: Accept-Encoding');
}

// Default charset
$charset = isset($_GET['charset']) ? $_GET['charset']  : '';
switch ($charset) {
	case 'Shift_JIS': break; /* this @charset is for Mozilla's bug */
	default: $charset ='iso-8859-1';
}

// Media
$media   = isset($_GET['media'])   ? $_GET['media']    : '';
if ($media != 'print') $media = 'screen';

// Output CSS ----

define('HEADER_BACKGROUND_COLOR', "#F8F8F8");
define('HEADER_BORDER_COLOR', "#AAA");
define('HEADER_BORDER_COLOR2', "#DDD");
?>
@charset "<?php echo $charset ?>";

body,td {
    line-height:120%;
}

a:link {
<?php	if ($media == 'print') { ?>
    text-decoration: none;
<?php	} else { ?>
	color:#262;
	background-color:inherit;
	text-decoration:none;
<?php	} ?>
}

a:active {
	color:<?php echo BASE_COLOR_1 ?>;
	background-color:#CCDDEE;
	text-decoration:none;
}

a:visited {
<?php	if ($media == 'print') { ?>
    text-decoration: none;
<?php	} else { ?>
	color:#262;
	background-color:inherit;
	text-decoration:none;
<?php	} ?>
}

a:hover {
	color:<?php echo BASE_COLOR_1 ?>;
	text-decoration:underline;
}

img {
	border:none;
	vertical-align:middle;
}

strong {
    font-weight:bold;
    font-style:normal;
}

span.noexists {
	color:inherit;
	background-color:#FFFACC;
}

.small { font-size:80%; }

.super_index {
	color:#DD3333;
	background-color:inherit;
	font-weight:bold;
	font-size:60%;
	vertical-align:super;
}

a.note_super {
	color:#DD3333;
	background-color:inherit;
	font-weight:bold;
	font-size:60%;
	vertical-align:super;
}

div.jumpmenu {
	font-size:60%;
	text-align:right;
}

hr.full_hr {
	border-style:solid;
	border-color:#bbb;
	border-width:1px;
}
hr.note_hr {
	/*width:90%;*/
	border-style:ridge;
	border-color:#333333;
	border-width:1px 0px;
	text-align:center;
	margin:1em auto 0em auto;
}

span.size1 {
	font-size:xx-small;
	line-height:130%;
	text-indent:0px;
	display:inline;
}
span.size2 {
	font-size:x-small;
	line-height:130%;
	text-indent:0px;
	display:inline;
}
span.size3 {
	font-size:small;
	line-height:130%;
	text-indent:0px;
	display:inline;
}
span.size4 {
	font-size:medium;
	line-height:130%;
	text-indent:0px;
	display:inline;
}
span.size5 {
	font-size:large;
	line-height:130%;
	text-indent:0px;
	display:inline;
}
span.size6 {
	font-size:x-large;
	line-height:130%;
	text-indent:0px;
	display:inline;
}
span.size7 {
	font-size:xx-large;
	line-height:130%;
	text-indent:0px;
	display:inline;
}

/* html.php/catbody() */
strong.word0 {
	background-color:#FFFF66;
	color:black;
}
strong.word1 {
	background-color:#A0FFFF;
	color:black;
}
strong.word2 {
	background-color:#99FF99;
	color:black;
}
strong.word3 {
	background-color:#FF9999;
	color:black;
}
strong.word4 {
	background-color:#FF66FF;
	color:black;
}
strong.word5 {
	background-color:#880000;
	color:white;
}
strong.word6 {
	background-color:#00AA00;
	color:white;
}
strong.word7 {
	background-color:#886800;
	color:white;
}
strong.word8 {
	background-color:#004699;
	color:white;
}
strong.word9 {
	background-color:#990099;
	color:white;
}

/* html.php/edit_form() */
.edit_form { clear:both; }

textarea {
    margin: 5px 0px 5px 0px;
    height:400px;
    box-sizing: border-box;
    -webkit-box-sizing:border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    width:100%;
    resize: vertical;
}

/* pukiwiki.skin.php */
div#header {
	padding:0px;
	margin:0px;
}

div#navigator {
<?php   if ($media == 'print') { ?>
	display:none;
<?php   } else { ?>
	clear:both;
	padding:4px 0px 0px 0px;
	margin:0px;
<?php   } ?>
}

div#body {
	padding:0px;
	margin:0px 0px 0px .5em;
}

div#note {
	clear:both;
	padding:0px;
	margin:0px;
}

div#attach {
<?php   if ($media == 'print') { ?>
	display:none;
<?php   } else { ?>
	clear:both;
	padding:0px;
	margin:0px;
<?php   } ?>
}

div#toolbar {
<?php   if ($media == 'print') { ?>
        display:none;
<?php   } else { ?>
	clear:both;
	padding:0px;
	margin:0px;
	text-align:right;
<?php   } ?>
}

div#lastmodified {
	font-size:80%;
	padding:0px;
	margin:0px;
}

div#related {
<?php   if ($media == 'print') { ?>
        display:none;
<?php   } else { ?>
	font-size:80%;
	padding:0px;
	margin:16px 0px 0px 0px;
<?php   } ?>
}

div#footer {
	font-size:70%;
	padding:0px;
	margin:16px 0px 0px 0px;
}

div#banner {
	float:right;
	margin-top:24px;
}

div#preview {
	color:inherit;
	background-color:#F5F8FF;
}

img#logo {
<?php   if ($media == 'print') { ?>
	display:none;
<?php   } else { ?>
	float:left;
	margin-right:20px;
<?php   } ?>
}

/* aname.inc.php */
.anchor {}
.anchor_super {
	font-size:x-small;
	vertical-align:middle;
}

/* br.inc.php */
br.spacer {}

/* calendar*.inc.php */
.style_calendar {
	padding:0px;
	border:0px;
	margin:3px;
	color:inherit;
	background-color:#ddd;
	text-align:center;
}
.style_td_caltop {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#eee;
	text-align:center;
}
.style_td_today {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#FFFFDD;
	text-align:center;
}
.style_td_sat {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#eeeeff;
	text-align:center;
}
.style_td_sun {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#ffeeee;
	text-align:center;
}
.style_td_blank {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#eee;
	text-align:center;
}
.style_td_day {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#f8f8f8;
	text-align:center;
}
.style_td_week {
	padding:5px;
	margin:1px;
	color:inherit;
	background-color:#DDE5EE;
	font-weight:bold;
	text-align:center;
}

.style_calendar,
.style_td_caltop,
.style_td_today,
.style_td_blank,
.style_td_sat,
.style_td_sun,
.style_td_day,
.style_td_week
{
    border-width: 1px;
    border-style: solid;
    border-color: #bbb;
	font-size:100%;
}

/* calendar_viewer.inc.php */
div.calendar_viewer {
	color:inherit;
	background-color:inherit;
	margin-top:20px;
	margin-bottom:10px;
	padding-bottom:10px;
}
span.calendar_viewer_left {
	color:inherit;
	background-color:inherit;
	float:left;
}
span.calendar_viewer_right {
	color:inherit;
	background-color:inherit;
	float:right;
}

/* clear.inc.php */
.clear {
	margin:0px;
	clear:both;
}

/* counter.inc.php */
div.counter { font-size:70%; }

/* diff.inc.php */
span.diff_added {
	color:blue;
	background-color:inherit;
}

span.diff_removed {
	color:red;
	background-color:inherit;
}

/* hr.inc.php */
hr.short_line {
	text-align:center;
	/*width:80%;*/
	border-style:solid;
	border-color:#333333;
	border-width:1px 0px;
}

/* include.inc.php */
h5.side_label { text-align:center; }

/* navi.inc.php */
ul.navi {
	margin:0px;
	padding:0px;
	text-align:center;
}
li.navi_none {
	display:inline;
	float:none;
}
li.navi_left {
	display:inline;
	float:left;
	text-align:left;
}
li.navi_right {
	display:inline;
	float:right;
	text-align:right;
}

/* new.inc.php */
span.comment_date { font-size:x-small; }
span.new1 {
	color:red;
	background-color:transparent;
	font-size:x-small;
}
span.new5 {
	color:green;
	background-color:transparent;
	font-size:xx-small;
}

/* popular.inc.php */
span.counter { font-size:70%; }

ol,ul {
  margin: 0px 0px 0px 2em
}

ol ol { list-style: lower-roman }
ol ol ol { list-style: lower-alpha }
thead td { font-weight: bold; background-color: #f0f0f0; text-align:center }

ul.popular_list {
<?php
/*
	padding:0px;
	border:0px;
	margin:0px 0px 0px 1em;
	word-wrap:break-word;
	word-break:break-all;
*/
?>
}

/* recent.inc.php,showrss.inc.php */
ul.recent_list {
<?php
/*
	padding:0px;
	border:0px;
	margin:0px 0px 0px 1em;
	word-wrap:break-word;
	word-break:break-all;
*/
?>
}

/* ref.inc.php */
div.img_margin {
	margin-left:32px;
	margin-right:32px;
}

/* vote.inc.php */
td.vote_label {
	color:inherit;
	background-color:#FFCCCC;
}
td.vote_td1 {
	color:inherit;
	background-color:#DDE5FF;
}
td.vote_td2 {
	color:inherit;
	background-color:#EEF5FF;
}

s,del
{
 color: Red;
}

em { font-weight: bold; }

div.contents {
  border: 1px solid #bbbbbb;
  color: black;
  background-color: #f8f8f8;
  font-size: 90%;
  text-align: left;
  margin: 0px;
  padding: 2em 4em 2em 2em;
  display: inline-table;
  max-width: 65%;
}

div.contents ul li { list-style-type: none }
div.contents ul.list1 { margin: 0em }
ul.list2, ul.list3, ul.list4, ul.list5 { margin: 0px 0px 0px 2em }

<?php if ($media == 'print') { ?>
    ul.breadcrumbs, ul.menu, div#menubar, div#footer, div#lastmodified, div#attach, a.anchor_super, div.jumpmenu { display : none }
    div#wrap { border-width:0px }
<?php } else { ?>
/* Toggle Tree */
ul.toggle-tree { margin: 0px 0px 0px .5em }
ul.toggle-tree li           { list-style: none }
ul.toggle-tree li           { padding-left: 20px; margin-left: 0px }
ul.toggle-tree li.open      { cursor: pointer; background: url(../image/minus.gif)  top left no-repeat }
ul.toggle-tree li.closed    { cursor: pointer; background: url(../image/plus.gif)   top left no-repeat }
ul.toggle-tree li.bullet    { cursor: default; background: url(../image/bullet.gif) top left no-repeat }
ul.toggle-tree li.open   ul { display: block }
ul.toggle-tree li.closed ul { display: none }
<?php } ?>