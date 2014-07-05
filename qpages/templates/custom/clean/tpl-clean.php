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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Medical & health landing page templates for online appointment that help you to medical service & patient visit">
    <meta name="author" content="">
    <title>Wealth.life | Medical Landing Page Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo RMCURL; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo QPFunctions::dynamic_style( $page, 'clean', 'css/style.css' ); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo RMCURL; ?>/css/font-awesome.min.css" type="text/css">
    <link href='<?php echo $tplSettings->body_font; ?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo $tplSettings->em_font; ?>' rel='stylesheet' type='text/css'>
    <!-- your favicon icon link -->
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon" />
</head>
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top " role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#page-top">
                    <h1 class="logo-brand"><?php echo $tplSettings->logo_first; ?><span class="logo"><?php echo $tplSettings->logo_second; ?></span></h1>
                </a> </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
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
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</div>
<section id="intro" class="intro-section">
    <!-- intro start -->
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

            <div class="col-md-offset-1 col-md-4 intro-caption appoinment-form">
                <h2> Make an appointment today </h2>
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
                        <button type="submit" class="btn btn-block btn-orange btn-Submit">SUBMIT</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
<div class="client">
    <div class="container">
        <div class="row">
            <div class="client-logo">
                <div class="item col-md-3"><img src="image/logo-3.png" alt="client logo"></div>
                <div class="item col-md-3"><img src="image/logo-2.png" alt="client logo"></div>
                <div class="item col-md-3"><img src="image/logo-3.png" alt="client logo"></div>
                <div class="item col-md-3"><img src="image/logo-2.png" alt="client logo"></div>
            </div>
        </div>
    </div>
</div>
<!-- intro close -->
<section id="services" class="services-section">
    <!-- service start -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 block-title">
                <h1> Feature of Wealth Personal Care </h1>
                <p> Lorem ipsum dolor sit amet consectetur adipiscing elit uisque interdum ante eget faucibus mattistortor felis euismod nisl. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row green-icon">
                    <div class="col-md-2 feature-block"> <i class="fa fa-building-o fa-4x"> </i> </div>
                    <div class="col-md-10">
                        <h2> Patient clinic</h2>
                        <p> Lorem ipsum <strong>dolor sit amet consectetur adipiscing</strong> elite eget faucibus adipiscing elit uisque interdum ante istortor mattistormod nisl</p>
                    </div>
                </div>
                <div class="row green-icon">
                    <div class="col-md-2 feature-block"> <i class="fa fa-heart fa-4x"> </i> </div>
                    <div class="col-md-10">
                        <h2> Free medical advice</h2>
                        <p> Lorem ipsum <strong>dolor sit amet consectetur adipiscing</strong> elite eget faucibus adipiscing elit uisque interdum ante istortor mattistormod nisl</p>
                    </div>
                </div>
                <div class="row green-icon">
                    <div class="col-md-2 feature-block"> <i class="fa  fa-user-md  fa-4x"> </i> </div>
                    <div class="col-md-10">
                        <h2>Modern equipment</h2>
                        <p> Lorem ipsum <strong>dolor sit amet consectetur adipiscing</strong> elite eget faucibus adipiscing elit uisque interdum ante istortor mattistormod nisl</p>
                    </div>
                </div>
                <div class="row green-icon">
                    <div class="col-md-2 feature-block"> <i class="fa fa-ambulance fa-4x"> </i> </div>
                    <div class="col-md-10">
                        <h2>Modern equipment</h2>
                        <p> Lorem ipsum <strong>dolor sit amet consectetur adipiscing</strong> elite eget faucibus adipiscing elit uisque interdum ante istortor mattistormod nisl</p>
                    </div>
                </div>
            </div>
            <div class="col-md-offset-1 col-md-4 testimonials">
                <div class="row">
                    <div class="col-md-12 testimonials-block"> <img src="image/men.jpg" class="img-circle client-circle" alt="pic-4">
                        <p> “As a caretaker, I was unfamiliar with how Medicare works. The agent I spoke with helped me determine which plan would be best.” </p>
                        <span> - Brandon Feil <a href="#"> ( Patient ) </a> </span> </div>
                    <div class="col-md-12 testimonials-block"> <img src="image/grl.jpg" class="img-circle client-circle" alt="pic-4">
                        <p> “As a caretaker, I was unfamiliar with how Medicare works. The agent I spoke with helped me determine which plan would be best.” </p>
                        <span> - Brandon Feil <a href="#" title="John Doe"> ( Patient ) </a> </span> </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service close -->
<section id="video" class="video-section">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 block-title">
                <h1> Feature of Wealth Personal Care </h1>
                <p> Lorem ipsum dolor sit amet consectetur adipiscing elit uisque interdum ante eget faucibus mattistortor felis euismod nisl. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="video-wrapper">
                    <iframe width="650" height="345" src="http://player.vimeo.com/video/1084537"> </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="doctor" class="doctor-section">
    <!-- doctor section start -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 block-title">
                <h1>Meet the Wealth.life Specialists Doctors </h1>
                <p> Lorem ipsum dolor sit amet consectetur adipiscing elit uisquein.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 doctor-profile"> <div class="bg-profile"> <img src="image/team-3.png" alt=""></div>
                <h3> Dr. Rodney Stratton </h3>
                <strong>Physiotherapist     |      (985) 123-3410 </strong>
                <p> Sed tristique turpis a libero malesuada, tincidunt elementum mauris euismod. </p>
                <div class="social"> <a href="#"><i class="fa fa-facebook-square fa-size"> </i></a> <a href="#"><i class="fa fa-linkedin-square fa-size"> </i> </a> <a href="#"><i class="fa  fa-twitter-square fa-size"> </i> </a> </div>
            </div>
            <div class="col-md-4 doctor-profile">
                <div class="bg-profile"> <img src="image/team-1.png" alt=""></div>
                <h3> Robert Brown, Prof. </h3>
                <strong>Anesthesiologist    |    (985) 231-1234</strong>
                <p> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat </p>
                <div class="social"> <a href="#"><i class="fa fa-facebook-square fa-size"> </i></a> <a href="#"><i class="fa fa-linkedin-square fa-size"> </i> </a> <a href="#"><i class="fa  fa-twitter-square fa-size"> </i> </a> </div>
            </div>
            <div class="col-md-4 doctor-profile"> <div class="bg-profile"> <img src="image/team-2.png" alt=""></div>
                <h3> Dr. Lita White </h3>
                <strong> Neurosurgeon   |    (985) 231-1234</strong>
                <p> Maecenas commodo turpis adipiscing, malesuada ipsum in, molestie magna. </p>
                <div class="social"> <a href="#"><i class="fa fa-facebook-square fa-size"> </i></a> <a href="#"><i class="fa fa-linkedin-square fa-size"> </i> </a> <a href="#"><i class="fa  fa-twitter-square fa-size"> </i> </a> </div>
            </div>

        </div>
    </div>
</section>
<!-- doctor section close -->
<section id="contact" class="contact-section">
    <!-- contact section start -->
    <div class="container newsletter">
        <!-- newsletter section start -->
        <div class="row">
            <div class="col-md-6">
                <h1> Subscribe to our newsletter</h1>
                <p> Lorem ipsum dolor sit amet consectetur adipiscing elit uisque interdum ante eget faucibus mattistortor felis euismod nisl. </p>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-9">
                    <input type="text" class="form-control " id="news_email" placeholder="Email">
                </div>
                <div class="col-md-3"> <a href="javascript:void(o);" class="btn btn-default  btn-orange btn-submit" id="news_send">SUBSCRIBE NOW</a> </div>
            </div>
        </div>
    </div>
    <!-- newsletter section close -->
</section>
<!-- contact section close -->
<div class="footer">
    <!-- footer section start -->
    <div class="container">
        <div class="row ft">
            <div class="col-md-9">
                <p> © Copyright 2014. Anavigationll Rights Reserved by Wealth.life </p>
            </div>
            <div class="col-md-3"> <a href="#"> <i class="fa fa-facebook-square fa-2x social-icon"> </i></a><a href="#"> <i class="fa  fa-twitter-square  fa-2x social-icon"> </i> </a><a href="#"><i class="fa fa-google-plus-square fa-2x social-icon"> </i></a> <i class="fa fa-flickr  fa-2x social-icon"> </i> <a href="#"><i class="fa fa-pinterest-square fa-2x social-icon"> </i> </a></div>
        </div>
    </div>
</div>
<!-- footer section close -->
<!-- Core JavaScript Files -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/scrolling-nav.js"></script>

<!--====== Google Analytics Code
 Note :- Keep in mind that the string UA-XXXXXXXX-X should be replaced with your own Google Analytics account number.
-->

<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = 'https://ssl.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
<!--=====/Google Analytics Code====-->


</body>
</html>