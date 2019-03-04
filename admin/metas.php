<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label><?php _e('Field name:', 'qpages'); ?></label>
            <?php if (count($available_metas) > 0): ?>
                <select name="dmeta_name" class="form-control" id="dmeta-sel">
                    <?php foreach ($available_metas as $meta): ?>
                        <option value="<?php echo $meta; ?>"><?php echo $meta; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" class="form-control" name="dmeta_name" id="dmeta" value="" size="30" style="display: none;">
                <a href="#" id="btn btn-default"><?php _e('Add New', 'qpages'); ?></a>
            <?php else: ?>
                <input type="text" class="form-control" name="dmeta_name" id="dmeta" value="" size="30">
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label><?php _e('Field value:', 'qpages'); ?></label>
            <textarea name="dmeta_value" class="form-control" id="dvalue" rows="3" cols="50"></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"><button type="button" id="add-field" class="btn btn-success"><?php _e('Add Field', 'qpages'); ?></button></div>
</div>
    <hr>
<div id="existing-meta">
    <div class="row">
        <div class="col-sm-4">
            <strong><?php _e('Field name', 'qpages'); ?></strong>
        </div>
        <div class="col-sm-8">
            <strong><?php _e('Field value', 'qpages'); ?></strong>
        </div>
    </div>
    <?php foreach ($page_metas as $meta => $value): ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" name="meta_name[]" value="<?php echo $meta; ?>" class="form-control"><br>
                <button type="button" class="btn btn-warning btn-xs delete-meta "><?php _e('Delete', 'dtransport'); ?></button>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <textarea name="meta_value[]" class="form-control"><?php echo $value; ?></textarea>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>
