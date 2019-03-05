<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortes <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class QpagesRmcommonPreload
{
    public static function eventRmcommonRegisterIconProvider($providers)
    {
        $providers[] = [
            'id' => 'qpages',
            'directory' => XOOPS_ROOT_PATH . '/modules/qpages/icons',
        ];

        return $providers;
    }

    public static function eventRmcommonLoadRightWidgets($widgets)
    {
        global $xoopsModule;

        if (!isset($xoopsModule) || 'qpages' != $xoopsModule->getVar('dirname')) {
            return $widgets;
        }

        if (defined('RMCSUBLOCATION') && RMCSUBLOCATION == 'new-page') {
            require_once dirname(__DIR__) . '/widgets/qp-widgets.php';

            $id = rmc_server_var($_REQUEST, 'id', 0);
            $page = new QPPage($id);

            $widgets[] = qp_widget_basic($page);
            $widgets[] = qp_widget_visualization($page);
            $widgets[] = qp_widget_template($page);
            $widgets[] = qp_widget_image($page);
        }

        return $widgets;
    }

    /**
     * Home page
     */
    public static function eventRmcommonIndexStart()
    {
        /**
         * Local function to assign smarty values
         * @param $page
         */
        function assign_template($page)
        {
            $GLOBALS['xoopsTpl']->assign('page', [
                'title' => $page->title,
                'text' => $page->content,
                'id' => $page->id(),
                'name' => $page->nameid,
                'mod_date' => sprintf(__('Last update: %s', 'qpages'), formatTimestamp($page->modified, 'c')),
                'reads' => sprintf(__('Read %u times', 'qpages'), $page->hits),
                'metas' => $page->get_meta(),
            ]);
        }

        require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qppage.class.php';
        $page = new QPPage();
        $page->load_home();

        $page->addHit();

        if ($page->isNew()) {
            return;
        }

        /**
         * Load required files
         */
        require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qpfunctions.class.php';
        require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qpcategory.class.php';
        require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qpcolor.class.php';

        if ('' == $page->template) {
            RMTemplate::getInstance()->header();
            assign_template($page);
            echo $GLOBALS['xoopsTpl']->fetch('db:qpages_page.tpl');
            RMTemplate::getInstance()->footer();
            die();
        }

        $file = XOOPS_ROOT_PATH . $page->template;
        $file_data = pathinfo($page->template);
        $cuSettings = RMSettings::cu_settings();

        /**
         * Load template data
         */
        $template = QPFunctions::templateInfo(XOOPS_ROOT_PATH . $file_data['dirname'], $file_data['basename']);
        // Set path to template dir
        $template->path = XOOPS_ROOT_PATH . $file_data[ 'dirname' ];
        // Set url to template dir
        $template->url = XOOPS_URL . $file_data['dirname'];
        // Template Settings
        $tplSettings = (object) $page->tpl_option();

        unset($file_data);

        $file = XOOPS_ROOT_PATH . $page->template;

        $content = file_get_contents($file);
        if (!$content) {
            return;
        }

        if ('.php' == mb_substr($file, -4)) {
            $info = [];
            preg_match("/\/\*(.*)\*\//s", $content, $info);
        } elseif ('.html' == mb_substr($file, -5)) {
            $info = [];
            preg_match("/^<{\*(.*)\*\}>/sm", $content, $info);
        }

        if (!isset($info[1])) {
            return;
        }

        $data = (object) parse_ini_string($info[1]);
        unset($content, $info);

        RMTemplate::get()->header();

        if ('.php' == mb_substr($page->template, -4)) {
            if (isset($data->Standalone) && $data->Standalone) {
                include $file;
            } else {
                include $file;
                RMTemplate::get()->footer();
            }
        } else {
            assign_template($page);
            if (isset($data->Standalone) && $data->Standalone) {
                echo $GLOBALS['xoopsTpl']->fetch($file);
            } else {
                echo $GLOBALS['xoopsTpl']->fetch($file);
                RMTemplate::get()->footer();
            }
        }
        die();
    }
}
