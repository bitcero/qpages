<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <me@eduardocortes.mx>
// Email: me@eduardocortes.mx
// License: GPL 2.0
// --------------------------------------------------------------

$modversion = array(

    // General
    'name'          => 'Quick Pages',
    'description'   => __('Publish and manage single pages','qpages'),
    'version'       => 2,
    'license'       => 'GPL 2',
    'dirname'       => 'qpages',
    'official'      => 0,
    'onUpdate'      => 'include/update.php',

    // Common Utilities
    'rmnative'      => 1,
    'rmversion'     => array(
        'major'     => 2,
        'minor'     => 0,
        'revision'  => 36,
        'stage'     => -1,
        'name'      => 'Quick Pages'
    ),
    'rewrite'       => 0,
    'updateurl'     => "http://www.xoopsmexico.net/modules/vcontrol/",
    'help'          => 'docs/readme.html',

    // Author information
    'author'        => "Eduardo Cortes",
    'authormail'    => "me@eduardocortes.mx",
    'authorweb'     => "EduardoCortes.mx",
    'authorurl'     => "http://eduardocortes.mx",
    'credits'       => "Eduardo Cortes",

    // Logo and icons
    'image'         => "images/logo.png",
    'icon16'        => "images/qpages-16.png",
    'icon24'        => 'images/qpages-24.png',
    'icon32'        => 'images/qpages-32.png',
    'icon48'        => "images/qpages-48.png",

    // Social
    'social'        => array(
            array(
                'title' => 'Twitter',
                'type'  => 'twitter-square',
                'url'   => 'http://www.twitter.com/bitcero/'
            ),
            array(
                'title' => 'Facebook',
                'type'  => 'facebook-square',
                'url'   => 'http://www.facebook.com/eduardo.cortes.hervis/'
            ),
            array(
                'title' => 'Instagram',
                'type'  => 'instagram',
                'url'   => 'http://www.instagram.com/eduardocortesh/'
            ),
            array(
                'title' => 'LinkedIn',
                'type'  => 'linkedin-square',
                'url'   => 'http://www.linkedin.com/in/bitcero/'
            ),
            array(
                'title' => 'GitHub',
                'type'  => 'github',
                'url'   => 'http://www.github.com/bitcero/'
            ),
            array(
                'title' => __('My Blog', 'qpages'),
                'type'  => 'quote-left',
                'url'   => 'http://eduardocortes.mx'
            ),
    ),

    // Backend
    'hasAdmin'      => 1,
    'adminindex'    => "admin/index.php",
    'adminmenu'     => "admin/menu.php",

    // Front End
    'hasMain'       => 1,

    // SQL file
    'sqlfile'       => array( 'mysql' => "sql/mysql.sql" ),

    // Database tables
    'tables'        => array(
        'mod_qpages_pages',
        'mod_qpages_categos',
        'mod_qpages_meta'
    ),

    // Smarty templates
    'templates'     => array(
        array(
            'file'          => 'qpages_index.html',
            'description'   => __('Quick Pages home template', 'qpages')
        ),
        array(
            'file'          => 'qpages_categos.html',
            'description'   => __('Template to show pages categories', 'qpages')
        ),
        array(
            'file'          => 'qpages_page.html',
            'description'   => __('Display all the page content', 'qpages')
        ),
        array(
            'file'          => 'qpages_homepage.html',
            'descritpion'   => __('Show the homepage content', 'qpages')
        )
    ),

    // Search
    'hasSearch'     => 1,
    'search'        => array(
        'file'      => 'include/search.functions.php',
        'func'      => 'qpages_search'
    ),

    // Blocks
    'blocks'        => array(
        # Categories
        array(
            'file'          => 'qpages_blocks.php',
            'name'          => __('Categories', 'qpages'),
            'description'   => __('Display a block with categories list', 'qpages'),
            'show_func'     => 'qpages_block_categories',
            'edit_func'     => '',
            'template'      => 'qpages_bk_categories.html'
        ),
        # Pages
        array(
            'file'          => 'qpages_blocks.php',
            'name'          => __('Pages', 'qpages'),
            'description'   => __('Display a block with pages list', 'qpages'),
            'show_func'     => 'qpages_block_pages',
            'edit_func'     => 'qpages_block_pages_edit',
            'template'      => 'qpages_bk_pages.html'
        )
    ),

    // Settings
    'config'        => array(

        #·· Permalinks
        array(
            'name'          => 'permalinks',
            'title'         => __('Enable permalinks', 'qpages'),
            'description'   => __('This option activate/deactivate friendly URLs for pages and categories', 'qpages'),
            'formtype'      => 'yesno',
            'valuetype'     => 'int',
            'default'       => 0
        ),

        #·· Base path for permalinks
        array(
            'name'          => 'basepath',
            'title'         => __('Base path for URL', 'qpages'),
            'description'   => __('Stablish the base path to use in friendly URLs.', 'qpages'),
            'formtype'      => 'textbox',
            'valuetype'     => 'text',
            'default'       => '/pages'
        ),

        #·· Related pages
        array(
            'name'          => 'related',
            'title'         => __('Show related pages','qpages'),
            'description'   => __('Enable the "Related Pages" block when a page is visited.','qpages'),
            'formtype'      => 'yesno',
            'valuetype'     => 'int',
            'default'       => 1
        ),

        #·· Related pages
        array(
            'name'          => 'related_num',
            'title'         => __('Number of related pages','qpages'),
            'description'   => '',
            'formtype'      => 'textbox',
            'valuetype'     => 'int',
            'default'       => 5
        )

    ),

    // Subpages
    'subpages'      => array(
        'index'     => __('Homepage', 'qpages'),
        'catego'    => __('Category', 'qpages'),
        'page'      => __('Page content', 'qpages')
    )

);
