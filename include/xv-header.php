<?php
// $Id: xoops_version.php 709 2011-08-09 00:43:18Z i.bitcero $
// --------------------------------------------------------------
// QuickPages
// Module for personals and professionals portfolios
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

/**
 * Es necesario verificar si existe Common Utilities o si ha sido instalado
 * para evitar problemas en el sistema
 */
$amod = xoops_getActiveModules();
if (!in_array('rmcommon', $amod, true)) {
    $error = '<strong>WARNING:</strong> QuickPages requires %s to be installed!<br>Please install %s before trying to use QuickPages';
    $error = str_replace('%s', '<a href="http://github.com/bitcero/rmcommon/" target="_blank">Common Utilities</a>', $error);
    xoops_error($error);
    $error = '%s is not installed! This might cause problems with functioning of QuickPages and entire system. To solve, install %s or uninstall QuickPages and then delete module folder.';
    $error = str_replace('%s', '<a href="http://github.com/bitcero/rmcommon/" target="_blank">Common Utilities</a>', $error);
    trigger_error($error, E_USER_WARNING);
    echo '<br>';
}

if (!function_exists('__')) {
    function __($text, $d)
    {
        return $text;
    }
}
