<?php
    include ('defaults.php');
?>

<div class="cu-box">

    <div class="box-header">
        <span class="fa fa-caret-up box-handler"></span>
        <h3><span class="fa fa-globe"></span> <?php _e('Projects Template Options', 'projects'); ?></h3>
    </div>

    <div class="box-content">

        <?php if ( defined("QP_AJAX_LOADED") ): ?>

            <div class="well text-center well-lg">
                <?php _e('Please save page now and then refresh in order to view the options for this page.', 'projects'); ?>
            </div>

        <?php else: ?>

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#prj-general" role="tab" data-toggle="tab"><?php _e('General', 'projects'); ?></a></li>
            <li><a href="#prj-header" role="tab" data-toggle="tab"><?php _e('General', 'projects'); ?></a></li>
            <li><a href="#prj-fonts" role="tab" data-toggle="tab"><?php _e('Fonts', 'projects'); ?></a></li>
            <li><a href="#prj-content" role="tab" data-toggle="tab"><?php _e('Content', 'projects'); ?></a></li>
        </ul>

        <div class="tab-content">

            <!-- General options -->
            <div class="tab-pane active" id="prj-general">

                <div class="form-group">
                    <label><?php _e('Page logo:', 'projects'); ?></label>
                    <?php
                    $field = new RMFormImageUrl( '', 'projects[logo]', $tplSettings->logo );
                    echo $field->render();
                    ?>
                </div>

                <div class="form-group">
                    <label><?php _e('Page background', 'projects'); ?></label>
                    <?php
                    $field = new RMFormImageUrl( '', 'projects[bg]', $tplSettings->bg );
                    echo $field->render();
                    ?>
                </div>

                <div class="form-group">
                    <label><?php _e('Background mode:', 'projects'); ?></label>
                    <label class="radio-inline">
                        <input type="checkbox" name="projects[bgmode]" value="tiled"<?php echo $tplSettings->bgmode == 'tiled' ? ' checked' : ''; ?>> <?php _e('Tiled', 'projects'); ?>
                    </label>
                    <label class="radio-inline">
                        <input type="checkbox" name="projects[bgmode]" value="cover"<?php echo $tplSettings->bgmode == 'cover' ? ' checked' : ''; ?>> <?php _e('Full', 'projects'); ?>
                    </label>
                </div>

                <div class="form-group">
                    <label><?php _e('Theme color:', 'projects'); ?></label>
                    <?php
                    $field = new RMFormColorSelector( '', 'projects[color]', $tplSettings->color, false );
                    echo $field->render();
                    ?>
                </div>

            </div>

            <!-- Header options -->
            <div class="tab-pane" id="prj-header">

                <div class="form-group">
                    <label><?php _e('Top links:', 'projects'); ?></label>
                    <textarea class="form-control" name="projects[links]" rows="3"><?php echo $tplSettings->links; ?></textarea>
                    <small class="help-block"><?php _e('Add a new line for each link that you wish to show in navigation bar', 'projects'); ?></small>
                </div>

            </div>

            <!-- Fonts options -->
            <div class="tab-pane" id="prj-fonts">

                <div class="form-group">
                    <label><?php _e('Font for heading', 'projects'); ?></label>
                    <?php
                    $field = new RMFormWebfonts( '', 'projects[heading]', $tplSettings->heading );
                    echo $field->render();
                    ?>
                </div>

                <div class="form-group">
                    <label><?php _e('Font family string for heding:', 'clean'); ?></label>
                    <input type="text" name="projects[headingff]" data-rel="projects[heading]" class="form-control" value="<?php echo $tplSettings->headingff; ?>">
                </div>

                <div class="form-group">
                    <label><?php _e('Font for body', 'projects'); ?></label>
                    <?php
                    $field = new RMFormWebfonts( '', 'projects[body]', $tplSettings->body );
                    echo $field->render();
                    ?>
                </div>

                <div class="form-group">
                    <label><?php _e('Font family string for heding:', 'clean'); ?></label>
                    <input type="text" name="projects[bodyff]" data-rel="projects[body]" class="form-control" value="<?php echo $tplSettings->bodyff; ?>">
                </div>

            </div>

            <!-- Content options -->
            <div class="tab-pane" id="prj-content">
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        Hola
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <h3>Insert Content</h3>
                        <button type="button" class="btn btn-primary btn-lg btn-block" id="add-headline"><?php _e('Add headline', 'projects'); ?></button>
                        <button type="button" class="btn btn-info btn-lg btn-block" id="add-intro"><?php _e('Add Introduction', 'projects'); ?></button>
                        <button type="button" class="btn btn-success btn-lg btn-block" id="add-project"><?php _e('Add Project', 'projects'); ?></button>
                    </div>
                </div>
            </div>

        </div>

        <?php endif; ?>

    </div>

</div>

<?php if( defined( 'QP_AJAX_LOADED' ) ): ?>
    <script type="text/javascript">
        if ( confirm('<?php _e( 'Please save page now and refresh in order to use this template. The options will be loaded correctly after refresh.\nDo you want to save page now?', 'projects'); ?>') )
            $(".qp-submit").click();
    </script>
<?php else: ?>
    <script type="text/javascript">var prj_url = '<?php echo $tplSettings->url; ?>';</script>
    <script type="text/javascript" src="<?php echo $tplSettings->url; ?>/js/content.js"></script>
<?php endif; ?>