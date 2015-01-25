<?php
// $Id: header.php 421 2010-05-17 05:22:57Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

require '../../../include/cp_header.php';

$mc = RMSettings::module_settings('qpages');
$myts =& MyTextSanitizer::getInstance();

define('QP_PATH',XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname());
define('QP_URL',XOOPS_URL.'/modules/qpages/');

include_once QP_PATH.'/include/general.func.php';

load_mod_locale('qpages');

// URL rewriting
if($mc->permalinks){

	$rule = "RewriteRule ^".trim($mc->basepath,'/')."/?(.*)$ modules/qpages/index.php [L]";
	$ht = new RMHtaccess('qpages');
	$htResult = $ht->write($rule);
	if($htResult!==true){
		$errmsg = __('You have set the URL redirection in the server, but .htaccess file could not be written! Please verify that you have writing permissions. If not, please add next lines to your htaccess file:','qpages');
		$errmsg .= '<pre>'.$rule.'</pre>';
		showMessage($errmsg, RMMSG_WARN);
	}

}

