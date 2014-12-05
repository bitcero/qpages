<?php
/**
 * QuickPages for XOOPS
 * A module that allows to publish and manage pages in XOOPS
 * 
 * Copyright © 2009 - 2014 Eduardo Cortés
 * -----------------------------------------------------------------
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * -----------------------------------------------------------------
 * @package      QuickPages
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 * @copyright    2009 - 2014 Eduardo Cortés
 * @license      GPL v2
 * @link         http://eduardocortes.mx
 */

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
		$errmsg .= '<pre>'.$htResult.'</pre>';
		showMessage($errmsg, RMMSG_WARN);
	}

}

