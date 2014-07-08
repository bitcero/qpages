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
            <li><a href="#clean-services" role="tab" data-toggle="tab"><?php _e('Services', 'clean'); ?></a></li>
            <li><a href="#clean-video" role="tab" data-toggle="tab"><?php _e('Video', 'clean'); ?></a></li>
            <li><a href="#clean-news" role="tab" data-toggle="tab"><?php _e('Newsletter', 'clean'); ?></a></li>
            <li><a href="#clean-footer" role="tab" data-toggle="tab"><?php _e('Footer', 'clean'); ?></a></li>
        </ul>

        <div class="tab-content">

            <!-- General options -->
            <div class="tab-pane active" id="clean-general">
                <?php
                echo $tplSettings->body_font;
                $font = new RMFormWebfonts('', 'clean[body_font]', $tplSettings->body_font );
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
                $font = new RMFormWebfonts('', 'clean[em_font]', $tplSettings->em_font );
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
                            $color = new RMFormColorSelector( '', 'clean[color1]', $tplSettings->color1 != '' ? $tplSettings->color1 : '082e66' );
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[color2]', $tplSettings->color2 != '' ? $tplSettings->color2 : '0da831' );
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[color3]', $tplSettings->color3 != '' ? $tplSettings->color3 : 'f06b24' );
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

                <!-- General colors -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label><?php _e('Background color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector('', 'clean[bgcolor]', $tplSettings->bgcolor != '' ? $tplSettings->bgcolor : 'FFFFFF');
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <label><?php _e('Sections background color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector('', 'clean[seccolor]', $tplSettings->seccolor != '' ? $tplSettings->seccolor : 'f9faf6');
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <label><?php _e('Text color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector('', 'clean[textcolor]', $tplSettings->textcolor != '' ? $tplSettings->textcolor : '72736e');
                            echo $color->render();
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Background image:</label>
                    <?php
                    $image = new RMFormImageUrl('', 'clean[bgimage]', $tplSettings->bgimage != '' ? $tplSettings->bgimage : '');
                    echo $image->render();
                    ?>
                </div>

                <h4>Tracking Code</h4>
                <div class="form-group">
                    <textarea name="clean[tracking]" class="form-control" rows="5"><?php echo $tplSettings->tracking != '' ? $tplSettings->tracking : ''; ?></textarea>
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
                        <div class="col-sm-3">
                            <label><?php _e('Background color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_color]', $tplSettings->header_color != '' ? $tplSettings->header_color : '02070a' );
                            echo $color->render();
                            ?>
                        </div>

                        <div class="col-sm-3">
                            <label><?php _e('Paragraph text color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_text]', $tplSettings->header_text != '' ? $tplSettings->header_text : '5c9dcc' );
                            echo $color->render();
                            ?>
                        </div>

                        <div class="col-sm-3">
                            <label><?php _e('Text color one:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_text1]', $tplSettings->header_text1 != '' ? $tplSettings->header_text1 : '00d982' );
                            echo $color->render();
                            ?>
                        </div>

                        <div class="col-sm-3">
                            <label><?php _e('Text color two:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[header_text2]', $tplSettings->header_text2 != '' ? $tplSettings->header_text2 : 'ffffff' );
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
                    <input type="text" class="form-control" name="clean[headline]" value="<?php echo $tplSettings->headline != '' ? $tplSettings->headline : __('Awesome and quick pages, like never <span>has seen</span>', 'clean'); ?>">
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

                <div class="form-group">
                    <label><?php _e('Main form code:', 'clean'); ?></label>
                    <textarea class="form-control" name="clean[main_form]" rows="4"><?php if ($tplSettings->main_form != ''): ?><?php echo $tplSettings->main_form; ?><?php else: ?>&lt;h2&gt; Request more information &lt;/h2&gt;
&lt;div class=&quot;&quot;&gt;
&lt;form role=&quot;form&quot;&gt;
&lt;div class=&quot;form-group&quot;&gt;
&lt;label for=&quot;exampleInputName&quot;&gt;Name&lt;/label&gt;
&lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;exampleInputName&quot; placeholder=&quot;Name&quot; required&gt;
&lt;/div&gt;
&lt;div class=&quot;form-group&quot;&gt;
&lt;label for=&quot;exampleInputEmail1&quot;&gt;E-mail&lt;/label&gt;
&lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;exampleInputEmail1&quot; placeholder=&quot;E-mail&quot; required&gt;
&lt;/div&gt;
&lt;div class=&quot;form-group&quot;&gt;
&lt;label for=&quot;exampleInputPassword1&quot;&gt;Phone&lt;/label&gt;
&lt;input type=&quot;password&quot; class=&quot;form-control&quot; id=&quot;exampleInputPassword1&quot; placeholder=&quot;Phone&quot;&gt;
&lt;/div&gt;
&lt;button type=&quot;submit&quot; class=&quot;btn btn-block btn-orange btn-Submit&quot;&gt;REQUEST NOW&lt;/button&gt;
&lt;/form&gt;
&lt;/div&gt;<?php endif; ?></textarea>
                </div>

            </div>

            <!-- SERVICES OPTIONS -->
            <div class="tab-pane" id="clean-services">

                <!-- Headline -->
                <div class="form-group">
                    <label><?php _e('Headline', 'clean'); ?></label>
                    <input type="text" class="form-control" name="clean[services_headline]" value="<?php echo $tplSettings->services_headline != '' ? $tplSettings->services_headline : 'Ideal for business and personal pages'; ?>">
                </div>


                <!-- Sub headline -->
                <div class="form-group">
                    <label><?php _e('Sub headline', 'clean'); ?></label>
                    <textarea class="form-control" name="clean[services_subh]" rows="3"><?php echo $tplSettings->services_subh != '' ? $tplSettings->services_subh : 'Quisque mattis ante a dui posuere, eget vehicula nibh rhoncus. Nam ac erat mauris. Nulla venenatis, metus non lobortis porttitor, ante diam molestie sem, vel adipiscing tellus neque viverra neque.'; ?></textarea>
                </div>

                <!-- Service items -->
                <h4>Services</h4>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">

                            <label><?php _e('Service One:','clean'); ?></label>
                            <input style="margin-bottom: 5px;" type="text" name="clean[services][0][title]" class="form-control" value="<?php echo $tplSettings->services[0]['title'] != '' ? $tplSettings->services[0]['title'] : 'Templates for pages'; ?>">
                            <?php
                            $icon = new RMFormIconsPicker('', 'clean[services][0][icon]', array(
                                'selected' => $tplSettings->services[0]['icon'] != '' ? $tplSettings->services[0]['icon'] : 'fa fa-heart',
                                'glyphicons' => 0
                            ));
                            echo $icon->render();
                            ?>
                            <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][0][description]"><?php if ( $tplSettings->services[0]['description'] != '' ): ?><?php echo $tplSettings->services[0]['description']; ?><?php else: ?>Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.<?php endif; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label><?php _e('Service Two:','clean'); ?></label>
                            <input style="margin-bottom: 5px;" type="text" name="clean[services][1][title]" class="form-control" value="<?php echo $tplSettings->services[1]['title'] != '' ? $tplSettings->services[1]['title'] : 'Landing Pages'; ?>">
                            <?php
                            $icon = new RMFormIconsPicker('', 'clean[services][1][icon]', array(
                                'selected' => $tplSettings->services[1]['icon'] != '' ? $tplSettings->services[1]['icon'] : 'fa fa-anchor',
                                'glyphicons' => 0
                            ));
                            echo $icon->render();
                            ?>
                            <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][1][description]"><?php if ( $tplSettings->services[1]['description'] != '' ): ?><?php echo $tplSettings->services[1]['description']; ?><?php else: ?>Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.<?php endif; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label><?php _e('Service Three:','clean'); ?></label>
                            <input style="margin-bottom: 5px;" type="text" name="clean[services][2][title]" class="form-control" value="<?php echo $tplSettings->services[2]['title'] != '' ? $tplSettings->services[2]['title'] : 'Custom URLs'; ?>">
                            <?php
                            $icon = new RMFormIconsPicker('', 'clean[services][2][icon]', array(
                                'selected' => $tplSettings->services[2]['icon'] != '' ? $tplSettings->services[2]['icon'] : 'fa fa-link',
                                'glyphicons' => 0
                            ));
                            echo $icon->render();
                            ?>
                            <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][2][description]"><?php if ( $tplSettings->services[2]['description'] != '' ): ?><?php echo $tplSettings->services[2]['description']; ?><?php else: ?>Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.<?php endif; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label><?php _e('Service Four:','clean'); ?></label>
                            <input style="margin-bottom: 5px;" type="text" name="clean[services][3][title]" class="form-control" value="<?php echo $tplSettings->services[3]['title'] != '' ? $tplSettings->services[3]['title'] : 'Embed or Standalone Pages'; ?>">
                            <?php
                            $icon = new RMFormIconsPicker('', 'clean[services][3][icon]', array(
                                'selected' => $tplSettings->services[3]['icon'] != '' ? $tplSettings->services[3]['icon'] : 'fa fa-thumb-tack',
                                'glyphicons' => 0
                            ));
                            echo $icon->render();
                            ?>
                            <textarea rows="4" style="margin-top: 5px;" class="form-control" name="clean[services][3][description]"><?php if ( $tplSettings->services[3]['description'] != '' ): ?><?php echo $tplSettings->services[3]['description']; ?><?php else: ?>Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.<?php endif; ?></textarea>
                        </div>
                    </div>

                </div>

                <!-- Testimonials -->
                <h4>Testimonials</h4>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Customer name:</label>
                            <input type="text" name="clean[testimonials][0][name]" class="form-control" value="<?php echo $tplSettings->testimonials[0]['name'] != '' ? $tplSettings->testimonials[0]['name'] : 'John Doe'; ?>">
                        </div>

                        <div class="form-group">
                            <label>Customer title:</label>
                            <input type="text" name="clean[testimonials][0][title]" class="form-control" value="<?php echo $tplSettings->testimonials[0]['title'] != '' ? $tplSettings->testimonials[0]['title'] : 'customer'; ?>">
                        </div>

                        <div class="form-group">
                            <label>Customer picture:</label>
                            <?php
                            $img = new RMFormImageUrl('', 'clean[testimonials][0][picture]', $tplSettings->testimonials[0]['picture'] != '' ? $tplSettings->testimonials[0]['picture'] : $tplSettings->url . '/images/customer.png');
                            echo $img->render();
                            ?>
                        </div>

                        <div class="form-group">
                            <label>Testimonial:</label>
                            <textarea rows="4" name="clean[testimonials][0][text]" class="form-control"><?php echo $tplSettings->testimonials[0]['text'] != '' ? $tplSettings->testimonials[0]['text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat magna dapibus augue tincidunt, nec ultrices sapien vestibulum.'; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Customer link:</label>
                            <input type="text" name="clean[testimonials][0][link]" class="form-control" value="<?php echo $tplSettings->testimonials[0]['link'] != '' ? $tplSettings->testimonials[0]['link'] : '#'; ?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Customer name:</label>
                            <input type="text" name="clean[testimonials][1][name]" class="form-control" value="<?php echo $tplSettings->testimonials[1]['name'] != '' ? $tplSettings->testimonials[1]['name'] : 'John Doe'; ?>">
                        </div>

                        <div class="form-group">
                            <label>Customer title:</label>
                            <input type="text" name="clean[testimonials][1][title]" class="form-control" value="<?php echo $tplSettings->testimonials[1]['title'] != '' ? $tplSettings->testimonials[1]['title'] : 'customer'; ?>">
                        </div>

                        <div class="form-group">
                            <label>Customer picture:</label>
                            <?php
                            $img = new RMFormImageUrl('', 'clean[testimonials][1][picture]', $tplSettings->testimonials[1]['picture'] != '' ? $tplSettings->testimonials[1]['picture'] : $tplSettings->url . '/images/customer.png');
                            echo $img->render();
                            ?>
                        </div>

                        <div class="form-group">
                            <label>Testimonial:</label>
                            <textarea rows="4" name="clean[testimonials][1][text]" class="form-control"><?php echo $tplSettings->testimonials[1]['text'] != '' ? $tplSettings->testimonials[1]['text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat magna dapibus augue tincidunt, nec ultrices sapien vestibulum.'; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Customer link:</label>
                            <input type="text" name="clean[testimonials][1][link]" class="form-control" value="<?php echo $tplSettings->testimonials[1]['link'] != '' ? $tplSettings->testimonials[1]['link'] : '#'; ?>">
                        </div>
                    </div>

                </div>

            </div>

            <!-- VIDEO SECTION -->
            <div class="tab-pane" id="clean-video">

                <!-- Headline -->
                <div class="form-group">
                    <label><?php _e('Headline', 'clean'); ?></label>
                    <input type="text" class="form-control" name="clean[video_headline]" value="<?php echo $tplSettings->video_headline != '' ? $tplSettings->video_headline : 'Like no other module'; ?>">
                </div>


                <!-- Sub headline -->
                <div class="form-group">
                    <label><?php _e('Sub headline', 'clean'); ?></label>
                    <textarea class="form-control" name="clean[video_subh]" rows="3"><?php echo $tplSettings->video_subh != '' ? $tplSettings->video_subh : 'Quisque mattis ante a dui posuere, eget vehicula nibh rhoncus. Nam ac erat mauris. Nulla venenatis, metus non lobortis porttitor, ante diam molestie sem, vel adipiscing tellus neque viverra neque.'; ?></textarea>
                </div>

                <!-- Video -->
                <div class="form-group">
                    <label>Video:</label>
                    <textarea class="form-control" rows="3" name="clean[video]"><?php echo $tplSettings->video != '' ? $tplSettings->video : '<iframe class="embed-responsive-item" src="//www.youtube.com/embed/3cotY5aVZMc?rel=0" frameborder="0" allowfullscreen></iframe>'; ?></textarea>
                    <span class="help-block">
                        This value must contain an iframe HTML code. Remove width and height values from iframe code. Add the <code>embed-responsive-item</code> class attribute to iframe.
                    </span>
                </div>

            </div>

            <!-- Forms options -->
            <div class="tab-pane" id="clean-news">
                <div class="form-group">
                    <label>Headline:</label>
                    <input type="text" class="form-control" name="clean[news][title]" value="<?php echo $tplSettings->news['title'] != '' ? $tplSettings->news['title'] : 'Suscribe to our newsletter'; ?>">
                </div>

                <div class="form-group">
                    <label>Introduction:</label>
                    <textarea class="form-control" name="clean[news][intro]"><?php if( $tplSettings->news['intro'] != '' ): ?><?php echo $tplSettings->news['intro']; ?><?php else: ?>Vestibulum luctus ante vel faucibus congue. Mauris dolor turpis, dapibus ut nisi sit amet, rhoncus vestibulum mauris. Suspendisse in quam lorem.<?php endif; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Form code:</label>
                    <textarea rows="4" class="form-control" name="clean[news][form]"><?php if ( $tplSettings->news['form'] != '' ): ?>
                        <?php echo $tplSettings->news['form']; ?>
                        <?php else: ?>
&lt;div class=&quot;form-group&quot;&gt;
&lt;div class=&quot;col-md-9&quot;&gt;
&lt;input type=&quot;text&quot; class=&quot;form-control &quot; id=&quot;news_email&quot; placeholder=&quot;Email&quot;&gt;
&lt;/div&gt;
&lt;div class=&quot;col-md-3&quot;&gt; &lt;a href=&quot;javascript:void(o);&quot; class=&quot;btn btn-default  btn-orange btn-submit&quot; id=&quot;news_send&quot;&gt;SUBSCRIBE NOW&lt;/a&gt; &lt;/div&gt;
&lt;/div&gt;<?php endif; ?>
                    </textarea>
                </div>

            </div>

            <!-- Footer options -->
            <div class="tab-pane" id="clean-footer">
                <div class="form-group">

                    <div class="row">
                        <div class="col-sm-6">
                            <label><?php _e('Background color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[footerbg]', $tplSettings->footerbg != '' ? $tplSettings->footerbg : '303335' );
                            echo $color->render();
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <label><?php _e('Texto color:', 'clean'); ?></label>
                            <?php
                            $color = new RMFormColorSelector( '', 'clean[footertext]', $tplSettings->footertext != '' ? $tplSettings->footertext : '797c7e' );
                            echo $color->render();
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Copyright line:</label>
                        <input type="text" class="form-control" name="clean[footercopy]" value="<?php echo $tplSettings->footercopy != '' ? $tplSettings->footercopy : '&copy; Copyright 2014. All rights reserved by you.'; ?>">
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>