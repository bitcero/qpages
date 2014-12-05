<?php
/**
 * QuickPages for XOOPS
 * A module that allows to publish and manage pages in XOOPS
 * 
 * Copyright © 2009 - 2014 Eduardo Cortés
 * -----------------------------------------------------------------
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * -----------------------------------------------------------------
 * @package      QuickPages
 * @author       Eduardo Cortés <i.bitcero@gmail.com>
 * @copyright    2009 - 2014 Eduardo Cortés
 * @license      GPL v2
 * @link         http://eduardocortes.mx
 */

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
