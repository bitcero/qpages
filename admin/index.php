<?php
// $Id: index.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

define('RMCLOCATION','dashboard');
require 'header.php';

RMTemplate::get()->add_style('admin.css', 'qpages');
xoops_cp_header();

// Get data for statistics
$db = XoopsDatabaseFactory::getDatabaseConnection();
$sql = "SELECT * FROM ".$db->prefix("mod_qpages_pages")." WHERE acceso=1 ORDER BY lecturas DESC LIMIT 0, 5";
$result = $db->query($sql);
$labels = "chxt=x,y&chxl=0:";
$values = 'chd=t:';
$leg = "chdlp=bv&chdl=";
$i = 0;
$max = 0;

while($row = $db->fetchArray($result)){
	$page = new QPPage();
	$page->assignVars($row);	
	if ($i==0){
		$max = $page->getReads();
	}
	$i++;
	$labels .= "|Id:".$page->getID();
	$leg .= urlencode($page->getTitle().' ('.$page->getReads().' times)')."|";
	$values .= $page->getReads().',';
}
$values = rtrim($values, ',');
$leg = rtrim($leg, "|");

if ($max>0){
	$chart = "http://chart.apis.google.com/chart?";
	$chart .= "cht=bvs&chco=99CC00|FFCC00|0099FF|FF6600|6666FF";
	$chart .= "&".$labels.'&'.$values."&".$leg;
	$chart .= "&chbh=a,20&chs=330x300&chxr=1,0,".($max)."&chds=0,".($max+1);
	$chart .= "&chtt=".urlencode(__('Most viewed pages','qpages'));
} else {
	$chart  = '';
}

// Recent pages
$sql = "SELECT * FROM ".$db->prefix("mod_qpages_pages")." ORDER BY fecha DESC LIMIT 0, 5";
$result = $db->query($sql);
$pages = array();
while($row = $db->fetchArray($result)){
	$page = new QPPage();
	$page->assignVars($row);	
	$pages[] = array(
		'id'			=> $page->getID(),
		'title'			=> $page->getTitle(),
		'link'			=> $page->getPermaLink(),
		'desc'			=> $page->getDescription(),
		'public'		=> $page->getAccess()
	);
}

$donateButton = '<form id="paypal-form" name="_xclick" action="https://www.paypal.com/fr/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="ohervis@redmexico.com.mx">
                    <input type="hidden" name="item_name" value="MyWords Support">
                    <input type="hidden" name="amount" value=0>
                    <input type="hidden" name="currency_code" value="USD">
                    <button type="submit" class="btn btn-warning btn-sm">'.__('Support Me!','qpages').'</button>
    </form>';
$myEmail = 'a888698732624c0a1d4da48f1e5c6bb4';

RMTemplate::get()->set_help('http://redmexico.com.mx/docs/quickpages');

// Left widgets and right widgets
$left_widgets = array();
$left_widgets = RMEvents::get()->run_event('qpages.left.widgets', $left_widgets);
$right_widgets = array();
$right_widgets = RMEvents::get()->run_event('qpages.right.widgets', $right_widgets);

RMBreadCrumb::get()->add_crumb(__('Dashboard','qpages'));

include RMTemplate::get()->get_template('admin/qp_index.php', 'module', 'qpages');

xoops_cp_footer();

