<?php
// $Id: page.php 1050 2012-09-11 19:41:22Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

if (!defined('XOOPS_MAINFILE_INCLUDED')) {
    require dirname(__DIR__) . '/../mainfile.php';
    $header = [];
    foreach ($_REQUEST as $k => $v) {
        $header[$k] = $v;
    }
}

function qp_assign_page(QPPage $page)
{
    global $xoopsTpl;
    $xoopsTpl->assign('page', [
        'title' => $page->title,
        'text' => $page->content,
        'id' => $page->id(),
        'name' => $page->nameid,
        'mod_date' => sprintf(__('Last update: %s', 'qpages'), formatTimestamp($page->modified, 'c')),
        'modified' => $page->modified,
        'hits' => $page->hits,
        'reads' => sprintf(__('Read %u times', 'qpages'), $page->hits),
        'metas' => $page->get_meta(),
        'image' => RMImage::get()->load_from_params($page->image),
    ]);
}

load_mod_locale('qpages');

$xoopsOption['module_subpage'] = 'page';

if (isset($_REQUEST['page'])) {
    $nombre = explode('/', $_REQUEST['page']);
} else {
    $nombre = explode('/', $request);
}

$nombre[0] = TextCleaner::sweetstring($nombre[0]);

$page = new QPPage($nombre[0]);
if ($page->isNew() || 0 == $page->getVar('public')) {
    QPFunctions::error_404();
    die();
}

if (!in_array(0, $page->groups, true)) {
    if (empty($xoopsUser)) {
        redirect_header(QP_URL, 2, _MS_QP_NOALLOWED);
        die();
    }
    $ok = false;
    foreach ($xoopsUser->getGroups() as $k) {
        if ($ok) {
            continue;
        }
        if (in_array($k, $page->groups, true)) {
            $ok = true;
        }
    }
    if (!$ok && !$xoopsUser->isAdmin()) {
        redirect_header(QP_URL, 2, _MS_QP_NOALLOWED);
        die();
    }
}

$page->addHit();

if ('redir' === $page->type) {
    header('location: ' . $page->url);
    die();
}

$catego = new QPCategory($page->category);

if ('' != $page->template) {
    $file = XOOPS_ROOT_PATH . $page->template;
    $file_data = pathinfo($page->template);

    /**
     * Load template data
     */

    QPFunctions::load_tpl_locale($page->template);

    $template = QPFunctions::templateInfo(XOOPS_ROOT_PATH . $file_data['dirname'], $file_data['basename']);
    // Set path to template dir
    $template->path = XOOPS_ROOT_PATH . $file_data[ 'dirname' ];
    // Set url to template dir
    $template->url = XOOPS_URL . $file_data['dirname'];
    // Template Settings
    $tplSettings = (object) $page->tpl_option();

    unset($file_data);

    RMTemplate::getInstance()->header();

    $xoopsTpl->assign('xoops_pagetitle', $page->title);

    if ('.php' === mb_substr($page->template, -4)) {
        if (isset($template->Standalone) && $template->Standalone) {
            include $file;
        } else {
            include $file;
            RMTemplate::getInstance()->footer();
        }
    } else {
        qp_assign_page($page);
        $xoopsTpl->assign('tplSettings', $tplSettings);
        if (isset($template->Standalone) && $template->Standalone) {
            $htmlScripts = $common->template()->get_scripts(true);
            $htmlScripts['inlineHeader'] = $common->template()->inline_scripts();
            $htmlScripts['inlineFooter'] = $common->template()->inline_scripts(1);
            $htmlStyles = $common->template()->get_styles(true);

            $xoopsTpl->assign('themeScripts', $htmlScripts);
            $xoopsTpl->assign('themeStyles', $htmlStyles);
            $xoopsTpl->assign('htmlAttributes', $common->template()->render_attributes());
            $xoopsTpl->assign('tplSettings', $tplSettings);

            echo $GLOBALS['xoopsTpl']->fetch($file);
        } else {
            echo $GLOBALS['xoopsTpl']->fetch($file);
            RMTemplate::getInstance()->footer();
        }
    }
    die();
}

$GLOBALS['xoopsOption']['template_main'] = 'qpages_page.tpl';
require __DIR__ . '/header.php';

// Asignamos datos de la categoría
$tpl->assign('qpcategory', ['id' => $catego->id(), 'name' => $catego->name, 'nameid' => $catego->nameid]);

$idp = 0; # ID de la categoria padre
$rutas = [];
$path = explode('/', $catego->getPath());
$tbl = $db->prefix('mod_qpages_categos');
foreach ($path as $k) {
    if ('' == $k) {
        continue;
    }
    $sql = "SELECT id_cat FROM $tbl WHERE nameid='$k' AND parent='$idp'";
    $result = $db->query($sql);
    if ($db->getRowsNum($result) > 0) {
        list($idp) = $db->fetchRow($result);
        $rutas[] = new QPCategory($idp);
    }
}

$location = '<a href="' . QP_URL . '" title="' . $xoopsModule->name() . '">' . $xoopsModule->name() . '</a> ';
$pt = []; // Titulo de la página
$pt[] = $xoopsModule->name();
foreach ($rutas as $k) {
    $location .= '&raquo; <a href="' . $k->permalink() . '">' . $k->name . '</a> ';
    $pt[] = $k->name;
}
$location .= '&raquo; ' . $page->title;
$pt[] = $page->title;
$pagetitle = '';
for ($i = count($pt) - 1; $i >= 0; $i--) {
    $pagetitle .= '' == $pagetitle ? $pt[$i] : " &laquo; $pt[$i]";
}

$tpl->assign('page_location', $location);
$tpl->assign('xoops_pagetitle', $pagetitle);

if ($xoopsUser && $xoopsUser->uid() != $page->uid) {
    $page->add_read();
}

qp_assign_page($page);

// Add meta description and title
$rmf = RMFunctions::get();
$description = $page->getVar('description', 'e');
$keywords = $page->getVar('keywords', 'e');
$rmf->add_keywords_description('' != $description ? $description : '', '' != $keywords ? $keywords : '');
RMTemplate::getInstance()->add_meta('title', $page->getVar('custom_title'));

// Páginas relacionadas
if ($mc['related']) {
    $sql = 'SELECT * FROM ' . $db->prefix('mod_qpages_pages') . " WHERE category='" . $catego->id() . "' AND id_page<>'" . $page->id() . "' ORDER BY RAND() DESC LIMIT 0,$mc[related_num]";
    $result = $db->query($sql);
    $tpl->assign('related_num', $db->getRowsNum($result));
    while (false !== ($row = $db->fetchArray($result))) {
        $rp = new QPPage();
        $rp->assignVars($row);
        $tpl->append('related', [
            'id' => $rp->id(),
            'link' => $rp->permalink(),
            'title' => $rp->title,
            'modified' => $common->timeFormat()->ago((int) $rp->modified),
            'hits' => $rp->hits,
            'desc' => $rp->description,
            'image' => RMImage::get()->load_from_params($rp->image),
        ]);
    }
}

$tpl->assign('show_related', $mc['related']);
$tpl->assign('lang_related', __('Related Pages', 'qpages'));
$tpl->assign('lang_page', __('Page', 'qpages'));
$tpl->assign('lang_modified', __('Last modification', 'qpages'));
$tpl->assign('lang_hits', __('Hits', 'qpages'));

RMEvents::get()->run_event('qpages.view.page', $page);

require __DIR__ . '/footer.php';
