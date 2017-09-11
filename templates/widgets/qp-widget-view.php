<form name="formview" id="frm-view" method="post" action="pages.php">
	<div class="yes-redir yes-normal yes-squeeze yes-sales<?php echo $page->getVar('type')=='redir' ? ' hidden-field' : ''; ?>">
        <div class="form-group">
            <label><strong><?php _e('Page status:','qpages'); ?></strong></label>
            <select name="public" class="form-control">
                <option value="1"<?php echo $page->getVar('public')==1 ? ' selected="selected"' : ''; ?>><?php _e('Published','qpages'); ?></option>
                <option value="0"<?php echo $page->getVar('public')==0 ? ' selected="selected"' : ''; ?>><?php _e('Draft','qpages'); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label><strong><?php _e('Allowed groups:','qpages'); ?></strong></label>
            <?php echo $groups->render(); ?>
        </div>

        <div class="form-group">
            <label><strong><?php _e('Category:','qpages'); ?></strong></label>
            <select name="category" class="form-control">
                <option value=""<?php echo $page->isNew() ? ' selected="selected"' : ''; ?>><?php _e('Select category...','qpages'); ?></option>
                <?php foreach($cats as $cat): ?>
                    <option value="<?php echo $cat['id_cat']; ?>"<?php echo $page->getVar('category')==$cat['id_cat'] ? ' selected="selected"' : ''; ?>>
                        <?php echo str_repeat("&#8212;", $cat['jumps']) . ' ' . $cat['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

	</div>
</form>
