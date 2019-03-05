<?php
// $Id: home.php 350 2010-05-04 05:11:42Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

$GLOBALS['xoopsOption']['template_main'] = 'qpages_index.tpl';
$xoopsOption['module_subpage'] = 'index';
require __DIR__ . '/header.php';

$tpl->assign('page_title', $xoopsModule->name());
$tpl->assign('xoops_pagetitle', $xoopsModule->name() . ' &raquo; ' . __('Main', 'qpages'));

$result = $db->query('SELECT * FROM ' . $db->prefix('mod_qpages_categos') . " WHERE parent='0' ORDER BY name ASC");
$categos = [];

QPFunctions::categoriesTree($categos);

while (false !== ($k = $db->fetchArray($result))) {
    $catego = new QPCategory();
    $catego->assignVars($k);
    $lpages = $catego->loadPages();
    $pages = [];
    foreach ($lpages as $p) {
        $ret = [];
        $page = new QPPage();
        $page->assignVars($p);
        $ret['title'] = $p['title'];
        $ret['description'] = TextCleaner::getInstance()->clean_disabled_tags($p['description']);
        $ret['link'] = $page->permalink();
        $pages[] = $ret;
    }
    $link = $catego->permalink();
    $subcats = $catego->getSubcategos();
    $tpl->append(
        'categos',
        [
        'id' => $catego->id(),
        'name' => $catego->name,
        'description' => $catego->description,
        'pages' => $pages,
        'pages_count' => count($lpages),
        'link' => $link,
        'subcats' => count($subcats) > 0 ? $subcats : '',
        'subcats_count' => count($subcats), ]
    );
}

$tpl->assign('lang_subcats', __('Subcategories', 'qpages'));
$tpl->assign('lang_pagesin', __('Pages in this category', 'qpages'));

require __DIR__ . '/footer.php';
