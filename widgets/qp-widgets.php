<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortes <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

/**
 * Widget that shows the basic page options
 * @param mixed $page
 * @return mixed
 */
function qp_widget_basic($page)
{
    global $rmTpl, $cuIcons;

    $widget['title'] = '<span class="fa fa-check"></span> ' . __('Basic Options', 'qpages');

    ob_start();
    include $rmTpl->get_template('widgets/qp-widget-basic.php', 'module', 'qpages');
    $widget['content'] = ob_get_clean();

    return $widget;
}

/**
 * Widget that show the page templates
 * @param mixed $page
 * @return mixed
 */
function qp_widget_template($page)
{
    global $xoopsConfig, $rmEvents;

    $widget['title'] = '<span class="fa fa-file"></span> ' . __('Page Template', 'qpages');

    // Get available templates for squeeze templates
    $paths = [
        QP_PATH . '/templates/custom',
        XOOPS_THEME_PATH . '/' . $xoopsConfig['theme_set'] . '/modules/qpages/custom',
    ];

    /**
     * Modules, plugins and themes can add their own paths for templates
     */
    $paths = $rmEvents->run_event('qpages.get.templates.paths', $paths);

    $pages_templates = QPFunctions::getTemplates($paths);

    ob_start();
    include RMTemplate::getInstance()->get_template('widgets/qp-widget-template.php', 'module', 'qpages');
    $widget['content'] = ob_get_clean();

    return $widget;
}

/**
 * Visualization and permissions
 * @param mixed $page
 * @return mixed
 */
function qp_widget_visualization($page)
{
    global $rmTpl;

    $widget['title'] = '<span class="fa fa-eye"></span> ' . __('Visualization', 'qpages');

    $groups = new RMFormGroups(__('Allowed groups', 'qpages'), 'groups', 1, 1, 3, !$page->isNew() ? $page->getVar('groups') : [0]);

    $cats = [];
    QPFunctions::categoriesTree($cats);

    ob_start();
    include $rmTpl->get_template('widgets/qp-widget-view.php', 'module', 'qpages');
    $widget['content'] = ob_get_clean();

    return $widget;
}

/**
 * Provides a widget to specify the default image for page
 * @param mixed $page
 * @return array
 */
function qp_widget_image($page)
{
    global $xoopsSecurity, $xoopsModuleConfig, $xoopsUser, $rm_config;

    $widget = [];
    $widget['title'] = __('Featured Image', 'qpages');
    $util = new RMUtilities();

    if (isset($page) && is_a($page, 'QPPage')) {
        if ($page->isNew()) {
            $params = '';
        } else {
            $params = $page->getVar('image', 'e');
        }
    } else {
        $params = '';
    }

    $widget['content'] = '<form name="frmDefimage" id="frm-defimage" method="post">';
    $widget['content'] .= $util->image_manager('image', 'image', $params);
    $widget['content'] .= '</form>';

    return $widget;
}
