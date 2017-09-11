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

define('RMCLOCATION','categories');
require('header.php');

include_once '../include/general.func.php';

/**
 * Muestra una lista de las categorías existentes
 */
function showCategos(){
	global $xoopsModule, $xoopsSecurity;
	
	$row = array();
	QPFunctions::categoriesTree($row);
	
	$categories = array();
	$db = XoopsDatabaseFactory::getDatabaseConnection();
	foreach ($row as $k){
		$catego = new QPCategory($k['id_cat']);
		$catego->update();
		list($num) = $db->fetchRow($db->query("SELECT COUNT(*) FROM ".$db->prefix("mod_qpages_pages")." WHERE category='$k[id_cat]'"));
		$k['posts'] = $num;
		$k['name'] = str_repeat("&#8212;", $k['jumps']) . ' ' . $k['name'];
		$categories[] = $k;
	}
	
	// Event
	$categories = RMEvents::get()->run_event('qpages.categories.list',$categories);

	RMTemplate::get()->add_script('jquery.checkboxes.js', 'rmcommon');
	RMTemplate::get()->add_script('qpages.js', 'qpages');
	RMTemplate::get()->assign('xoops_pagetitle', __('Categories management', 'qpages'));

	RMBreadCrumb::get()->add_crumb(__('Categories Management','qpages'));

	xoops_cp_header();
	
	include RMTemplate::get()->get_template("admin/qp-categories.php", 'module', 'qpages');
	
	xoops_cp_footer();
	
}

/**
 * Presenta un formulario para la creación de una nueva
 * categoría para los artículos
 */
function newForm($edit=0){
	global $xoopsModule;
	
	if ($edit){
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		if ($id<=0){
			redirectMsg('cats.php', __('You must provide a category ID to edit!','qpages'), 1);
			die();
		}
		// Cargamos la categoría
		$catego = new QPCategory($id);
		// Si no existe entonces devolvemos un error
		if ($catego->isNew()){
			redirectMsg('cats.php', __('Specified category does not exists!','qpages'), 1);
			die();
		}
	}
	
	RMBreadCrumb::get()->add_crumb(__('Categories Management','qpages'), 'cats.php');
	RMBreadCrumb::get()->add_crumb(__('Edit category','qpages'));

	xoops_cp_header();
	
	$cats = array();
	QPFunctions::categoriesTree($cats, 0, 0, $edit ? array($id) : 0);
	
	$form = new RMForm([
        'title' => $edit ? __('Edit Category','qpages') : __('New Category','qpages'),
        'name' => 'frmNew',
        'id' => 'frm-new',
        'method' => 'post',
        'action' => 'cats.php',
        'data-translate' => 'true'
    ]);

	$form->addElement(new RMFormText([
        'caption' => __('Category name','qpages'),
        'name' => 'name',
        'value' => $edit ? $catego->name : '',
        'class' => 'form-control',
        'required' => null
    ]), true);

	$form->addElement(new RMFormTextArea([
        'caption' => __('Description','qpages'),
        'name' => 'description',
        'rows' => 5,
        'class' => 'form-control',
        'value' => $edit ? $catego->getVar('description','e') : ''
    ]));
	$ele = new RMFormSelect(__('Category parent','qpages'), 'parent');
	$ele->addOption(0, _SELECT, $edit ? ($catego->parent==0 ? 1 : 0) : 1);
	foreach ($cats as $k){
		$ele->addOption($k['id_cat'], str_repeat("-", $k['jumps']) . ' ' . $k['name'], $edit ? ($catego->parent==$k['id_cat'] ? 1 : 0) : 0);
	}
    $ele->add('class', 'form-control');
	$form->addElement($ele);
	$form->addElement(new RMFormHidden('op', $edit ? 'saveedit' : 'save'));
	if ($edit){
		$form->addElement(new RMFormHidden('id', $id));
	}
	$ele = new RMFormButtonGroup('',' ');
    $ele->addButton(new RMFormButton([
        'caption' => $edit ? __('Update Category','qpages') : __('Create Category','qpages'),
        'type' => 'submit',
        'class' => 'btn btn-primary'
    ]));
    $ele->addButton(new RMFormButton([
        'caption' => __('Cancel','qpages'),
        'type' => 'button',
        'class' => 'btn btn-default',
        'onclick' => 'history.go(-1);'
    ]));
	$form->addElement($ele);
	$form->display();
	
	xoops_cp_footer();
	
}

/**
 * Almacenamos la categoría en la base de datos
 */
function saveCatego($edit = 0){
	
	$name = RMHttpRequest::post( 'name', 'string', '' );
	$description = RMHttpRequest::post( 'description', 'string', '' );
	$id = RMHttpRequest::post( 'id', 'integer', 0 );
	$parent = RMHttpRequest::post( 'parent', 'integer', 0 );

	if ($edit && $id<=0){
		RMuris::redirect_with_message( __('You must provide a category ID to edit!','qpages'), 'cats.php', RMMSG_ERROR );
		die();
	}
	
	if ($name==''){
		RMUris::redirect_with_message( __('Please provide a name for this category!','qpages'), 'cats.php', RMMSG_WARN );
		die();
	}
	
	$nameid = TextCleaner::getInstance()->sweetstring($name);
	
	$db = XoopsDatabaseFactory::getDatabaseConnection();
	
	# Verificamos que no exista la categoría
	$result = $db->query("SELECT COUNT(*) FROM ".$db->prefix("mod_qpages_categos")." WHERE parent='$parent'".($edit ? " AND id_cat<>$id" : '')." AND (name='$name' OR nameid='$nameid')");
	list($num) = $db->fetchRow($result);

	if ($num>0){
		RMUris::redirect_with_message( __('There is another category with same name!','qpages'), 'cats.php', RMMSG_ERROR );
		die();
	}
	
	# Si todo esta bien guardamos la categoría
	$catego = new QPCategory($edit ? $id : null);
	$catego->setVar('name', $name);
	$catego->setVar('nameid', $nameid);
	$catego->setVar('description', $description);
	$catego->setVar('parent', $parent);
	if ($edit){
		$result = $catego->update();
	} else {
		$result = $catego->save();
	}
	if ($result){
		RMUris::redirect_with_message( __('Database updated successfully!','qpages'), 'cats.php', RMMSG_SUCCESS );
	} else {
		RMuris::redirect_with_message( __('Errors ocurred while trying to update database') . "<br />" . $catego->errors(), 'cats.php', RMMSG_ERROR );
	}
	
}
/**
 * Elimina una categoría de la base de datos.
 * Las subcategorías pertenecientes a esta categoría no son eliminadas,
 * sino que son asignadas a la categoría superior.
 */
function deleteCatego(){
	global $db, $xoopsModule, $xoopsSecurity;
	
	$ids = rmc_server_var($_POST, 'ids', array());
	
	if (!$xoopsSecurity->check()){
		redirectMsg('cats.php',__('Session token expired!','qpages'), 1);
		die();
	}
	
	if (!is_array($ids)){
		redirectMsg('cats.php', __('No category has been selected!','qpages'), 1);
		die();
	}
	
	$errors = '';
	
	foreach($ids as $id){
		
		if ($id<=0){
			$errors .= sprintf(__('ID "%s" is not valid!','qpages'), $id).'<br />';
			continue;
		}
		
		$catego = new QPCategory($id);
		
		if ($catego->isNew){
			$errors .= sprintf(__('Category with ID "%s" does not exists!','qpages'), $id).'<br />';
			continue;
		}
		
		if ($catego->delete() ){
			continue;
		} else {
			$errors .= sprintf( __('Category "%s" could not be deleted!','qpages'), $catego->name).'<br />' . $catego->errors() .'<br>';
			continue;
		}	
	}
	
	if ($errors!=''){
		redirectMsg('cats.php', __('Errors ocurred while trying to delete categories','qpages').'<br />'.$errors, 1); 
	} else {
		redirectMsg('cats.php', __('Categories deleted successfully!', 'qpages'));
	}
	
}

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';

switch ($op){
	case 'new':
		newForm();
		break;
	case 'save':
		saveCatego();
		break;
	case 'saveedit':
		saveCatego(1);
		break;
	case 'edit':
		newForm(1);
		break;
	case 'delete':
		deleteCatego();
		break;
	default:
		showCategos();
		break;
}
