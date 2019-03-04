<?php
// $Id: header.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

require_once XOOPS_ROOT_PATH . '/header.php';

$mc = &$xoopsModuleConfig;
$db = XoopsDatabaseFactory::getDatabaseConnection();
$tpl = &$xoopsTpl;
$myts = MyTextSanitizer::getInstance();

define('QP_PATH', XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname());
if (!defined('QP_URL')) {
    define('QP_URL', XOOPS_URL . ($mc['permalinks'] ? $mc['basepath'] : '/modules/' . $xoopsModule->dirname()));
}

RMTemplate::getInstance()->add_style('main.css', 'qpages');

require_once __DIR__ . '/include/general.func.php';
