<?php
$defaults = array(
    'bg'        => $tplSettings->url . '/images/bg.png',
    'logo'      => $tplSettings->url . '/images/logo.png',
    'bgmode'    => 'tiled',
    'links'     => '<a href="#">Menu 1</a>' . "\n" .'<a href="#">Menu 2</a>' . "\n" . '<a href="#">Menu 3</a>' . "\n" .  '<a href="#">Menu 4</a>',
    'heading'   => 'http://fonts.googleapis.com/css?family=Jockey+One',
    'headingff' => "'Jockey One', sans-serif",
    'body'      => 'http://fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic',
    'bodyff'    => "'Roboto', sans-serif",
    'color'     => '49BBCC',
    'copy'      => '&copy; Your Site 2014.'
);
QPFunctions::load_defaults( $tplSettings, $defaults );