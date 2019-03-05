<h1 class="cu-section-title">
    <i class="<?php echo $page->isNew() ? 'icon-magic' : 'icon-edit'; ?>"></i> <?php echo $page->isNew() ? __('Create New Page', 'qpages') : __('Editing Page', 'qpages'); ?>
</h1>

<form name="frmPages" id="frm-page" method="post" data-translate="true">
    <div class="no-normal yes-redir"<?php echo 'redir' !== $page->getVar('type') ? ' style="display: none;"' : ''; ?>>
        <div class="alert alert-block">
            <?php _e('Redirection Pages are simply symbolic links to another pages or URLs, don\'t matter if linked pages are located in same website or in another location.', 'qpages'); ?>
        </div>
    </div>

    <div class="form-group">
        <input class="form-control input-lg" type="text" name="title" id="qp-title" value="<?php echo $page->isNew() ? '' : $page->getVar('title'); ?>" placeholder="<?php _e('Page title', 'qpages'); ?>">
    </div>

    <div id="qp-permalink" class="form-group">
        <label><?php _e('Permalink:', 'qpages'); ?></label>
        <span>
            <?php if ($page->isNew()): ?>
            <?php _e('The permalink will appear after you save this page.', 'qpages'); ?>
            <?php else: ?>
            <a href="<?php echo $page->permalink(); ?>" target="permalink"><?php echo $page->permalink(); ?></a>
            <?php endif; ?>
        </span>
    </div>

    <?php if ($xoopsModuleConfig['permalinks']): ?>
    <div class="yes-normal no-redir  " id="qp-custom-url">
        <div class="form-group">
            <label><strong><?php echo __('Custom URL:', 'qpages'); ?></strong></label>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $qp_url; ?></span>
                <input type="text" name="custom_url" class="form-control" value="<?php echo $page->getVar('custom_url'); ?>">
            </div>
        </div>
        <?php if ($rewrite): ?>
        <div class="alert alert-info">
            <?php _e('You can specify a custom URL for this page, but remember that this URL must not exists in your site previously.', 'qpages'); ?>
            <?php _e('If you specify a custom URL, then the permalink for this page will be ignored.', 'qpages'); ?>
        </div>
        <?php else: ?>
        <div class="alert alert-warning">
            <?php _e('QuickPages can not write the htaccess file. Please do it manually by inserting next line in your file:', 'qpages'); ?>
            <pre><?php echo $rewriteRule; ?></pre>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="yes-normal yes-redir   form-group" id="qp-description">
        <label><strong><?php _e('Page description:', 'qpages'); ?></strong></label>
        <textarea placeholder="<?php _e('Short description for page', 'qpages'); ?>" name="excerpt" class="form-control" cols="45" rows="3"><?php echo $page->isNew() ? '' : $page->getVar('excerpt', 'e'); ?></textarea>
    </div>

    <!--div id="qpages-editor-options" class="yes-normal no-redir">
        <ul>
            <li>
                <span><?php echo $cuIcons->getIcon('svg-qpages-layers'); ?></span>
            </li>
            <li>
                <a href="#" data-editor="normal"><?php _e('Standard Editor', 'qpages'); ?></a>
            </li>
            <li>
                <a href="#" data-editor="visual"><?php _e('Quick Editor', 'qpages'); ?></a>
            </li>
        </ul>
    </div-->

    <div class="form-group no-redir yes-normal" id="qpages-editor-standard">
        <?php echo $editor->render(); ?>
    </div>

    <div id="qpages-editor-visual" class="yes-normal no-redir" style="display: none;">
        <div id="visual-data"></div>
        Editor Visual
    </div>

    <div id="qp-page-options"<?php echo '' != $page->template ? '' : ' style="display: none;"'; ?>>
    <?php if ('' != $page->template): ?>

        <?php echo QPFunctions::template_form($page); ?>

    <?php endif; ?>
    </div>

    <div class="<?php echo 'redir' !== $page->getVar('type') ? 'hidden-field' : ''; ?> no-normal yes-redir form-group" id="qp-url-field">
        <label><strong><?php _e('Redirection URL:', 'qpages'); ?></strong></label>
        <input type="text" name="url" value="<?php echo $page->isNew() ? '' : $page->getVar('url'); ?>" class="form-control">
    </div>

    <div class="cu-box box-blue-grey yes-normal no-redir">
        <div class="box-header">
            <span class="fa fa-caret-up box-handler"></span>
            <h3 class="box-title">
                <?php echo $cuIcons->getIcon('svg-rmcommon-search'); ?>
                <?php _e('SEO options', 'qpages'); ?>
            </h3>
        </div>
        <div class="box-content collapsable">

            <div class="form-group">
                <label for="custom_title"><?php _e('Custom title:', 'qpages'); ?></label>
                <input type="text" class="form-control" name="custom_title" id="customtitle" value="<?php echo $page->isNew() ? '' : $page->getVar('custom_title'); ?>">
                <span class="help-block"><small><?php _e('This title will replace the page title in "title" tag.', 'qpages'); ?></small></span>
            </div>

            <div class="form-group">
                <label for="description"><?php _e('Description', 'dtransport'); ?></label>
                <textarea name="description" id="description" cols="50" rows="3" class="form-control"><?php echo $page->isNew() ? '' : $page->getVar('description', 'e'); ?></textarea>
            </div>

            <div class="form-group">
                <label for="keywords"><?php _e('Keywords:', 'qpages'); ?></label>
                <input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo $page->isNew() ? '' : $page->getVar('keywords'); ?>">
            </div>

        </div>
    </div>

    <div class="cu-box box-warning">
        <div class="box-header">
            <span class="fa fa-caret-up box-handler"></span>
            <h3 class="box-title">
                <?php _e('Custom Fields', 'qpages'); ?>
            </h3>
        </div>
        <div class="box-content collapsable">

            <?php require dirname(dirname(__DIR__)) . '/admin/metas.php'; ?>

        </div>
    </div>

    <input type="hidden" name="action" id="qpages-action" value="<?php echo $edit ? 'saveedited' : 'save'; ?>">
    <input type="hidden" name="category" value="<?php echo $edit ? $page->category : (isset($category) ? $category : 0); ?>">
    <?php if (isset($pageNum)): ?>
    <input type="hidden" name="page" value="<?php echo $pageNum; ?>">
    <?php endif; ?>
    <?php if ($edit): ?><input type="hidden" name="id" value="<?php echo $page->id(); ?>" id="page-id"><?php endif; ?>
    <?php echo $xoopsSecurity->getTokenHTML(); ?>

</form>
