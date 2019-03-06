<?php

$defaults = [
    'body_font'            => 'http://fonts.googleapis.com/css?family=Asap:400,700',
    'body_ff'              => "'Asap', sans-serif",
    'em_font'              => 'http://fonts.googleapis.com/css?family=Pacifico',
    'em_ff'                => "'Pacifico', cursive",
    'color1'               => '082e66',
    'color2'               => '0da831',
    'color3'               => 'f06b24',
    'color4'               => 'afb0ad',
    'bgcolor'              => 'FFFFFF',
    'seccolor'             => 'f9faf6',
    'textcolor'            => '72736e',
    'bgimage'              => '',
    'tracking'             => '',
    'logo_first'           => 'Awesome',
    'logo_second'          => 'Site',
    'social'               => [
        'facebook'  => '',
        'twitter'   => '',
        'plus'      => '',
        'linkedin'  => '',
        'instagram' => '',
        'flickr'    => '',
    ],
    'header_color'         => '02070a',
    'header_text'          => '5c9dcc',
    'header_text1'         => '00d982',
    'header_text2'         => 'ffffff',
    'headline'             => __('Awesome and quick pages, like never <span>has seen</span>', 'clean'),
    'intro'                => '',
    'main_button1_caption' => __('Download Now!', 'clean'),
    'main_button1_link'    => 'http://github.com/bitcero/qpages',
    'main_button2_caption' => __('Learn More', 'clean'),
    'main_button2_link'    => '#services',
    'email'                => 'your@email.com',
    'phone'                => '1-800-548-5689',
    'main_form'            => '<h2> Request more information </h2>
<div class="">
<form role="form">
<div class="form-group">
<label for="exampleInputName">Name</label>
<input type="text" class="form-control" id="exampleInputName" placeholder="Name" required>
</div>
<div class="form-group">
<label for="exampleInputEmail1">E-mail</label>
<input type="text" class="form-control" id="exampleInputEmail1" placeholder="E-mail" required>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Phone</label>
<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Phone">
</div>
<button type="submit" class="btn btn-block btn-orange btn-Submit">REQUEST NOW</button>
</form>
</div>',
    'services_headline'    => 'Ideal for business and personal pages',
    'services_subh'        => 'Quisque mattis ante a dui posuere, eget vehicula nibh rhoncus. Nam ac erat mauris. Nulla venenatis, metus non lobortis porttitor, ante diam molestie sem, vel adipiscing tellus neque viverra neque.',
    'services'             => [
        [
            'title'       => 'Templates for pages',
            'icon'        => 'fa fa-heart',
            'description' => 'Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.',
        ],
        [
            'title'       => 'Landing Pages',
            'icon'        => 'fa fa-anchor',
            'description' => 'Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.',
        ],
        [
            'title'       => 'Custom URLs',
            'icon'        => 'fa fa-link',
            'description' => 'Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.',
        ],
        [
            'title'       => 'Embed or Standalone Pages',
            'icon'        => 'fa fa-thumb-tack',
            'description' => 'Nulla tristique rhoncus ante, vitae rutrum orci interdum non. Vivamus eu nibh eget ligula malesuada rhoncus. Sed convallis lorem vel ligula sodales laoreet.',
        ],
    ],
    'testimonials'         => [
        [
            'name'    => 'John Doe',
            'title'   => 'customer',
            'picture' => $template->url . '/images/customer.png',
            'text'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat magna dapibus augue tincidunt, nec ultrices sapien vestibulum.',
            'link'    => '#',
        ],
        [
            'name'    => 'John Doe',
            'title'   => 'customer',
            'picture' => $template->url . '/images/customer.png',
            'text'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat magna dapibus augue tincidunt, nec ultrices sapien vestibulum.',
            'link'    => '#',
        ],
    ],
    'video_headline'       => 'Like no other module',
    'video_subh'           => 'Quisque mattis ante a dui posuere, eget vehicula nibh rhoncus. Nam ac erat mauris. Nulla venenatis, metus non lobortis porttitor, ante diam molestie sem, vel adipiscing tellus neque viverra neque.',
    'video'                => '<iframe class="embed-responsive-item" src="//www.youtube.com/embed/btJinlqSGrA?rel=0" frameborder="0" allowfullscreen></iframe>',
    'news'                 => [
        'title' => 'Suscribe to our newsletter',
        'intro' => 'Vestibulum luctus ante vel faucibus congue. Mauris dolor turpis, dapibus ut nisi sit amet, rhoncus vestibulum mauris. Suspendisse in quam lorem.',
        'form'  => '<div class="form-group">
<div class="col-md-9">
<input type="text" class="form-control " id="news_email" placeholder="Email">
</div>
<div class="col-md-3"> <a href="javascript:void(o);" class="btn btn-default  btn-orange btn-submit" id="news_send">SUBSCRIBE NOW</a> </div>
</div>'
    ],
    'footerbg'             => '303335',
    'footertext'           => '797c7e',
    'footercopy'           => '&copy; Copyright 2019. All rights reserved by you.',
];
QPFunctions::load_defaults($tplSettings, $defaults);
