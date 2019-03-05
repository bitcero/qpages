<?php
// $Id: qpages_blocks.php 1050 2012-09-11 19:41:22Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

function qpages_block_categories()
{
    global $xoopsConfig, $mc;

    require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qpcategory.class.php';
    require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qpfunctions.class.php';
    require_once XOOPS_ROOT_PATH . '/modules/qpages/include/general.func.php';

    $mc = RMSettings::module_settings('qpages');
    $db =  XoopsDatabaseFactory::getDatabaseConnection();

    if (!defined('QP_URL')) {
        define('QP_URL', XOOPS_URL . ($mc->permalinks ? $mc->basepath : '/modules/qpages'));
    }

    $block = [];
    $categos = [];
    QPFunctions::categoriesTree($categos);

    foreach ($categos as $k) {
        $catego = new QPCategory();
        $catego->assignVars($k);
        $rtn = [];
        $rtn['id'] = $catego->id();
        $rtn['nombre'] = $catego->name;
        $rtn['link'] = $catego->permalink();
        $rtn['ident'] = $k['jumps'] > 0 ? $k['jumps'] + 8 : 0;
        $block['categos'][] = $rtn;
    }

    return $block;
}

/**
 * Mostramos las página existentes
 * @param mixed $options
 * @return array
 */
function qpages_block_pages($options)
{
    global $xoopsConfig;

    require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qppage.class.php';

    $db = XoopsDatabaseFactory::getDatabaseConnection();
    $mc = RMSettings::module_settings('qpages');

    if (!defined('QP_URL')) {
        define('QP_URL', XOOPS_URL . ($mc->permalinks ? $mc->basepath : '/modules/qpages'));
    }

    $sql = 'SELECT * FROM ' . $db->prefix('mod_qpages_pages');
    if ($options['category'] > 0) {
        $sql .= " WHERE category='$options[category]'";
    }

    $sql .= " ORDER BY created DESC LIMIT 0,$options[limit]";
    $block = [];
    $result = $db->query($sql);
    while (false !== ($row = $db->fetchArray($result))) {
        $page = new QPPage();
        $page->assignVars($row);
        $rtn = [];
        $rtn['id'] = $page->id();
        $rtn['titulo'] = $page->title;
        $rtn['link'] = $page->permalink();
        $block['pages'][] = $rtn;
    }

    return $block;
}

function qpages_block_pages_edit($options)
{
    require_once XOOPS_ROOT_PATH . '/modules/qpages/class/qpfunctions.class.php';
    $categos = [];
    QPFunctions::categoriesTree($categos);

    ob_start(); ?>

    <div class="form-group row">

        <div class="col-sm-4 col-lg-3">
            <label><?php _e('From category:', 'qpages'); ?></label>
        </div>
        <div class="col-sm-8 col-lg-9">
            <select name="options[category]" class="form-control">
                <option value="0"<?php echo 0 == $options['category'] ? ' selected' : ''; ?>><?php _e('Select category...', 'dtransport'); ?></option>
                <?php foreach ($categos as $k): ?>
                <option value="<?php echo $k['id_cat']; ?>"<?php echo $k['id_cat'] == $options['category'] ? ' selected' : ''; ?>>
                    <?php echo str_repeat('&#8212;', $k['jumps']) . ' ' . $k['name']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>

    <div class="form-group row">

        <div class="col-sm-4 col-lg-3">
            <label><?php _e('Number of pages', 'qpages'); ?></label>
        </div>
        <div class="col-sm-8 col-lg-9">
            <input type="text" class="form-control" name="options[limit]" value="<?php echo $options['limit']; ?>">
        </div>

    </div>

    <?php
    $form = ob_get_clean();

    return $form;
}
