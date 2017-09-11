<?php
// $Id: general.func.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

/**
 * Esta función permite cargar una página específica y desplegar
 * toda su información
 */
function getHomePage($page){
	global $xoopsOption, $xoopsConfig;
	require_once XOOPS_ROOT_PATH.'/mainfile.php';
	
	$db =& XoopsDatabaseFactory::getDatabaseConnection();
	
	$result = $db->query("SELECT * FROM ".$db->prefix("mod_qpages_pages")." WHERE titulo_amigo='$page'");
	if ($db->getRowsNum($result)<=0) return;
	
	$row = $db->fetchArray($result);
	
	$xoopsOption['template_main'] = 'qpages_homepage.html';
	require_once XOOPS_ROOT_PATH.'/header.php';
	$tpl =& $xoopsTpl;
	$groups = explode(',',$row['grupos']);
	
	if (empty($xoopsUser)){
		if (!in_array(0, $groups)){
			return;
		}
	} else {
		$ok = false;
		foreach ($xoopsUser->getGroups() as $k){
			if ($ok) continue;
			if (in_array($k, $groups)){
				$ok = true;
			}
		}
		if (!$ok && !$xoopsUser->isAdmin()){
			return;
		}
	}
	
	$tpl->assign('xoops_pagetitle', $row['titulo']);
	$tpl->assign('page', array(
		'title'		=> $row['titulo'],
		'text'		=> MyTextSanitizer::displayTarea($row['texto'], $row['dohtml'], $row['dosmiley'], $row['doxcode'], $row['doimage'], $row['dobr']),
		'id'		=> $row['id_page'],
		'name'		=> $row['titulo_amigo']
	));
	
	require_once XOOPS_ROOT_PATH.'/footer.php';
}

function qp_get_metas(){
	$db = XoopsDatabaseFactory::getDatabaseConnection();
	$result = $db->query("SELECT name FROM ".$db->prefix("mod_qpages_meta")." GROUP BY name");
	$ret = array();
	while($row = $db->fetchArray($result)){
		$ret[] = $row['name'];
	}
	return $ret;
}
