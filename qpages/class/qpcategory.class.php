<?php
// $Id: qpcategory.class.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

/**
 * Clase para el manejo de categorías
 */
class QPCategory extends RMObject
{
	
	function __construct($id=''){

        $this->noTranslate = ['nameid'];
        $this->ownerType = 'module';
        $this->ownerName = 'qpages';

		$this->db = XoopsDatabaseFactory::getDatabaseConnection();
		$this->_dbtable = $this->db->prefix("mod_qpages_categos");
		$this->setNew();
		$this->initVarsFromTable();
		if ($id==''){
			return;
		}
		
		if (is_numeric($id)){
			if (!$this->loadValues($id))
				return;
		} else {
			$this->primary = 'nameid';
			if (!$this->loadValues(MyTextSanitizer::addSlashes($id)))
				return;
		}
		
		$this->primary = 'id_cat';
		$this->unsetNew();
			
	}

	function loadPages($public=1){

        if ( $public < 0 )
            $result = $this->db->query("SELECT * FROM ".$this->db->prefix("mod_qpages_pages")." WHERE category='".$this->id());
        else
		    $result = $this->db->query("SELECT * FROM ".$this->db->prefix("mod_qpages_pages")." WHERE category='".$this->id()."' AND public='$public'");

		$ret = array();
		while ($row = $this->db->fetchArray($result)){
			$ret[] = $row;
		}
		return $ret;
	}
	/**
	 * Obtiene la ruta completa de la categoría basada en names
	 */
	function getPath(){
		if ($this->parent==0) return $this->nameid.'/';
		$parent = new QPCategory($this->parent);
		return $parent->getPath() . $this->nameid.'/';
	}
	/**
	 * Obtiene el enlace a la categoría
	 */
	public function permalink(){
		global $mc, $xoopsModule, $cuSettings;
		$link = QP_URL.'/';
		$link .= $cuSettings->permalinks ? 'category/'.$this->getPath() : 'catego.php?cat='.urlencode($this->getPath());
		return $link;
	}
	/**
	 * Obtenemos las subcategorías
	 */
	public function getSubcategos(){
		global $mc, $xoopsModule;
		$result = $this->db->query("SELECT * FROM ".$this->_dbtable." WHERE parent='".$this->id()."'");
		$cats = array();
		while ($row = $this->db->fetchArray($result)){
			$ret = array();
			$ret['id'] = $row['id_cat'];
			$catego = new QPCategory();
			$catego->assignVars($row);
			$ret['name'] = $catego->name;
			$ret['link'] = $catego->permalink();
			$ret['description'] = $catego->description;
			$cats[] = $ret;
		}
		return $cats;
	}
	/**
	 * Guardamos los valores en la base de datos
	 */
	function save(){
		if ($this->saveToTable()){
			$this->setVar('id_cat', $this->db->getInsertId());
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Actualizamos los valores de la base de datos
	 */
	function update(){
		return $this->updateTable();
	}
	/**
	 * Elimina de la base de datos la categoría actual
	 */
	function delete(){
        /**
         * First, delete all pages in this category
         */
        $pages = $this->loadPages( -1 );
        foreach( $pages as $data ){
            $page = new QPPage();
            $page->setVars( $data );
            $page->delete();
            if ( $page->errors() != '' )
                $this->addError( $page->errors( ) );
        }

		if ( !$this->db->queryF("UPDATE ".$this->db->prefix("mod_qpages_categos")." SET parent='". $this->parent . "' WHERE parent='".$this->id()."'") );
            $this->addError( $this->db->error() );

		return $this->deleteFromTable();
	}
}
