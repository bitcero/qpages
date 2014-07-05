<div class="cu-box">

    <div class="box-header">
        <span class="fa fa-caret-up box-handler"></span>
        <h3><span class="fa fa-money"></span> <?php _e('Clean Landing Template Options', 'qpages'); ?></h3>
    </div>

    <div class="box-content">

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#clean-general" role="tab" data-toggle="tab"><?php _e('General', 'clean'); ?></a></li>
            <li><a href="#clean-header" role="tab" data-toggle="tab"><?php _e('Header', 'clean'); ?></a></li>
            <li><a href="#clean-main" role="tab" data-toggle="tab"><?php _e('Main Content', 'clean'); ?></a></li>
            <li><a href="#clean-forms" role="tab" data-toggle="tab"><?php _e('Forms', 'clean'); ?></a></li>
        </ul>

        <div class="tab-content">

            <!-- General options -->
            <div class="tab-pane active" id="clean-general">
                <?php
                $font = new RMFormWebfonts('', 'clean[body_font]', $page->tpl_option( 'body_font' ) );
                ?>
                <div class="form-group">
                    <label><?php _e('Font for body:', 'clean'); ?></label>
                    <?php echo $font->render(); ?>
                </div>
                <div class="form-group">
                    <label><?php _e('Font family string for body:', 'clean'); ?></label>
                    <input type="text" name="clean[body_ff]" data-rel="clean[body_font]" class="form-control" value="<?php echo $tplSettings->body_ff != '' ? $tplSettings->body_ff : "'Asap', sans-serif"; ?>">
                </div>
                <?php
                $font = new RMFormWebfonts('', 'clean[em_font]', $page->tpl_option( 'em_font' ) );
                ?>
                <div class="form-group">
                    <label><?php _e('Font for emphasised text:', 'clean'); ?></label>
                    <?php echo $font->render(); ?>
                </div>
                <div class="form-group">
                    <label><?php _e('Font family string for emphasised text:', 'clean'); ?></label>
                    <input type="text" name="clean[em_ff]" data-rel="clean[em_font]" class="form-control" value="<?php echo $tplSettings->em_ff != '' ? $tplSettings->em_ff : "'Pacifico', cursive"; ?>">
                </div>

                <!-- Color scheme -->
                <div class="form-group">
                    <label><?php _e('Color scheme:', 'clean'); ?></label>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[color1]', $tplSettings->color1 != '' ? $tplSettings->color1 : '034b81' );
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[color2]', $tplSettings->color2 != '' ? $tplSettings->color2 : '9bb649' );
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[color3]', $tplSettings->color3 != '' ? $tplSettings->color3 : 'f1703d' );
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[color4]', $tplSettings->color4 != '' ? $tplSettings->color4 : 'afb0ad' );
                            echo $color->render();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header options -->
            <div class="tab-pane" id="clean-header">

                <!-- Logo -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="logo-name"><?php _e('Name first word:', 'clean'); ?></label>
                            <input type="text" class="form-control" name="clean[logo_first]" id="logo-name" value="<?php echo $page->tpl_option( 'logo_first' ); ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="logo-subname"><?php _e('Name second word:', 'clean'); ?></label>
                            <input type="text" class="form-control" name="clean[logo_second]" id="logo-subname" value="<?php echo $page->tpl_option( 'logo_second' ); ?>">
                        </div>
                    </div>
                </div>

                <!-- Social icons -->
                <div class="form-group">
                    <label><?php _e('Social links:', 'clean'); ?></label>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-facebook-square"></span></span>
                        <input type="text" name="clean[social][facebook]" value="<?php echo $tplSettings->social['facebook']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-twitter-square"></span></span>
                        <input type="text" name="clean[social][twitter]" value="<?php echo $tplSettings->social['twitter']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-google-plus-square"></span></span>
                        <input type="text" name="clean[social][google-plus]" value="<?php echo $tplSettings->social['plus']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-linkedin-square"></span></span>
                        <input type="text" name="clean[social][linkedin]" value="<?php echo $tplSettings->social['linkedin']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-instagram"></span></span>
                        <input type="text" name="clean[social][instagram]" value="<?php echo $tplSettings->social['instagram']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-flickr"></span></span>
                        <input type="text" name="clean[social][flickr]" value="<?php echo $tplSettings->social['flickr']; ?>" class="form-control">
                    </div>
                </div>

                <!-- Header color -->
                <div class="form-group">

                    <div class="row">
                        <div class="col-sm-4">
                            <label><?php _e('Background color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_color]', $tplSettings->header_color != '' ? $tplSettings->header_color : 'f0f1ec' );
                            echo $color->render();
                            ?>
                        </div>

                        <div class="col-sm-4">
                            <label><?php _e('Text color one:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_text1]', $tplSettings->header_text1 != '' ? $tplSettings->header_text1 : '034b81' );
                            echo $color->render();
                            ?>
                        </div>

                        <div class="col-sm-4">
                            <label><?php _e('Text color two:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_text2]', $tplSettings->header_text2 != '' ? $tplSettings->header_text2 : '9bb649' );
                            echo $color->render();
                            ?>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Main content -->
            <div class="tab-pane" id="clean-main">

                <div class="form-group">
                    <label><?php _e('Headline:', 'clean'); ?></label>
                    <input type="text" class="form-control" name="clean[headline]" value="<?php echo $tplSettings->headline != '' ? $tplSettings->headline : __('Awesome pages, like never <span>has saw</span>', 'clean'); ?>">
                </div>

                <div class="form-group">
                    <label><?php _e('Introduction:', 'clean'); ?></label>
                    <textarea class="form-control" name="clean[intro]" rows="4"><?php echo $tplSettings->intro != '' ? $tplSettings->intro : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label><?php _e('Main Buttons', 'clean'); ?></label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php _e('Caption:', 'clean'); ?></span>
                                <input type="text" name="clean[main_button1_caption]" class="form-control" placeholder="<?php _e('Button caption', 'clean'); ?>" value="<?php echo $tplSettings->main_button1_caption != '' ? $tplSettings->main_button1_caption : __('Download Now!', 'clean'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php _e('Link:', 'clean'); ?></span>
                                <input type="text" name="clean[main_button1_link]" class="form-control" placeholder="<?php _e('Button link', 'clean'); ?>" value="<?php echo $tplSettings->main_button1_link != '' ? $tplSettings->main_button1_link : 'http://github.com/bitcero/qpages'; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php _e('Caption:', 'clean'); ?></span>
                                <input type="text" name="clean[main_button2_caption]" class="form-control" placeholder="<?php _e('Button caption', 'clean'); ?>" value="<?php echo $tplSettings->main_button2_caption != '' ? $tplSettings->main_button2_caption : __('Learn More', 'clean'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php _e('Link:', 'clean'); ?></span>
                                <input type="text" name="clean[main_button2_link]" class="form-control" placeholder="<?php _e('Button link', 'clean'); ?>" value="<?php echo $tplSettings->main_button2_link != '' ? $tplSettings->main_button2_link : 'http://github.com/bitcero/qpages'; ?>">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?php _e('Email:', 'clean'); ?></label>
                            <input type="text" name="clean[email]" class="form-control" value="<?php echo $tplSettings->email != '' ? $tplSettings->email : 'your@email.com'; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?php _e('Phone:', 'clean'); ?></label>
                            <input type="text" name="clean[phone]" class="form-control" value="<?php echo $tplSettings->phone != '' ? $tplSettings->phone : '1-800-548-5689'; ?>">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Forms options -->
            <div class="tab-pane" id="clean-forms">
                Opciones de formas
            </div>

        </div>

    </div>

</div>