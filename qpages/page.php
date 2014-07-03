<?php
// $Id: page.php 1050 2012-09-11 19:41:22Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

if (!defined("XOOPS_MAINFILE_INCLUDED")){
	require '../../mainfile.php';
	$header = array();
	foreach ($_REQUEST as $k => $v){
		$header[$k] = $v;
	}
}

function qp_assign_page( $page ){
    global $xoopsTpl;
    $xoopsTpl->assign('page', array(
        'title'		=> $page->title,
        'text'		=> $page->content,
        'id'		=> $page->id(),
        'name'		=> $page->nameid,
        'mod_date'	=> sprintf(__('Last update: %s', 'qpages'), formatTimestamp($page->modified,'c')),
        'reads'		=> sprintf(__('Read %u times','qpages'), $page->hits),
        'metas'		=> $page->get_meta()
    ));
}

load_mod_locale('qpages');

$xoopsOption['module_subpage'] = 'page';

if (isset($_REQUEST['page'])){
    $nombre = explode('/',$_REQUEST['page']);
} else {
    $nombre = explode('/',$request);
}

$nombre[0] = TextCleaner::sweetstring($nombre[0]);

$page = new QPPage($nombre[0]);
if ($page->isNew() || $page->getVar('public')==0){
	QPFunctions::error_404();
	die();
}

if (!in_array(0, $page->groups )){
	if (empty($xoopsUser)){
		redirect_header(QP_URL, 2, _MS_QP_NOALLOWED);
		die();
	} else {
		$ok = false;
		foreach ($xoopsUser->getGroups() as $k){
			if ($ok) continue;
			if (in_array($k, $page->groups)){
				$ok = true;
			}
		}
		if (!$ok && !$xoopsUser->isAdmin()){
			redirect_header(QP_URL, 2, _MS_QP_NOALLOWED);
			die();
		}
	}
}

if ($page->type == 'redir'){
	header('location: '.$page->url);
	die();
}

$catego = new QPCategory($page->category);

if ( $page->template != '' ){

    $file = XOOPS_ROOT_PATH . $page->template;

    $content = file_get_contents( $file );
    if ( !$content ) return;

    if ( substr( $file, -4 ) == '.php' ){

        $info = array();
        preg_match( "/\/\*(.*)\*\//s", $content, $info );

    } elseif ( substr( $file, -5 ) == '.html' ){

        $info = array();
        preg_match( "/^<{\*(.*)\*\}>/sm", $content, $info );

    }

    if( !isset($info[1])) return;

    $data = (object) parse_ini_string($info[1]);
    unset($content, $info);

    RMTemplate::get()->header();

    $xoopsTpl->assign('xoops_pagetitle', $page->title);

    if ( substr($page->template, -4 ) == '.php'){
        if ( isset( $data->Standalone ) && $data->Standalone )
            include $file;
        else {

            include $file;
            RMTemplate::get()->footer();
        }

    } else {
        qp_assign_page( $page );
        if ( isset( $data->Standalone ) && $data->Standalone )
            echo $GLOBALS['xoopsTpl']->fetch($file);
        else {
            echo $GLOBALS['xoopsTpl']->fetch($file);
            RMTemplate::get()->footer();
        }
    }
    die();

}

$xoopsOption['template_main'] = 'qpages_page.html';
require 'header.php';

// Asignamos datos de la categoría
$tpl->assign('qpcategory', array('id'=>$catego->id(),'name'=>$catego->name,'nameid'=>$catego->nameid));

$idp = 0; # ID de la categoria padre
$rutas = array();
$path = explode('/',$catego->getPath());
$tbl = $db->prefix("mod_qpages_categos");
foreach ($path as $k){
	if ($k=='') continue;
	$sql = "SELECT id_cat FROM $tbl WHERE nameid='$k' AND parent='$idp'";
	$result = $db->query($sql);
	if ($db->getRowsNum($result)>0){
		list($idp) = $db->fetchRow($result);
		$rutas[] = new QPCategory($idp);
	}
}

$location = '<a href="'.QP_URL.'" title="'.$xoopsModule->name().'">'.$xoopsModule->name().'</a> ';
$pt = array(); // Titulo de la página
$pt[] = $xoopsModule->name();
foreach($rutas as $k){
	$location .= '&raquo; <a href="'.$k->permalink().'">'.$k->name.'</a> ';
	$pt[] = $k->name;
}
$location .= '&raquo; '.$page->title;
$pt[] = $page->title;
$pagetitle = '';
for ($i=count($pt)-1;$i>=0;$i--){
	$pagetitle .= $pagetitle=='' ? $pt[$i] : " &laquo; $pt[$i]";
}

$tpl->assign('page_location',$location);
$tpl->assign('xoops_pagetitle', $pagetitle);

if ( $xoopsUser && $xoopsUser->uid() != $page->uid )
    $page->add_read();

qp_assign_page( $page );

// Páginas relacionadas
if ($mc['related']){
	$sql = "SELECT * FROM ".$db->prefix("mod_qpages_pages")." WHERE cat='".$catego->id()."' AND id_page<>'".$page->id()."' ORDER BY RAND() DESC LIMIT 0,$mc[related_num]";
	$result = $db->query($sql);
	$tpl->assign('related_num', $db->getRowsNum($result));
	while ($row = $db->fetchArray($result)){
		$rp = new QPPage();
		$rp->assignVars($row);
		$tpl->append('related', array('id'=>$rp->id(),'link'=>$rp->permalink(),'title'=>$rp->title,
				'modified'=>formatTimestamp($rp->modified,'c'),
				'hits'=>$rp->hits,'desc'=>$rp->description));
	}
}

$tpl->assign('show_related', $mc['related']);
$tpl->assign('lang_related', __('Related Pages','qpages'));
$tpl->assign('lang_page', __('Page','qpages'));
$tpl->assign('lang_modified', __('Last modification','qpages'));
$tpl->assign('lang_hits', __('Hits','qpages'));

RMEvents::get()->run_event('qpages.view.page', $page);

require 'footer.php';
