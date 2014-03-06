<form name="frmboptions" id="frm-basic-options" method="post" action="pages.php">

    <div class="form-group">
        <label><strong><?php _e('Page Type:','qpages'); ?></strong></label>
        <select class="form-control" name="page_type" id="page-type">
            <option value=""<?php echo $page->getVar('type')=='normal' || $page->getVar('type')=='' ? ' selected="selected"' : ''; ?>><?php _e('Normal Page','qpages'); ?></option>
            <option value="redir"<?php echo $page->getVar('type')=='redir' ? ' selected="selected"' : ''; ?>><?php _e('Redirection Page','qpages'); ?></option>
        </select>
    </div>

    <div class="yes-normal no-redir<?php echo $page->isNew() || $page->getVar('type')!='redir' ? '' : 'hidden-field'; ?> form-group">
        <label class="checkbox">
            <input type="checkbox" name="home" value="1" id="home"<?php echo $page->getVar('home') ? ' checked="checked"' : ''; ?>>
            <?php _e('Set as homepage','qpages'); ?>
        </label>
    </div>

    <div class="yes-normal no-redir<?php echo $page->getVar('type')!='' ? ' hidden-field' : ''; ?> form-group">
        <label><strong><?php _e('Custom page template:','qpages'); ?></strong></label>
        <select class="form-control" name="custom_tpl" id="custom-tpl">
            <?php foreach($pages_templates as $tpl): ?>
            <option value="<?php echo $tpl->File; ?>"<?php echo !$page->isNew() && $page->template==$tpl->File ? ' selected="selected"' : ''; ?>><?php echo $tpl->Name; ?></option>
            <?php endforeach; ?>
        </select>
        <span class="help-block">
            <small><?php echo sprintf( __('You can add templates for pages to your own themes by creating files in theme directory <code>%s</code>.', 'qpages'), $xoopsConfig['theme_set'] . '/modules/qpages/custom' ); ?></small>
        </span>
    </div>
</form>
<div id="qp-form-controls">
	<button type="submit" class="btn btn-primary btn-lg qp-submit"><?php $page->isNew() ? _e('Create Page','qpages') : _e('Save Changes','qpages'); ?></button>
	<button type="button" class="btn btn-lg btn-default qp-cancel"><?php _e('Cancel','qpages'); ?></button>
</div>