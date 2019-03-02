<form name="frmtemplate" id="frm-page-template" method="post" action="pages.php">
    <div class="yes-normal no-redir<?php echo $page->getVar('type')!='' ? ' hidden-field' : ''; ?> form-group">
        <label><strong><?php _e('Custom page template:', 'qpages'); ?></strong></label>
        <select class="form-control" name="custom_tpl" id="custom-tpl">
            <?php foreach ($pages_templates as $tpl): ?>
                <option value="<?php echo $tpl->File; ?>"<?php echo !$page->isNew() && $page->template==$tpl->File ? ' selected="selected"' : ''; ?>><?php echo $tpl->Name; ?><?php echo $tpl->Standalone ? ' (' . __('Standalone', 'qpages') .')' : ''; ?></option>
            <?php endforeach; ?>
        </select>
        <span class="help-block">
            <small><?php echo sprintf(__('You can add templates for pages to your own themes by creating files in theme directory <code>%s</code>.', 'qpages'), $xoopsConfig['theme_set'] . '/modules/qpages/custom'); ?></small>
        </span>
    </div>
</form>
