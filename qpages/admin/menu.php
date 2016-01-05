<?php
/**
 * QuickPages for Xoops
 *
 * Copyright © 2015 Eduardo Cortés http://www.redmexico.com.mx
 * -------------------------------------------------------------
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
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * -------------------------------------------------------------
 * @copyright    Eduardo Cortés (http://www.redmexico.com.mx)
 * @license      GNU GPL 2
 * @package      qpages
 * @author       Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 * @url          http://www.redmexico.com.mx
 * @url          http://www.eduardocortes.mx
 */

load_mod_locale('qpages');

$adminmenu = array();

$adminmenu[] = array(
    'title'     => __('Dashboard','qpages'),
    'link'      => "admin/index.php",
    'icon'      => 'svg-rmcommon-dashboard text-midnight',
    'location'  => 'dashboard'
);

$adminmenu[] = array(
    'title'     => __('Categories','qpages'),
    'link'      => "admin/cats.php",
    'icon'      => 'svg-rmcommon-folder text-orange',
    'location'  => 'categories'
);

$cat = RMHttpRequest::request( 'cat', 'integer', '' );

$options[] = array(
    'title'     => __('All pages','qpages'),
    'link'      => 'admin/pages.php?cat='.$cat,
    'selected'  => 'pages-list',
	'icon'      => 'svg-rmcommon-docs text-blue'
);

$options[] = array(
    'title'     => __('Published','qpages'),
    'link'      => 'admin/pages.php?public=1&cat='.$cat,
    'selected'  => 'pages-public',
	'icon'      => 'svg-rmcommon-send text-blue-grey'
);

$options[] = array(
    'title'     => __('Drafts','qpages'),
    'link'      => 'admin/pages.php?public=0&cat='.$cat,
    'selected'  => 'pages-draft',
	'icon'      => 'svg-rmcommon-document text-danger'
);

$options[] = array(
	'title'     => __('Normal Pages','qpages'),
	'link'      => 'admin/pages.php?type=normal&cat='.$cat,
	'selected'  => 'pages-normal',
	'icon'  => 'svg-rmcommon-doc text-green',
);

$options[] = array(
	'title'     => __('Redirection Pages','qpages'),
	'link'      => 'admin/pages.php?type=redir&cat='.$cat,
	'selected'  => 'pages-redir',
	'icon'  => 'svg-rmcommon-link text-primary',
);

$options[] = array(
    'title'     => __('Add page','qpages'),
    'link'      => 'admin/pages.php?action=new&cat='.$cat,
    'selected'  => 'pages-new',
	'icon'      => 'svg-rmcommon-plus-circle text-success'
);

$adminmenu[] = array(
    'title'     => __('Pages','qpages'),
    'link'      => "admin/pages.php",
    'icon'      => 'svg-rmcommon-docs text-blue-grey',
    'location'  => 'pages',
    'options'   => $options
);
