<div class="span4">
	<form method="post" action="library.php" name="frmLibrary">

		<fieldset>

			<legend><?php _e('Add element to library','qpages'); ?></legend>

			<label for="l-name"><?php _e('Item name','qpages'); ?></label>
			<input type="text" name="name" id="l-name" class="input-block-level">

			<label for="l-type"><?php _e('Item type','qpages'); ?></label>
			<select class="input-block-level" name="type" id="l-type">
				<option value=""><?php _e('Select item type...','qpages'); ?></option>
				<option value="button"><?php _e('Button','qpages'); ?></option>
				<option value="icon"><?php _e('Icon','qpages'); ?></option>
				<option value="graphic"><?php _e('Graphic','qpages'); ?></option>
				<option value="text"><?php _e('Text block','qpages'); ?></option>
			</select>

			<div id="form-button" class="type-options">
				<hr>
				<label for="button-code"><?php _e('Button code','qpages'); ?></label>
				<input type="text" name="button_code" id="button-code" class="input-block-level">
				<span class="help-block"><?php _e('This code must be different from any other because will activate thsi button when called (e.g. buy-now).','qpages'); ?></span>

				<label for="button-content"><?php _e('Button HTML','qpages'); ?></label>
				<textarea name="button_content" id="button-content" rows="3" cols="45" class="input-block-level" placeholder="<?php _e('Insert HTML code here...','qpages'); ?>"></textarea>
				<span class="help-block"><?php _e('Insert the HTML code for the button. You can use the tag {CONTENT} to indicate that the button supports custom content and where supprot it.','qpages'); ?></span>

				<label for="button-content"><?php _e('Button CSS','qpages'); ?></label>
				<textarea name="button_css" id="button-css" rows="4" cols="45" class="input-block-level" placeholder="<?php _e('Insert CSS code here...','qpages'); ?>"></textarea>
				<span class="help-block"><?php _e('Insert the CSS code for the button. This code will insert automatically when button is called.','qpages'); ?></span>

			</div>

			<div class="form-actions" style="display: none;">
				<button type="submit" class="btn btn-large btn-primary btn-block"><?php _e('Create Item','qpages'); ?></button>
			</div>

		</fieldset>

		<input type="hidden" name="action" value="save">
		<?php echo $xoopsSecurity->getTokenHTML(); ?>
	</form>
</div>
<div class="span8">
	<ul class="nav nav-tabs" id="library-tabs">
	    <li<?php echo $active=='buttons' ? ' class="active"' : ''; ?>><a href="#lib-buttons" class="a-button" data-toggle="tab"><i class="icon-check-empty"></i> <?php _e('Buttons','qpages'); ?></a></li>
	    <li<?php echo $active=='icons' ? ' class="active"' : ''; ?>><a href="#lib-icons" class="a-icon" data-toggle="tab"><i class="icon-th"></i> <?php _e('Icons','qpages'); ?></a></li>
	    <li<?php echo $active=='graphics' ? ' class="active"' : ''; ?>><a href="#lib-graphics" class="a-graphic" data-toggle="tab"><i class="icon-picture"></i> <?php _e('Graphics','qpages'); ?></a></li>
	    <li<?php echo $active=='texts' ? ' class="active"' : ''; ?>><a href="#lib-texts" class="a-text" data-toggle="tab"><i class="icon-text-width"></i> <?php _e('Text Blocks','qpages'); ?></a></li>
	</ul>

	<div class="tab-content">

	    <div class="tab-pane<?php echo $active=='buttons' ? ' active' : ''; ?>" id="lib-buttons">
	        Buttons
	    </div>

	    <div class="tab-pane<?php echo $active=='icons' ? ' active' : ''; ?>" id="lib-icons">
	        Icons
	    </div>

	    <div class="tab-pane<?php echo $active=='graphics' ? ' active' : ''; ?>" id="lib-graphics">
	        Graphics
	    </div>

	    <div class="tab-pane<?php echo $active=='texts' ? ' active' : ''; ?>" id="lib-texts">
	        Text Blocks
	    </div>

	</div>
</div>
