<?php
// $Id: menu.php 421 2010-05-17 05:22:57Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

load_mod_locale('qpages');

$adminmenu = array();

$adminmenu[] = array(
    'title'     => __('Dashboard','qpages'),
    'link'      => "admin/index.php",
    'icon'      => '../images/status.png',
    'location'  => 'dashboard'
);

$adminmenu[] = array(
    'title'     => __('Categories','qpages'),
    'link'      => "admin/cats.php",
    'icon'      => '../images/cats.png',
    'location'  => 'categories'
);

$cat = RMHttpRequest::request( 'cat', 'integer', '' );

$options[] = array(
    'title'     => __('All pages','qpages'),
    'link'      => 'admin/pages.php?cat='.$cat,
    'selected'  => 'pages-list',
	'icon'      => '../images/pages-16.png'
);

$options[] = array(
    'title'     => __('Published','qpages'),
    'link'      => 'admin/pages.php?public=1&cat='.$cat,
    'selected'  => 'pages-public',
	'icon'      => '../images/public-16.png'
);

$options[] = array(
    'title'     => __('Drafts','qpages'),
    'link'      => 'admin/pages.php?public=0&cat='.$cat,
    'selected'  => 'pages-draft',
	'icon'      => '../images/drafts-16.png'
);

$options[] = array(
	'title'     => __('Normal Pages','qpages'),
	'link'      => 'admin/pages.php?type=normal&cat='.$cat,
	'selected'  => 'pages-normal',
	'icon'  => '../images/page-.png',
);

$options[] = array(
	'title'     => __('Redirection Pages','qpages'),
	'link'      => 'admin/pages.php?type=redir&cat='.$cat,
	'selected'  => 'pages-redir',
	'icon'  => '../images/page-redir.png',
);

$options[] = array(
    'title'     => __('Add page','qpages'),
    'link'      => 'admin/pages.php?action=new&cat='.$cat,
    'selected'  => 'pages-new',
	'icon'      => '../images/add-16.png'
);

$adminmenu[] = array(
    'title'     => __('Pages','qpages'),
    'link'      => "admin/pages.php",
    'icon'      => '../images/pages-16.png',
    'location'  => 'pages',
    'options'   => $options
);

$adminmenu[] = array(
    'title'     => __('Library', 'rmcommon'),
    'link'      => 'admin/library.php',
    'icon'      => RMUris::image( 'qpages', 'library.png' ),
    'location'  => 'library'
);
