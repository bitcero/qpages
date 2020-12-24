<?php
// $Id: index.php 239 2010-03-01 17:39:11Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

require  dirname(dirname(__DIR__)) . '/mainfile.php';

if (false === mb_strpos(XOOPS_URL, 'www.')) {
    $request = str_replace(XOOPS_URL, '', str_replace('www.', '', RMUris::current_url()));
} else {
    $request = str_replace(XOOPS_URL, '', RMUris::current_url());
}

$request = str_replace('/modules/qpages/', '', $request);

// Replace the base paths
$request = trim(str_replace($xoopsModuleConfig['basepath'], '', $request), '/');

/**
 * Decodifica los parámetros de la URI
 * para permitir el mejor manejo de las
 * distintas secciones
 * @return array
 */
function headerDecode()
{
    global $xoopsModuleConfig, $xoopsModule, $request, $cuSettings;

    $header = [];
    if (0 == $cuSettings->permalinks) {
        foreach ($_REQUEST as $k => $v) {
            $header[$k] = $v;
        }
        if (!isset($header['show'])) {
            $header['show'] = 'index';
        }

        return $header;
    }

    /*
     * For pages that have custom url
     */
    $page = RMHttpRequest::get('page', 'string', '');
    if ('' != $page) {
        $header['show'] = 'page';

        return $header;
    }

    if ('' == $request || 'index.php' === mb_substr($request, 0, 9) || '?' === mb_substr($request, 0, 1)) {
        $header['show'] = 'index';

        return $header;
    }

    $vars = explode('/', $request);

    if ('category' === $vars[0]) {
        $header['show'] = 'category';

        return $header;
    }

    $header['show'] = 'page';

    return $header;
}

$header = headerDecode();

switch ($header['show']) {
    case 'category':
        require __DIR__ . '/catego.php';
        break;
    case 'page':
        require __DIR__ . '/page.php';
        break;
    case 'index':
        require __DIR__ . '/home.php';
        break;
}
