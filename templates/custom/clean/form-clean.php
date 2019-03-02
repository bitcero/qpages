<?php
include('defaults.php');
?>
<div class="panel panel-light-blue">

    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-money"></span> <?php _e('Clean Landing Template Options', 'qpages'); ?></h3>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#clean-general" role="tab" data-toggle="tab"><?php _e('General', 'clean'); ?></a></li>
        <li><a href="#clean-header" role="tab" data-toggle="tab"><?php _e('Header', 'clean'); ?></a></li>
        <li><a href="#clean-main" role="tab" data-toggle="tab"><?php _e('Main Content', 'clean'); ?></a></li>
        <li><a href="#clean-services" role="tab" data-toggle="tab"><?php _e('Services', 'clean'); ?></a></li>
        <li><a href="#clean-video" role="tab" data-toggle="tab"><?php _e('Video', 'clean'); ?></a></li>
        <li><a href="#clean-news" role="tab" data-toggle="tab"><?php _e('Newsletter', 'clean'); ?></a></li>
        <li><a href="#clean-footer" role="tab" data-toggle="tab"><?php _e('Footer', 'clean'); ?></a></li>
    </ul>

    <div class="tab-content">

        <!-- General options -->
        <div class="tab-pane active" id="clean-general">
            <?php
            $font = new RMFormWebfonts('', 'clean[body_font]', $tplSettings->body_font);
            ?>
            <div class="form-group">
                <label><?php _e('Font for body:', 'clean'); ?></label>
                <?php echo $font->render(); ?>
            </div>
            <div class="form-group">
                <label><?php _e('Font family string for body:', 'clean'); ?></label>
                <input type="text" name="clean[body_ff]" data-rel="clean[body_font]" class="form-control" value="<?php echo $tplSettings->body_ff; ?>">
            </div>
            <?php
            $font = new RMFormWebfonts('', 'clean[em_font]', $tplSettings->em_font);
            ?>
            <div class="form-group">
                <label><?php _e('Font for emphasised text:', 'clean'); ?></label>
                <?php echo $font->render(); ?>
            </div>
            <div class="form-group">
                <label><?php _e('Font family string for emphasised text:', 'clean'); ?></label>
                <input type="text" name="clean[em_ff]" data-rel="clean[em_font]" class="form-control" value="<?php echo $tplSettings->em_ff; ?>">
            </div>

            <!-- Color scheme -->
            <div class="form-group">
                <label><?php _e('Color scheme:', 'clean'); ?></label>
                <div class="row">
                    <div class="col-sm-3">
                        <?php
                        $color = new RMFormColorSelector('', 'clean[color1]', $tplSettings->color1);
                        echo $color->render();
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                        $color = new RMFormColorSelector('', 'clean[color2]', $tplSettings->color2);
                        echo $color->render();
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                        $color = new RMFormColorSelector('', 'clean[color3]', $tplSettings->color3);
                        echo $color->render();
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                        $color = new RMFormColorSelector('', 'clean[color4]', $tplSettings->color4);
                        echo $color->render();
                        ?>
                    </div>
                </div>
            </div>

            <!-- General colors -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label><?php _e('Background color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[bgcolor]', $tplSettings->bgcolor);
                        echo $color->render();
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <label><?php _e('Sections background color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[seccolor]', $tplSettings->seccolor);
                        echo $color->render();
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <label><?php _e('Text color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[textcolor]', $tplSettings->textcolor);
                        echo $color->render();
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Background image:</label>
                <?php
                $image = new RMFormImageUrl('', 'clean[bgimage]', $tplSettings->bgimage);
                echo $image->render();
                ?>
            </div>

            <h4>Tracking Code</h4>
            <div class="form-group">
                <textarea name="clean[tracking]" class="form-control" rows="5"><?php echo $tplSettings->tracking; ?></textarea>
            </div>

        </div>

        <!-- Header options -->
        <div class="tab-pane" id="clean-header">

            <!-- Logo -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="logo-name"><?php _e('Name first word:', 'clean'); ?></label>
                        <input type="text" class="form-control" name="clean[logo_first]" id="logo-name" value="<?php echo $tplSettings->logo_first; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="logo-subname"><?php _e('Name second word:', 'clean'); ?></label>
                        <input type="text" class="form-control" name="clean[logo_second]" id="logo-subname" value="<?php echo $tplSettings->logo_second; ?>">
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
                    <div class="col-sm-3">
                        <label><?php _e('Background color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[header_color]', $tplSettings->header_color);
                        echo $color->render();
                        ?>
                    </div>

                    <div class="col-sm-3">
                        <label><?php _e('Paragraph text color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[header_text]', $tplSettings->header_text);
                        echo $color->render();
                        ?>
                    </div>

                    <div class="col-sm-3">
                        <label><?php _e('Text color one:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[header_text1]', $tplSettings->header_text1);
                        echo $color->render();
                        ?>
                    </div>

                    <div class="col-sm-3">
                        <label><?php _e('Text color two:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[header_text2]', $tplSettings->header_text2);
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
                <input type="text" class="form-control" name="clean[headline]" value="<?php echo $tplSettings->headline; ?>">
            </div>

            <div class="form-group">
                <label><?php _e('Introduction:', 'clean'); ?></label>
                <textarea class="form-control" name="clean[intro]" rows="4"><?php echo $tplSettings->intro; ?></textarea>
            </div>

            <div class="form-group">
                <label><?php _e('Main Buttons', 'clean'); ?></label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon"><?php _e('Caption:', 'clean'); ?></span>
                            <input type="text" name="clean[main_button1_caption]" class="form-control" placeholder="<?php _e('Button caption', 'clean'); ?>" value="<?php echo $tplSettings->main_button1_caption; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon"><?php _e('Link:', 'clean'); ?></span>
                            <input type="text" name="clean[main_button1_link]" class="form-control" placeholder="<?php _e('Button link', 'clean'); ?>" value="<?php echo $tplSettings->main_button1_link; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon"><?php _e('Caption:', 'clean'); ?></span>
                            <input type="text" name="clean[main_button2_caption]" class="form-control" placeholder="<?php _e('Button caption', 'clean'); ?>" value="<?php echo $tplSettings->main_button2_caption; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon"><?php _e('Link:', 'clean'); ?></span>
                            <input type="text" name="clean[main_button2_link]" class="form-control" placeholder="<?php _e('Button link', 'clean'); ?>" value="<?php echo $tplSettings->main_button2_link; ?>">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><?php _e('Email:', 'clean'); ?></label>
                        <input type="text" name="clean[email]" class="form-control" value="<?php echo $tplSettings->email; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><?php _e('Phone:', 'clean'); ?></label>
                        <input type="text" name="clean[phone]" class="form-control" value="<?php echo $tplSettings->phone; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><?php _e('Main form code:', 'clean'); ?></label>
                <textarea class="form-control" name="clean[main_form]" rows="4"><?php echo $tplSettings->main_form; ?></textarea>
            </div>

        </div>

        <!-- SERVICES OPTIONS -->
        <div class="tab-pane" id="clean-services">

            <!-- Headline -->
            <div class="form-group">
                <label><?php _e('Headline', 'clean'); ?></label>
                <input type="text" class="form-control" name="clean[services_headline]" value="<?php echo $tplSettings->services_headline; ?>">
            </div>


            <!-- Sub headline -->
            <div class="form-group">
                <label><?php _e('Sub headline', 'clean'); ?></label>
                <textarea class="form-control" name="clean[services_subh]" rows="3"><?php echo $tplSettings->services_subh; ?></textarea>
            </div>

            <!-- Service items -->
            <h4>Services</h4>
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">

                        <label><?php _e('Service One:', 'clean'); ?></label>
                        <input style="margin-bottom: 5px;" type="text" name="clean[services][0][title]" class="form-control" value="<?php echo $tplSettings->services[0]['title']; ?>">
                        <?php
                        $icon = new RMFormIconsPicker('', 'clean[services][0][icon]', array(
                            'selected' => $tplSettings->services[0]['icon'],
                            'glyphicons' => 0
                        ));
                        echo $icon->render();
                        ?>
                        <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][0][description]"><?php echo $tplSettings->services[0]['description']; ?></textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">

                        <label><?php _e('Service Two:', 'clean'); ?></label>
                        <input style="margin-bottom: 5px;" type="text" name="clean[services][1][title]" class="form-control" value="<?php echo $tplSettings->services[1]['title']; ?>">
                        <?php
                        $icon = new RMFormIconsPicker('', 'clean[services][1][icon]', array(
                            'selected' => $tplSettings->services[1]['icon'],
                            'glyphicons' => 0
                        ));
                        echo $icon->render();
                        ?>
                        <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][1][description]"><?php echo $tplSettings->services[1]['description']; ?></textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">

                        <label><?php _e('Service Three:', 'clean'); ?></label>
                        <input style="margin-bottom: 5px;" type="text" name="clean[services][2][title]" class="form-control" value="<?php echo $tplSettings->services[2]['title']; ?>">
                        <?php
                        $icon = new RMFormIconsPicker('', 'clean[services][2][icon]', array(
                            'selected' => $tplSettings->services[2]['icon'],
                            'glyphicons' => 0
                        ));
                        echo $icon->render();
                        ?>
                        <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][2][description]"><?php echo $tplSettings->services[2]['description']; ?></textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">

                        <label><?php _e('Service Four:', 'clean'); ?></label>
                        <input style="margin-bottom: 5px;" type="text" name="clean[services][3][title]" class="form-control" value="<?php echo $tplSettings->services[3]['title']; ?>">
                        <?php
                        $icon = new RMFormIconsPicker('', 'clean[services][3][icon]', array(
                            'selected' => $tplSettings->services[3]['icon'],
                            'glyphicons' => 0
                        ));
                        echo $icon->render();
                        ?>
                        <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][3][description]"><?php echo $tplSettings->services[3]['description']; ?></textarea>
                    </div>
                </div>

            </div>

            <!-- Testimonials -->
            <h4>Testimonials</h4>
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Customer name:</label>
                        <input type="text" name="clean[testimonials][0][name]" class="form-control" value="<?php echo $tplSettings->testimonials[0]['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Customer title:</label>
                        <input type="text" name="clean[testimonials][0][title]" class="form-control" value="<?php echo $tplSettings->testimonials[0]['title']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Customer picture:</label>
                        <?php
                        $img = new RMFormImageUrl('', 'clean[testimonials][0][picture]', $tplSettings->testimonials[0]['picture']);
                        echo $img->render();
                        ?>
                    </div>

                    <div class="form-group">
                        <label>Testimonial:</label>
                        <textarea rows="4" name="clean[testimonials][0][text]" class="form-control"><?php echo $tplSettings->testimonials[0]['text']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Customer link:</label>
                        <input type="text" name="clean[testimonials][0][link]" class="form-control" value="<?php echo $tplSettings->testimonials[0]['link']; ?>">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Customer name:</label>
                        <input type="text" name="clean[testimonials][1][name]" class="form-control" value="<?php echo $tplSettings->testimonials[1]['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Customer title:</label>
                        <input type="text" name="clean[testimonials][1][title]" class="form-control" value="<?php echo $tplSettings->testimonials[1]['title']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Customer picture:</label>
                        <?php
                        $img = new RMFormImageUrl('', 'clean[testimonials][1][picture]', $tplSettings->testimonials[1]['picture']);
                        echo $img->render();
                        ?>
                    </div>

                    <div class="form-group">
                        <label>Testimonial:</label>
                        <textarea rows="4" name="clean[testimonials][1][text]" class="form-control"><?php echo $tplSettings->testimonials[1]['text']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Customer link:</label>
                        <input type="text" name="clean[testimonials][1][link]" class="form-control" value="<?php echo $tplSettings->testimonials[1]['link']; ?>">
                    </div>
                </div>

            </div>

        </div>

        <!-- VIDEO SECTION -->
        <div class="tab-pane" id="clean-video">

            <!-- Headline -->
            <div class="form-group">
                <label><?php _e('Headline', 'clean'); ?></label>
                <input type="text" class="form-control" name="clean[video_headline]" value="<?php echo $tplSettings->video_headline; ?>">
            </div>


            <!-- Sub headline -->
            <div class="form-group">
                <label><?php _e('Sub headline', 'clean'); ?></label>
                <textarea class="form-control" name="clean[video_subh]" rows="3"><?php echo $tplSettings->video_subh; ?></textarea>
            </div>

            <!-- Video -->
            <div class="form-group">
                <label>Video:</label>
                <textarea class="form-control" rows="3" name="clean[video]"><?php echo $tplSettings->video; ?></textarea>
                    <span class="help-block">
                        This value must contain an iframe HTML code. Remove width and height values from iframe code. Add the <code>embed-responsive-item</code> class attribute to iframe.
                    </span>
            </div>

        </div>

        <!-- Forms options -->
        <div class="tab-pane" id="clean-news">
            <div class="form-group">
                <label>Headline:</label>
                <input type="text" class="form-control" name="clean[news][title]" value="<?php echo $tplSettings->news['title']; ?>">
            </div>

            <div class="form-group">
                <label>Introduction:</label>
                <textarea class="form-control" name="clean[news][intro]"><?php echo $tplSettings->news['intro']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Form code:</label>
                <textarea rows="4" class="form-control" name="clean[news][form]"><?php echo $tplSettings->news['form']; ?></textarea>
            </div>

        </div>

        <!-- Footer options -->
        <div class="tab-pane" id="clean-footer">
            <div class="form-group">

                <div class="row">
                    <div class="col-sm-6">
                        <label><?php _e('Background color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[footerbg]', $tplSettings->footerbg);
                        echo $color->render();
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <label><?php _e('Texto color:', 'clean'); ?></label>
                        <?php
                        $color = new RMFormColorSelector('', 'clean[footertext]', $tplSettings->footertext);
                        echo $color->render();
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Copyright line:</label>
                    <input type="text" class="form-control" name="clean[footercopy]" value="<?php echo $tplSettings->footercopy; ?>">
                </div>

            </div>
        </div>

    </div>

</div>
