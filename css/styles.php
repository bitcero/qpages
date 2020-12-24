<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

$xoopsOption['nocommon'] = 1;
include dirname(dirname(dirname(__DIR__))) . '/mainfile.php';

$page = isset($_GET[ 'page' ]) ? (int)$_GET['page'] : 0;
$tpl = isset($_GET[ 'tpl' ]) ? $_GET[ 'tpl' ] : '';
$css = isset($_GET[ 'css' ]) ? urldecode($_GET[ 'css' ]) : '';

if ($page <= 0) {
    die('Page?');
}

if ('' == $tpl) {
    die('Template?');
}

if ('' == $css) {
    die('Styles?');
}

$file_settings = XOOPS_VAR_PATH . '/caches/xoops_cache/qpages/' . $tpl . '-' . $page . '.json';
if (file_exists($file_settings)) {
    $tplSettings = (object) json_decode(file_get_contents($file_settings), true);
} else {
    $tplSettings = new stdClass();
    $tplSettings->path = XOOPS_ROOT_PATH . '/modules/qpages/templates/custom/' . $tpl;
}

$file_css = $tplSettings->path . '/' . trim($css, '/');

// Color management
include XOOPS_ROOT_PATH . '/modules/qpages/class/qpcolor.class.php';
include XOOPS_ROOT_PATH . '/modules/qpages/class/qpfunctions.class.php';
$qpColor = new QPColor();

header('Content-type: text/css');
include $file_css;
