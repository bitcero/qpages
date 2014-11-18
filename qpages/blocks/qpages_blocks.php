<?php
// $Id: qpages_blocks.php 1050 2012-09-11 19:41:22Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

function qpagesBlockCategos(){
	global $xoopsConfig, $mc;

	include_once XOOPS_ROOT_PATH.'/modules/qpages/class/qpcategory.class.php';
	include_once XOOPS_ROOT_PATH.'/modules/qpages/include/general.func.php';

	$mc =& RMSettings::module_settings('qpages');
	$db =& XoopsDatabaseFactory::getDatabaseConnection();

    if (!defined('QP_URL'))
        define('QP_URL',XOOPS_URL.($mc['links'] ? $mc['basepath'] : '/modules/qpages'));

	$block = array();
	$categos = array();
	qpArrayCategos($categos);

	foreach ($categos as $k){
		$catego = new QPCategory();
		$catego->assignVars($k);
		$rtn = array();
		$rtn['id'] = $catego->getID();
		$rtn['nombre'] = $catego->getName();
		$rtn['link'] = $catego->getLink();
		$rtn['ident'] = $k['saltos']>0 ? $k['saltos'] + 8 : 0;
		$block['categos'][] = $rtn;
	}

	return $block;

}

/**
 * Mostramos las página existentes
 */
function qpagesBlockPages($options){
	global $xoopsConfig;

    include_once XOOPS_ROOT_PATH.'/modules/qpages/class/qppage.class.php';

	$db =& XoopsDatabaseFactory::getDatabaseConnection();
	$mc =& RMSettings::module_settings('qpages');

    if (!defined('QP_URL'))
        define('QP_URL',XOOPS_URL.($mc['links'] ? $mc['basepath'] : '/modules/qpages'));

	$sql = "SELECT * FROM ".$db->prefix("mod_qpages_pages");
	if ($options[0]>0){
		$sql .= " WHERE cat='$options[0]'";
	}

	$sql .= " ORDER BY fecha DESC LIMIT 0,$options[1]";
	$block = array();
	$result = $db->query($sql);
	while ($row = $db->fetchArray($result)){
        $page = new QPPage();
        $page->assignVars($row);
		$rtn = array();
		$rtn['id'] = $page->getID();
		$rtn['titulo'] = $page->getTitle();
		$rtn['link'] = $page->getPermaLink();
		$block['pages'][] = $rtn;
	}

	return $block;

}

function qpagesBlockPagesEdit($options){

	include_once XOOPS_ROOT_PATH.'/modules/qpages/include/general.func.php';
	$categos = array();
	qpArrayCategos($categos);

	$form = __('From category:','qpages') . "<br />
			<select name='options[0]'><option value='0'".($options[0]==0 ? " selected='selected'" : '').">"._SELECT."</option>";
	foreach ($categos as $k){
		$form .= "<option value='$k[id_cat]'".($options[0]==$k['id_cat'] ? " selected='selected'" : '').">$k[nombre]</option>";
	}
	$form .= "</select><br /><br />";

	$form .= __('Number of pages','qpages') . "<br />
			<input type='text' name='options[1]' size='10' value='$options[1]' />";

	return $form;
}
