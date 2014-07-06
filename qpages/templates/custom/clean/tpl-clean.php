<?php
/*
Name        = Clean Landing Page
Description = A landing page with a very clean style
Author      = "Eduardo Cortés"
Author URI  = http://eduardocortes.mx
Version     = 1.0
License     = GNU General Public License v2 or later
License URI = http://www.gnu.org/licenses/gpl-2.0.html
Standalone  = yes
*/
?>
<!DOCTYPE html>
<html lang="<?php echo $cuSettings->lang; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $page->description != '' ? $page->description : $page->excerpt; ?>">
    <meta name="author" content="">
    <title><?php echo $page->custom_title != '' ? $page->custom_title : $page->title; ?></title>
    <link href="<?php echo RMCURL; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo QPFunctions::dynamic_style( $page, 'clean', 'css/style.css' ); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo RMCURL; ?>/css/font-awesome.min.css" type="text/css">
    <link href='<?php echo $tplSettings->body_font; ?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo $tplSettings->em_font; ?>' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo XOOPS_URL; ?>/favicon.ico" type="image/x-icon" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top " role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#page-top">
                    <h1 class="logo-brand"><?php echo $tplSettings->logo_first; ?><span class="logo"><?php echo $tplSettings->logo_second; ?></span></h1>
                </a> </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="page-scroll social">
                        <?php foreach( $tplSettings->social as $name => $link ): if ( $link == '' ) continue; ?>
                        <a href="<?php echo $link; ?>">
                            <?php if( $name == 'instagram' || $name == 'flickr' ): ?>
                                <span class="fa fa-<?php echo $name; ?>"></span>
                            <?php else: ?>
                                <span class="fa fa-<?php echo $name; ?>-square"></span>
                            <?php endif; ?>
                        </a>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<section id="intro" class="intro-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 intro-caption">
                <h1 class="intro-title"><?php echo $tplSettings->headline; ?></h1>
                <p><?php echo $tplSettings->intro; ?></p>
                <div class="page-scroll">
                    <a class="btn btn-default btn-green" href="<?php echo $tplSettings->main_button1_link; ?>"><?php echo $tplSettings->main_button1_caption; ?></a>
                    <a class="btn btn-default btn-grey" href="<?php echo $tplSettings->main_button2_link; ?>"><?php echo $tplSettings->main_button2_caption; ?></a>
                </div>

                <hr class="divider">

                <p class="call-info"><?php echo $tplSettings->email; ?><?php if( $tplSettings->phone != '' ): ?>     |     <?php echo $tplSettings->phone; ?><?php endif; ?></p>
            </div>

            <div class="col-md-offset-1 col-md-4 intro-caption main-form">
                <?php echo $tplSettings->main_form; ?>
            </div>

        </div>
    </div>
</section>

<!-- SERVICES SECTION -->
<section id="services" class="services-section">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 block-title">
                <h1> <?php echo $tplSettings->services_headline; ?> </h1>
                <p> <?php echo $tplSettings->services_subh; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <?php foreach( $tplSettings->services as $service ): ?>
                    <div class="row green-icon">
                        <div class="col-md-2 feature-block"> <i class="<?php echo $service['icon']; ?> fa-4x"> </i> </div>
                        <div class="col-md-10">
                            <h2> <?php echo $service['title']; ?></h2>
                            <p> <?php echo $service['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="col-md-offset-1 col-md-4 testimonials">
                <div class="row">

                    <?php foreach( $tplSettings->testimonials as $customer ): ?>
                        <div class="col-md-12 testimonials-block"> <img src="<?php echo $customer['picture']; ?>" class="img-circle client-circle" alt="<?php echo $customer['name']; ?>">
                            <p> “<?php echo $customer['text']; ?>” </p>
                            <span> - <?php echo $customer['name']; ?> <a href="<?php echo $customer['link']; ?>"> ( <?php echo $customer['title']; ?> ) </a> </span> </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<section id="contact" class="contact-section">
    <div class="container newsletter">
        <div class="row">
            <div class="col-md-6">
                <h1> <?php echo $tplSettings->news['title']; ?></h1>
                <p> <?php echo $tplSettings->news['intro']; ?> </p>
            </div>
        </div>
        <div class="row">
            <?php echo $tplSettings->news['form']; ?>
        </div>
    </div>
</section>

<!-- VIDEO SECTION -->
<section id="video" class="video-section">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 block-title">
                <h1> <?php echo $tplSettings->video_headline; ?> </h1>
                <p> <?php echo $tplSettings->video_subh; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="video-wrapper">
                    <?php echo $tplSettings->video; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<div class="footer">
    <div class="container">
        <div class="row ft">
            <div class="col-md-9">
                <p> <?php echo $tplSettings->footercopy; ?> </p>
            </div>
            <div class="col-md-3">
                <?php foreach( $tplSettings->social as $name => $link ): if ( $link == '' ) continue; ?>
                    <a href="<?php echo $link; ?>">
                        <?php if( $name == 'instagram' || $name == 'flickr' ): ?>
                            <span class="fa fa-<?php echo $name; ?> social-icon"></span>
                        <?php else: ?>
                            <span class="fa fa-<?php echo $name; ?>-square social-icon"></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo RMCURL; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $tplSettings->url; ?>/js/jquery.easing.min.js"></script>
<script type="text/javascript">
    //jQuery to collapse the navbar on scroll
    $(window).scroll(function() {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $('.page-scroll a').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1000, 'easeInOutExpo');
            event.preventDefault();
        });
    });
</script>
</body>
</html>