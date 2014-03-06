<h1 class="cu-section-title"><span class="fa fa-file-text"></span> <?php _e('Pages','qpages'); ?></h1>
<script type="text/javascript">
<!--
	var qp_select_message = '<?php _e('Select at least a page to apply this action!','qpages'); ?>';
	var qp_message = '<?php _e('Do you really wish to delete selected pages?','qpages'); ?>';
-->
</script>
<form name="frmSearch" method="get" action="pages.php">
<div class="cu-bulk-actions">
    <input type="text" name="keyw" value="<?php echo $keyw ?>" placeholder="<?php _e('Search term...','qpages'); ?>" class="form-control" /> &#160;
    <?php _e('Category:','qpages'); ?>
    <select name="cat" onchange="submit();" class="form-control">
        <option value="0"<?php if($category==0): ?> selected="selected"<?php endif; ?>><?php _e('Select category','qpages'); ?></option>
        <?php foreach($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"<?php if($cat['id']==$category): ?> selected="selected"<?php endif; ?>><?php echo str_repeat("&#8212;", $cat['jumps']); ?> <?php echo $cat['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-warning"><?php _e('Filter','qpages'); ?></button>

	<ul class="nav nav-pills pull-right">
        <li<?php if($public=='' && $type==''): ?> class="active"<?php endif; ?>><a href="pages.php"><?php _e('Show all','qpages'); ?></a></li>
        <li<?php if($public==1): ?> class="active"<?php endif; ?>><a href="pages.php?public=1"><?php _e('Published','qpages'); ?></a></li>
        <li<?php if(is_numeric($public) && $public==0): ?> class="active"<?php endif; ?>><a href="pages.php?public=0"><?php _e('Drafts','qpages'); ?></a></li>
        <li><a href="pages.php?action=new&amp;page=<?php echo $page; ?>&amp;category=<?php echo $category; ?>"><?php _e('Add page','qpages'); ?></a></li>
	</ul>
</div>
</form>

<form name="modPages" id="frm-pages" method="post" action="pages.php">
<div class="cu-bulk-actions">
	<?php $nav->display(false); ?>
	<select name="action" id="bulk-top" class="form-control">
		<option value="" selected="selected"><?php _e('Bulk actions...','qpages'); ?></option>
		<option value="privatize"><?php _e('Set as draft','qpages'); ?></option>
		<option value="publicate"><?php _e('Publish','qpages'); ?></option>
		<option value="linked"><?php _e('Set as linked','qpages'); ?></option>
		<option value="delete"><?php _e('Delete','qpages'); ?></option>
        <option value="savechanges"><?php _e('Set order','qpages'); ?></option>
	</select>
	<button type="button" onclick="before_submit('frm-pages');" class="btn btn-default"><?php _e('Apply','qpages'); ?></button>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th width="20" class="text-center"><input<?php if(empty($categories)): ?> disabled="disabled"<?php endif; ?> type="checkbox" id="checkall" onclick='$("#frm-pages").toggleCheckboxes(":not(#checkall)");' /></th>
            <th width="20" class="text-center"><?php _e('ID','qpages'); ?></th>
            <th width="20">&nbsp;</th>
            <th class="text-left"><?php _e('Title','qpages'); ?></th>
            <th><?php _e('Description','qpages'); ?></th>
            <th class="text-center"><?php _e('Created','qpages'); ?></th>
            <th class="text-center"><?php _e('Modified','qpages'); ?></th>
            <th class="text-center"><?php _e('Views','qpages'); ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th width="20" class="text-center"><input<?php if(empty($categories)): ?> disabled="disabled"<?php endif; ?> type="checkbox" id="checkall" onclick='$("#frm-pages").toggleCheckboxes(":not(#checkall)");' /></th>
            <th width="20" class="text-center"><?php _e('ID','qpages'); ?></th>
            <th width="20">&nbsp;</th>
            <th class="text-left"><?php _e('Title','qpages'); ?></th>
            <th><?php _e('Description','qpages'); ?></th>
            <th class="text-center"><?php _e('Created','qpages'); ?></th>
            <th class="text-center"><?php _e('Modified','qpages'); ?></th>
            <th class="text-center"><?php _e('Views','qpages'); ?></th>
        </tr>
        </tfoot>
        <tbody>
        <?php if(empty($pages)): ?>
            <tr class="text-center">
                <td align="center" colspan="8" class="text-center"><?php _e('There are not pages created yet!','qpages'); ?></td>
            </tr>
        <?php endif; ?>
        <?php foreach($pages as $item): ?>
            <tr valign="top">
                <td class="text-center"><input type="checkbox" name="ids[]" id="item-<?php echo $item['id']; ?>" value="<?php echo $item['id']; ?>" /></td>
                <td class="text-center"><strong><?php echo $item['id']; ?></strong></td>
                <td class="text-center">
                    <a href="pages.php?type=<?php echo $item['type']; ?>" title="<?php echo $item['verbosetype']; ?>">
                        <?php if($item['type']=='redir'): ?>
                        <span class="fa fa-link"></span>
                        <?php else: ?>
                        <span class="fa fa-file-text"></span>
                        <?php endif; ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo $item['link']; ?>">
                        <?php if($item['home']): ?><span class="fa fa-home"></span><?php endif; ?>
                        <strong><?php echo $item['title']; ?></strong>
                    </a>
                    <span class="qp_status"><?php if(!$item['public']): _e('[Draft]','qpages'); endif; ?></span>
                    <span class="cu-item-options">
                        <a href="pages.php?action=edit&amp;id=<?php echo $item['id']; ?>&amp;category=<?php echo $category; ?>"><?php _e('Edit','qpages'); ?></a> |
                        <a href="#" onclick="select_option(<?php echo $item['id']; ?>,'delete','frm-pages');"><?php _e('Delete','qpages'); ?></a> |
                        <a href="pages.php?action=clone&amp;id=<?php echo $item['id']; ?>&amp;category=<?php echo $category; ?>"><?php _e('Clone','qpages'); ?></a>
                    </span>
                </td>
                <td><?php echo $item['description']; ?></td>
                <td class="text-center"><?php echo $item['created']; ?></td>
                <td class="text-center"><?php echo $item['modified']; ?></td>
                <td class="text-center"><?php echo $item['reads']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<div class="cu-bulk-actions">
	<?php $nav->display(false); ?>
	<select name="actionb" id="bulk-bottom" class="form-control">
		<option value="" selected="selected"><?php _e('Bulk actions...','qpages'); ?></option>
        <option value="privatize"><?php _e('Set as draft','qpages'); ?></option>
        <option value="publicate"><?php _e('Publish','qpages'); ?></option>
        <option value="linked"><?php _e('Set as linked','qpages'); ?></option>
        <option value="delete"><?php _e('Delete','qpages'); ?></option>
        <option value="savechanges"><?php _e('Set order','qpages'); ?></option>
	</select>
	<button type="button" onclick="before_submit('frm-pages');" class="btn btn-default"><?php _e('Apply','qpages'); ?></button>
</div>
<input type="hidden" name="page" value="<?php echo $page; ?>" />
<input type="hidden" name="cat" value="<?php echo $category; ?>" />
<?php echo $xoopsSecurity->getTokenHTML(); ?>
</form>
