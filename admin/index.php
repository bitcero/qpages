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
define('RMCLOCATION', 'dashboard');
require __DIR__ . '/header.php';

RMTemplate::getInstance()->add_body_class('dashboard');

xoops_cp_header();

// Get data for statistics
$db = XoopsDatabaseFactory::getDatabaseConnection();
$sql = 'SELECT * FROM ' . $db->prefix('mod_qpages_pages') . ' WHERE public=1 ORDER BY RAND() LIMIT 0, 10';
$result = $db->query($sql);
$i = 0;
$max = 0;
$stats = [];
$legend = __('%s (%u times)', 'qpages');
$colors = [
    '#04A4CC',
    '#CCA304',
    '#930B0C',
    '#8DB900',
    '#FF522A',
    '#644B8A',
    '#2AFF9F',
    '#5BB827',
    '#FF8360',
    '#FF409F',
];

while (false !== ($row = $db->fetchArray($result))) {
    $page = new QPPage();
    $page->assignVars($row);
    if ($i > 9) {
        $i = 0;
    }
    $stats[] = [
        'label' => 'ID: ' . $page->id(),
        'legend' => $page->title,
        'value' => $page->hits,
        'color' => $colors[$i],
    ];
    $i++;
}
/*
$values = rtrim($values, ',');
$leg = rtrim($leg, "|");

if ($max>0){
    $chart = "http://chart.apis.google.com/chart?";
    $chart .= "cht=bvs&chco=99CC00|FFCC00|0099FF|FF6600|6666FF";
    $chart .= "&".$labels.'&'.$values."&".$leg;
    $chart .= "&chbh=a,20&chs=960x600&chxr=1,0,".($max)."&chds=0,".($max+1);
    $chart .= "&chtt=".urlencode(__('Most viewed pages','qpages'));
} else {
    $chart  = '';
}*/

// Recent pages
$sql = 'SELECT * FROM ' . $db->prefix('mod_qpages_pages') . ' ORDER BY created DESC LIMIT 0, 10';
$result = $db->query($sql);
$pages = [];
while (false !== ($row = $db->fetchArray($result))) {
    $page = new QPPage();
    $page->assignVars($row);
    $pages[] = [
        'id' => $page->id(),
        'title' => $page->title,
        'link' => $page->permalink(),
        'desc' => $page->extract,
        'public' => $page->public,
        'type' => $page->type,
    ];
}

RMTemplate::get()->set_help('http://redmexico.com.mx/docs/quickpages');
RMTemplate::get()->add_script('https://www.google.com/jsapi');

// Left widgets and right widgets
$dashboardPanels = [];
$dashboardPanels = RMEvents::get()->trigger('qpages.dashboard.panels', $dashboardPanels);

RMBreadCrumb::get()->add_crumb(__('Dashboard', 'qpages'));

include RMTemplate::get()->path('admin/qp-index.php', 'module', 'qpages');

xoops_cp_footer();
