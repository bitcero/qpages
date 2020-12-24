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
define('RMCLOCATION', 'pages');
require __DIR__ . '/header.php';

/**
 * Muestra los envíos existentes
 */
function showPages()
{
    global $rmTpl, $xoopsSecurity;

    $keyw = RMHttpRequest::request('keyw', 'string', '');
    $public = RMHttpRequest::request('public', 'string', '');
    $type = RMHttpRequest::request('type', 'string', '');
    $category = RMHttpRequest::request('cat', 'integer', 0);
    $sort = RMHttpRequest::request('sort', 'string', 'desc');
    $order = RMHttpRequest::request('order', 'string', 'id_page');

    $public = '1' != $public && '0' != $public && '' != $public ? '1' : $public;

    if ('0' == $public) {
        define('RMCSUBLOCATION', 'pages-draft');
    }

    if ('1' == $public && '' == $type) {
        define('RMCSUBLOCATION', 'pages-public');
    }

    if ('' != $type) {
        define('RMCSUBLOCATION', 'pages-' . $type);
    }

    if ('' == $public && '' == $type) {
        define('RMCSUBLOCATION', 'pages-list');
    }

    $db = XoopsDatabaseFactory::getDatabaseConnection();

    $sql = 'SELECT COUNT(*) FROM ' . $db->prefix('mod_qpages_pages');
    if ('' != $public) {
        $sql .= " WHERE public=$public";
    }

    if ('' != $type) {
        $sql .= (false !== mb_strpos($sql, 'WHERE') ? ' AND ' : ' WHERE ') . "type='" . ('normal' === $type ? '' : $type) . "'";
    }

    if ('' != trim($keyw)) {
        $sql .= (false !== mb_strpos($sql, 'WHERE') ? ' AND ' : ' WHERE ') . "title LIKE '%$keyw%'";
    }

    if (isset($category) && $category > 0) {
        $sql .= (false !== mb_strpos($sql, 'WHERE') ? ' AND ' : ' WHERE ') . "category='$category'";
    }

    /**
     * Paginacion de Resultados
     */
    $page = RMHttpRequest::request('page', 'integer', 1);
    $page = $page <= 0 ? 1 : $page;
    $limit = 25;
    list($num) = $db->fetchRow($db->query($sql));
    $tpages = ceil($num / $limit);
    $page = $page > $tpages ? $tpages : $page;
    $start = $num <= 0 ? 0 : ($page - 1) * $limit;

    $nav = new RMPageNav($num, $limit, $page, 5);
    //$nav->target_url('pages.php?cat='.$category.'&page={PAGE_NUM}');
    $link = "pages.php?order=$order&amp;sort=$sort&amp;keyw=$keyw&amp;public=$public&amp;type=$type&amp;cat=$category&amp;page={PAGE_NUM}";
    $nav->target_url($link);

    $sql .= " ORDER BY `$order` $sort LIMIT $start,$limit";
    $sql = str_replace('SELECT COUNT(*)', 'SELECT *', $sql);

    $result = $db->query($sql);
    $pages = [];
    while (false !== ($row = $db->fetchArray($result))) {
        $p = new QPPage();
        $p->assignVars($row);
        # Enlaces para las categorías
        $catego = new QPCategory($p->getVar('category'));
        $pages[] = [
            'id' => $p->id(),
            'title' => $p->getVar('title'),
            'category' => $catego->getVar('name'),
            'created' => formatTimestamp($p->getVar('created'), 's'),
            'modified' => formatTimestamp($p->getVar('modified'), 's'),
            'link' => $p->permalink(),
            'public' => $p->getVar('public'),
            'reads' => $p->getVar('hits'),
            'type' => $p->getVar('type'),
            'verbosetype' => QPFunctions::verboseType($p->getVar('type')),
            'description' => $p->getVar('extract'),
            'home' => $p->getVar('home'),
            'url' => $p->getVar('url'),
        ];
    }

    /**
     * Load categories
     */
    $categos = [];
    QPFunctions::categoriesTree($categos);
    $categories = [];
    foreach ($categos as $k) {
        $categories[] = ['id' => $k['id_cat'], 'name' => $k['name'], 'jumps' => $k['jumps']];
    }

    RMTemplate::getInstance()->add_script('qpages.js', 'qpages');
    RMTemplate::getInstance()->add_script('jquery.checkboxes.js', 'rmcommon');
    RMTemplate::getInstance()->assign('xoops_pagetitle', __('Pages Management', 'qpages'));

    RMBreadCrumb::get()->add_crumb(__('Pages management', 'qpages'), "pages.php?type=$type&amp;public=$public&amp;category=$category&amp;keyw=$keyw");

    // Toolbar
    QPFunctions::toolbar($category, $page);

    if ('' != $type) {
        $page_types = [
            'normal' => __('Normal pages', 'qpages'),
            'redir' => __('Redirection pages', 'qpages'),
            'squeeze' => __('Squeeze pages', 'qpages'),
            'sales' => __('Sales pages', 'qpages'),
        ];
        RMBreadCrumb::get()->add_crumb($page_types[$type]);
    } elseif ('' != $public) {
        RMBreadCrumb::get()->add_crumb('1' == $public ? __('Published', 'qpages') : __('Drafts', 'qpages'));
    } else {
        RMBreadCrumb::get()->add_crumb(__('All pages', 'qpages'));
    }

    xoops_cp_header();

    include RMTemplate::getInstance()->get_template('admin/qp-pages.php', 'module', 'qpages');

    xoops_cp_footer();
}

/**
 * Muestra el formulario para la creación de un nuevo artículo
 * @param mixed $edit
 * @param mixed $redir
 */
function newForm($edit = 0, $redir = false)
{
    global $rmTpl, $xoopsModule, $xoopsSecurity, $xoopsConfig, $rmEvents, $xoopsModuleConfig, $cuSettings, $cuIcons;

    define('RMCSUBLOCATION', 'new-page');

    foreach ($_REQUEST as $k => $v) {
        if ('page' === $k) {
            $pageNum = $v;
        } else {
            $$k = $v;
        }
    }

    $page = isset($page) ? $page : 1;

    if ($edit) {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        if ($id <= 0) {
            redirectMsg("pages.php?cat=$cat&page=$page", __('You must provide a page ID to edit!', 'qpages'), 1);
            die();
        }
        $page = new QPPage($id);
    } else {
        $page = new QPPage();
    }

    RMTemplate::getInstance()->add_script('forms-pages.min.js', 'qpages');
    RMTemplate::getInstance()->add_script('quick-editor.min.js', 'qpages', ['id' => 'quickeditor-js', 'footer' => 1]);
    RMTemplate::getInstance()->add_style('qpv.min.css', 'qpages', ['id' => 'qpv-css']);
    xoops_cp_header();

    $form = new RMForm('', '', '');

    $editor = new RMFormEditor('', 'content', '100%', '350px', $edit ? $page->getVar('content', 'tiny' === $cuSettings->editor_type ? '' : 'e') : '');

    $page_metas = $edit ? $page->get_meta() : [];
    $available_metas = qp_get_metas();

    $qp_url = XOOPS_URL;
    if ($xoopsModuleConfig['permalinks']) {
        $qp_url .= '/';
        $ht = new RMHtaccess('page: ' . $page->id());
        $rewrite = $ht->canWrite() && $ht->isCapable();
        $rewriteRule = '# begin page: ' . $page->id() . "\nRewriteRule ^" . $page->getVar('custom_title') . '/?(.*)$ modules/qpages/index.php?page=' . $page->getVar('nameid') . " [L]\n# end page: " . $page->id();
    } else {
        $qp_url .= '/modules/qpages/';
    }

    RMBreadCrumb::get()->add_crumb(__('Pages management', 'qpages'), 'pages.php');
    RMBreadCrumb::get()->add_crumb($edit ? __('Edit page', 'qpages') : __('Create page', 'qpages'));

    $rmTpl->add_style('forms.css', 'rmcommon');

    $rmTpl->add_head_script(include XOOPS_ROOT_PATH . '/modules/qpages/include/qp-lang.php');

    xoops_cp_header();

    include $rmTpl->get_template('admin/qp-pages-form.php', 'module', 'qpages');

    xoops_cp_footer();
}

/**
 * Allows to save a page
 * @param int $edit 1 if is a edition or 0 if is a new page
 */
function savePage($edit = 0)
{
    global $xoopsSecurity, $xoopsUser, $xoopsModule, $xoopsLogger;

    $xoopsLogger->renderingEnabled = false;
    $xoopsLogger->activated = false;

    $prevent = [
        'action',
        'XOOPS_TOKEN_REQUEST',
    ];

    $query = '';

    foreach ($_POST as $k => $v) {
        if (in_array($k, $prevent, true)) {
            continue;
        }

        $$k = $v;

        if (is_array($v)) {
            continue;
        }

        $query .= '' == $query ? $k . '=' . urlencode($v) : '&' . $k . '=' . urlencode($v);
    }

    $query .= $edit ? '&action=edit&id=' . $id : '&action=new';

    if ($edit) {
        if ($id <= 0) {
            QPFunctions::jsonResponse(__('Page ID has not been provided', 'qpages'), 1);
        }

        $page = new QPPage($id);

        if ($page->isNew()) {
            QPFunctions::jsonResponse(__('Specified page does not exists!', 'qpages'), 1);
        }

        /**
         * if previous template differs from new one, then delete it
         */
        if ($page->template != $custom_tpl && '' != $page->template) {
            unlink(XOOPS_CACHE_PATH . '/qpages/' . $page->template_name() . '-' . $page->id() . '.json');
        }
    } else {
        $page = new QPPage();
    }

    global $common;
    $mc = $common->settings()->module_settings('qpages');

    if ($mc->checktoken && !$xoopsSecurity->check()) {
        QPFunctions::jsonResponse(__('Session token expired!', 'qpages'), 1);
    }

    if ('' == $title) {
        QPFunctions::jsonResponse(__('You have not specified a title for this page!', 'qpages'), 1, 1);
    }

    if (!isset($nameid) || '' == $nameid) {
        $nameid = TextCleaner::getInstance()->sweetstring($title);
    }

    // Check if current page is a redirection page
    if ('redir' === $page_type) {
        if ('' == $url) {
            QPFunctions::jsonResponse(__('You must provide a redirection URL for this page!', 'qpages'), 1, 1);
        }
    }

    /**
     * Comprobamos que no exista otra página con el mismo título
     */
    $db = XoopsDatabaseFactory::getDatabaseConnection();
    $sql = 'SELECT COUNT(*) FROM ' . $db->prefix('mod_qpages_pages') . " WHERE nameid='$nameid'";

    $sql .= $edit ? ' AND id_page<>' . $page->id() : '';

    list($num) = $db->fetchRow($db->query($sql));

    if ($num > 0) {
        $sql = 'SELECT COUNT(*) FROM ' . $db->prefix('mod_qpages_pages') . " WHERE nameid='the-name'";
        $sql .= $edit ? ' AND id_page<>' . $page->id() : '';
        $i = 0;
        while ($num > 0) {
            $i++;
            $newname = $nameid . '-' . $i;
            list($num) = $db->fetchRow($db->query(str_replace('the-name', $nameid, $sql)));
        }

        $nameid = $newname;
    }

    // Assign general data
    $page->setVar('title', $title);
    $page->setVar('nameid', $nameid);
    $page->setVar('home', isset($home) ? $home : 0);
    $page->setVar('category', $category);
    $page->setVar('excerpt', TextCleaner::getInstance()->clean_disabled_tags($excerpt));
    $page->setVar('description', $description);
    $page->setVar('keywords', $keywords);
    $page->setVar('custom_title', $custom_title);
    $page->setVar('content', $content);
    if ($page->isNew()) {
        $page->setVar('created', time());
    }
    $page->setVar('modified', time());
    $page->setVar('public', $public);
    $page->setVar('groups', $groups);
    $page->setVar('uid', $xoopsUser->uid());
    $page->setVar('type', $page_type);
    $page->setVar('url', $url);
    $page->setVar('image', $image);
    $page->setVar('template', $custom_tpl);

    $precustom = $page->getVar('custom_url');

    if (isset($custom_url) && '' != $custom_url) {
        $custom_url = TextCleaner::getInstance()->sweetstring($custom_url);
        $page->setVar('custom_url', TextCleaner::getInstance()->sweetstring($custom_url));
    } else {
        $page->setVar('custom_url', '');
    }

    // Add Metas
    foreach ($meta_name as $k => $v) {
        $page->add_meta($v, $meta_value[$k]);
    }

    /**
     * Save template options
     * We need to determine the name of the template in order to get its options.
     * Example:
     *      If template is called "clean", then the  options will reside in the
     *      $_POST['clean'] index. We need to get this index beacause all options for theme
     *      will be in there.
     */
    if ('' != $custom_tpl) {
        $tpl_info = pathinfo($custom_tpl);
        $var_name = str_replace('tpl-', '', $tpl_info['filename']);
        $var_name = preg_replace('/^[^a-zA-Z_]+|[^a-zA-Z_0-9]+/', '', $var_name);
        $options = isset(${$var_name}) ? ${$var_name} : [];

        if (!empty($options)) {
            $page->set_template_options($options);
        }
    }

    $ret = $edit ? $page->update() : $page->save();

    if (isset($home) && $home) {
        $sql = 'UPDATE ' . $db->prefix('mod_qpages_pages') . ' SET home=0 WHERE id_page != ' . $page->id() . ' AND home=1';
        $db->queryF($sql);
    }

    if (isset($custom_url) && '' != $custom_url) {
        //if ($precustom != $custom_url) {
        $rule = 'RewriteRule ^' . $custom_url . '/?$ modules/qpages/index.php?page=' . $page->getVar('nameid') . ' [L]';
        $ht = new RMHtaccess('page: ' . $page->id());

        if ('' != $precustom) {
            $ht->removeRule();
        }

        $htResult = $ht->write($rule);

    //}
    } elseif ('' != $precustom) {
        $rule = 'RewriteRule ^' . $precustom . '/?$ modules/qpages/index.php?page=' . $page->getVar('nameid') . ' [L]';
        $ht = new RMHtaccess('page: ' . $page->id());
        $htResult = $ht->removeRule();
        $ht->write();
    }

    $data['custom_url'] = $page->getVar('custom_url');
    $data['permalink'] = $page->permalink();
    if (!$edit) {
        $data['redirect'] = 'pages.php?action=edit&id=' . $page->id();
    }
    if (true !== $htResult) {
        $data['htdata'] = '' != $htResult ? $htResult : '';
    }

    if ($ret) {
        QPFunctions::jsonResponse(__('Page saved successfully!', 'qpages'), 0, 1, $data);
    } else {
        QPFunctions::jsonResponse(__('Errors occurs while trying to save page!', 'qpages'), 1, 1);
    }
}

/**
 * Elimina un artículo de la base de datos
 */
function deletePage()
{
    global $xoopsSecurity, $xoopsModule;

    if (!$xoopsSecurity->check()) {
        redirectMsg("pages.php?cat=$cat&page=$page", __('Session token expired!', 'qpages'), 1);
        die();
    }

    $ids = rmc_server_var($_POST, 'ids', []);

    if (!is_array($ids) || empty($ids)) {
        redirectMsg("pages.php?cat=$cat&page=$page", __('Select at least a category to delete', 'qpages'), 1);
        die();
    }

    $errors = '';
    foreach ($ids as $id) {
        $page = new QPPage($id);
        if ($page->isNew()) {
            $errors .= sprintf(__('Page with ID "%s" does not exists!', 'qpages'), $id) . '<br>';
        }

        if (!$page->delete()) {
            $errors .= sprintf(__('Page "%s" could not be deleted:', 'qpages'), $page->getVar('title')) . $page->errors();
        }
    }

    if ('' != $errors) {
        redirectMsg("pages.php?cat=$cat&page=$page", __('Errors ocurred while trying to delete pages', 'qpages') . '<br>' . $errors, 1);
    } else {
        redirectMsg("pages.php?cat=$cat&page=$page", __('Pages deleted successfully!', 'qpages'), 0);
    }
}

function approveBulk($public)
{
    $cat = RMHttpRequest::post('cat', 'integer', 0);
    $page = RMHttpRequest::post('page', 'integer', 1);
    $ids = RMHttpRequest::post('ids', 'array', []);

    if (count($ids) <= 0) {
        redirectMsg($public ? "pages.php?action=privatize&cat=$cat&page=$page" : "pages.php?action=publicate&cat=$cat&page=$page", __('You must select at least one category!', 'qpages'), 1);
        die();
    }

    $db = XoopsDatabaseFactory::getDatabaseConnection();
    $sql = 'UPDATE ' . $db->prefix('mod_qpages_pages') . " SET public='$public' WHERE ";
    $cond = implode(',', $ids);
    $sql .= ' id_page IN (' . $cond . ')';

    if ($db->queryF($sql)) {
        redirectMsg($public ? "pages.php?action=private&cat=$cat&page=$page" : "pages.php?action=public&cat=$cat&page=$page", __('Database updated successfully!', 'qpages'), 0);
    } else {
        redirectMsg($public ? "pages.php?action=private&cat=$cat&page=$page" : "pages.php?action=public&cat=$cat&page=$page", __('Database update failed!', 'qpages') . '<br>' . $db->error(), 1);
    }
}

function linkedPages()
{
    foreach ($_REQUEST as $k => $v) {
        $$k = $v;
    }

    if (count($ids) <= 0) {
        redirectMsg("pages.php?cat=$cat&page=$page", __('Select at least a cetegory to edit', 'qpages'), 1);
        die();
    }

    $db = XoopsDatabaseFactory::getDatabaseConnection();

    $sql = 'SELECT * FROM ' . $db->prefix('mod_qpages_pages') . ' WHERE id_page IN (';
    $sql .= implode(',', $ids) . ')';

    $result = $db->query($sql);

    while (false !== ($row = $db->fetchArray($result))) {
        $page = new QPPage();
        $page->assignVars($row);
        $page->setType(!$page->type());
        $page->update();
    }

    redirectMsg("pages.php?cat=$cat&page=$page", __('Database updated successfully!', 'qpages'), 0);
}

function saveChanges()
{
    global $db;

    $cat = rmc_server_var($_POST, 'cat', '');
    $page = rmc_server_var($_POST, 'page', 1);
    $porder = rmc_server_var($_POST, 'porder', []);

    if (count($porder) <= 0) {
        header("location: pages.php?cat=$cat&page=$page", '', 0);
        die();
    }

    foreach ($porder as $k => $v) {
        $pag = new QPPage($k);
        if ($pag->isNew()) {
            continue;
        }
        $pag->setOrder($v);
        $pag->update();
    }
    redirectMsg("pages.php?cat=$cat&page=$page", __('Changes saved successfully!', 'qpages'), 0);
}

function clonePage()
{
    $id = RMHttpRequest::get('id', 'integer', 0);

    $page = new QPPage($id);
    if ($page->isNew()) {
        redirectMsg('pages.php', __('Specified page does not exists!', 'qpages'), 1);
        die();
    }

    $page->setNew();
    $page->setVar('title', $page->title . ' [cloned]');
    $page->setVar('nameid', TextCleaner::sweetstring($page->title));
    if (!$page->save()) {
        redirectMsg('pages.php', __('Page could not be cloned!', 'qpages'), 1);
        die();
    }

    redirectMsg('pages.php?op=edit&id=' . $page->id(), __('Page cloned successfully!', 'qpages'), 0);
}

/**
 * Loads the options for a given template
 */
function qpages_load_template_options()
{
    global $xoopsSecurity, $xoopsLogger;

    define('QP_AJAX_LOADED', 1);

    $xoopsLogger->activated = false;
    $xoopsLogger->renderingEnabled = false;

    $id = RMHttpRequest::post('id', 'integer', 0);
    $file = RMHttpRequest::post('file', 'string', '');

    if (!$xoopsSecurity->check(true, false, 'CUTOKEN')) {
        send_json_reponse(0, 1, [
            __('Session token not valid!', 'qpages'),
        ]);
    }

    if ('' == $file) {
        send_json_reponse(1, 1, [
            'message' => __('No template file has been specified!', 'qpages'),
        ]);
    }

    // Page can be a new object
    $page = new QPPage($id);

    $file_data = pathinfo($file);
    $path = XOOPS_ROOT_PATH . $file_data[ 'dirname' ];
    $form_file = $path . '/form-' . str_replace('tpl-', '', $file_data['filename']) . '.php';

    if (!file_exists($form_file)) {
        send_json_reponse(1, 0, [
            'form' => '',
        ]);
    }

    QPFunctions::load_tpl_locale($file);

    $form = new RMForm('', '', '');

    $tplSettings = (object) $page->tpl_option();

    ob_start();
    include $form_file;
    $form = ob_get_clean();
    send_json_reponse(1, 0, [
        'form' => $form,
    ]);
}

function send_json_reponse($token, $error, $data)
{
    global $xoopsSecurity;

    if ($token) {
        $data['token'] = $xoopsSecurity->createToken(0, 'CUTOKEN');
    }

    if ($error) {
        $data['error'] = 1;
    }

    echo json_encode($data);
    die();
}

$action = rmc_server_var($_REQUEST, 'action', '');

switch ($action) {
    case 'new':
        newForm();
        break;
    case 'save':
        savePage();
        break;
    case 'edit':
        newForm(1);
        break;
    case 'saveedited':
        savePage(1);
        break;
    case 'delete':
        deletePage();
        break;
    case 'private':
        showPages(0);
        break;
    case 'public':
        showPages(1);
        break;
    case 'publicate':
        approveBulk(1);
        break;
    case 'privatize':
        approveBulk(0);
        break;
    case 'savechanges':
        saveChanges();
        break;
    case 'linked':
        linkedPages();
        break;
    case 'clone':
        clonePage();
        break;
    case 'load-panel':
        qpages_load_template_options();
        break;
    default:
        showPages();
        break;
}
