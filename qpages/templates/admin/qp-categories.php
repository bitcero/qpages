<h1 class="cu-section-title"><span class="icon icon-pushpin"></span> <?php _e('Categories','qpages'); ?></h1>

<script type="text/javascript">
<!--
	var qp_select_message = '<?php _e('Select at least a category to apply this action!','qpages'); ?>';
	var qp_message = '<?php _e('Do you really want to delete selected categories?','qpages'); ?>';
	qp_message += '\n\n<?php _e('WARNING: All pages under these categories will be deleted too!','qpages'); ?>';
-->
</script>

<div class="row">

	<div class="col-sm-5 col-md-3">
		<form name="frm_new_cat" id="frm-cat" method="post" action="cats.php">
            <h4><?php _e('Add Category','qpages'); ?></h4>
            <div class="form-group">
                <label for="cat-name"><?php _e('Category name','qpages'); ?></label>
                <input type="text" size="30" name="name" id="cat-name" class="form-control" />
            </div>
            <div class="form-group">
                <label for="cat-desc"><?php _e('Category description','qpages'); ?></label>
                <textarea name="description" id="cat-desc" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="cat-parent"><?php _e('Parent category','qpages'); ?></label>
                <select name="parent" id="cat-parent" class="form-control">
                    <option value="0" selected="selected"><?php _e('Select category...','qpages'); ?></option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat['id_cat']; ?>"><?php echo $cat['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg"><?php _e('Add Category','qpages'); ?></button>
                <input type="hidden" name="op" value="save" />
            </div>
		</form>
	</div>

	<div class="col-sm-7 col-md-9">
	
		<form name="frm_categos" id="frm-categos" method="post" action="cats.php">
		<div class="cu-bulk-actions">
			<select name="op" id="bulk-top" class="form-control">
				<option value="">Bulk actions</option>
				<option value="delete"><?php _e('Delete','qpages'); ?></option>
			</select>
			<button type="button" onclick="before_submit('frm-categos');" class="btn btn-default"><?php _e('Apply','qpages'); ?></button>
		</div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="head" align="center">
                    <th width="20" class="text-center"><input<?php if(empty($categories)): ?> disabled="disabled"<?php endif; ?> type="checkbox" id="checkall" onclick='$("#frm-categos").toggleCheckboxes(":not(#checkall)");' /></th>
                    <th width="30" class="text-center"><?php _e('ID','qpages'); ?></th>
                    <th><?php _e('Name','qpages'); ?></th>
                    <th><?php _e('Description','qpages'); ?></th>
                    <th class="text-center"><?php _e('Pages','qpages'); ?></th>
                </tr>
                </thead>
                <tfoot>
                <tr class="head" align="center">
                    <th width="20" class="text-center"><input<?php if(empty($categories)): ?> disabled="disabled"<?php endif; ?> type="checkbox" id="checkall2" onclick='$("#frm-categos").toggleCheckboxes(":not(#checkall2)");' /></th>
                    <th width="30" class="text-center"><?php _e('ID','qpages'); ?></th>
                    <th><?php _e('Name','qpages'); ?></th>
                    <th><?php _e('Description','qpages'); ?></th>
                    <th class="text-center"><?php _e('Pages','qpages'); ?></th>
                </tr>
                </tfoot>
                <tbody>
                <?php if(empty($categories)): ?>
                    <tr class="even">
                        <td class="text-center" colspan="5"><?php _e('There are not categories created yet!','qpages'); ?></td>
                    </tr>
                <?php endif; ?>
                <?php foreach($categories as $cat): ?>
                    <tr class="<?php echo tpl_cycle("even,odd"); ?>" valign="top">
                        <td class="text-center"><input type="checkbox" name="ids[]" id="item-<?php echo $cat['id_cat']; ?>" value="<?php echo $cat['id_cat']; ?>" /></td>
                        <td class="text-center"><strong><?php echo $cat['id_cat']; ?></strong></td>
                        <td>
                            <strong><?php echo $cat['name']; ?></strong>
    				<span class="cu-item-options">
    					<a href="?op=edit&amp;id=<?php echo $cat['id_cat']; ?>"><?php _e('Edit','qpages'); ?></a> |
    					<a href="javascript:;" onclick="select_option(<?php echo $cat['id_cat']; ?>,'delete','frm-categos');"><?php _e('Delete','qpages'); ?></a>
    				</span>
                        </td>
                        <td>
                            <?php echo $cat['description']; ?>
                        </td>
                        <td class="text-center"><?php echo $cat['posts']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

		<div class="cu-bulk-actions">
			<select name="opb" id="bulk-bottom" class="form-control">
				<option value="">Bulk actions</option>
				<option value="delete"><?php _e('Delete','qpages'); ?></option>
			</select>
			<button type="button" onclick="before_submit('frm-categos');" class="btn btn-default"><?php _e('Apply','qpages'); ?></button>
		</div>
		<?php echo $xoopsSecurity->getTokenHTML(); ?>
		</form>
	
	</div>
	
</div>
