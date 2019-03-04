<form name="frmboptions" id="frm-basic-options" method="post" action="pages.php">

    <div class="form-group">
        <label><strong><?php _e('Page Type:', 'qpages'); ?></strong></label>
        <select class="form-control" name="page_type" id="page-type">
            <option value=""<?php echo 'normal' == $page->getVar('type') || '' == $page->getVar('type') ? ' selected="selected"' : ''; ?>><?php _e('Normal Page', 'qpages'); ?></option>
            <option value="redir"<?php echo 'redir' == $page->getVar('type') ? ' selected="selected"' : ''; ?>><?php _e('Redirection Page', 'qpages'); ?></option>
        </select>
    </div>

    <div class="yes-normal no-redir<?php echo $page->isNew() || 'redir' != $page->getVar('type') ? '' : 'hidden-field'; ?> form-group">
        <label>
            <input type="checkbox" name="home" value="1" id="home"<?php echo $page->getVar('home') ? ' checked' : ''; ?>>
            <?php _e('Set as homepage', 'qpages'); ?>
        </label>
    </div>

</form>
<div id="qp-form-controls">
	<button type="submit" class="btn btn-primary btn-lg qp-submit" title="<?php $page->isNew() ? _e('Create Page', 'qpages') : _e('Save Changes', 'qpages'); ?>">
        <?php echo $cuIcons->getIcon('svg-qpages-checkmark'); ?>
    </button>
</div>
