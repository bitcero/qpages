<?php
/**
 * QuickPages for Xoops
 *
 * Copyright © 2015 Eduardo Cortés http://www.redmexico.com.mx
 * -------------------------------------------------------------
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
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * -------------------------------------------------------------
 * @copyright    Eduardo Cortés (http://www.redmexico.com.mx)
 * @license      GNU GPL 2
 * @package      qpages
 * @author       Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 * @url          http://www.redmexico.com.mx
 * @url          http://www.eduardocortes.mx
 */

require '../../../include/cp_header.php';

$mc = RMSettings::module_settings('qpages');
$myts = MyTextSanitizer::getInstance();

define('QP_PATH', XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname());
define('QP_URL', XOOPS_URL.'/modules/qpages/');

include_once QP_PATH.'/include/general.func.php';

load_mod_locale('qpages');

RMTemplate::getInstance()->add_style('admin.min.css', 'qpages');

// URL rewriting
if ($mc->permalinks) {
    $rule = "RewriteRule ^".trim($mc->basepath, '/')."/?(.*)$ modules/qpages/index.php [L]";
    $ht = new RMHtaccess('qpages');
    $htResult = $ht->write($rule);
    if ($htResult!==true) {
        $errmsg = __('You have set the URL redirection in the server, but .htaccess file could not be written! Please verify that you have writing permissions. If not, please add next lines to your htaccess file:', 'qpages');
        $errmsg .= '<pre>'.$rule.'</pre>';
        showMessage($errmsg, RMMSG_WARN);
    }
}
