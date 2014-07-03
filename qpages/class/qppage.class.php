<?php
// $Id: qppage.class.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

/**
 * Clase para el manejo de páginas
 */
class QPPage extends RMObject
{

	private $metas = array();
	private $squeeze = '';
	private $sales = '';

	function __construct($id=null){
		$this->db =& XoopsDatabaseFactory::getDatabaseConnection();
		$this->_dbtable = $this->db->prefix("mod_qpages_pages");
		$this->setNew();
		$this->initVarsFromTable();
		$this->setVarType('groups', XOBJ_DTYPE_ARRAY);
		
		if ($id==null) return;
	
		if ($this->loadValues($id)){
			$this->unsetNew();
		} else {
			$this->primary = "nameid";
			if ($this->loadValues($id))	$this->unsetNew();
			$this->primary = "id_page";
		}
		
	}

    public function load_home(){

        $this->primary = 'home';
        if ($this->loadValues(1))
            $this->unsetNew();

    }

	/**
	 * Funciones para el control de lecturas
	 */
	public function addHit(){
		if ($this->db->queryF("UPDATE ".$this->_dbtable." SET hits=hits+1 WHERE id_page='".$this->id()."'")){
			$this->setVar('hits', $this->getVar('hits') + 1);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Obtiene el enlace permanente al artículo
	 */
	public function permalink(){
        global $cuSettings;
		$mc = RMSettings::module_settings('qpages');
		if($cuSettings->permalinks){
			if($this->getVar('custom_url')!='')
				$rtn = XOOPS_URL.'/'.$this->getVar('custom_url').'/';
			else
				$rtn = XOOPS_URL.'/'.trim($mc->basepath,'/').'/'.$this->getVar('nameid').'/';
		}else
			$rtn = XOOPS_URL.'/modules/qpages/page.php?page='.$this->getVar('nameid');

		return $rtn;
	}
	/**
	 * Establecemos los grupos con acceso
	 * @param array $grupos
	 * @return bool
	 */
	public function setGroups($groups){

        if(!is_array($groups) || empty($groups))
            return false;
		
		return $this->setVar('groups', $groups);
	}
	
	/**
	* Meta data
	*/
	private function load_meta(){
		if (!empty($this->metas)) return;

		$result = $this->db->query("SELECT name,value FROM ".$this->db->prefix("mod_qpages_meta")." WHERE page='".$this->id()."'");
		while($row = $this->db->fetchArray($result)){
			$this->metas[$row['name']] = $row['value'];
		}
	}
	
	/**
	* Get metas from post.
	* If a meta name has not been provided then return all metas
	* @param string Meta name
	* @return string|array
	*/
	public function get_meta($name=''){
		$this->load_meta();
		
		if (trim($name)=='')
			return $this->metas;
		
		if(!isset($this->metas[$name]))
			return false;
		
		return $this->metas[$name];
		
	}
	
	/**
	* Add or modify a field
	* @param string Meta name
	* @param mixed Meta value
	* @return none
	*/
	public function add_meta($name, $value){
		if (trim($name)=='' || trim($value)=='') return;
		
		$this->metas[$name] = $value;
	}

	/**
	 * Actualizamos los valores en la base de datos
	 */
	public function update(){
		
		if (!empty($this->metas)) $this->saveMetas();

		if(!$this->updateTable())
			return false;

		return true;
		
	}

	/**
	 * Guardamos los datos en la base de datos
	 */
	public function save(){	
		
		$return = $this->saveToTable();
		if ($return){
			$this->setVar('id_page', $this->db->getInsertId());
		}

		if (!empty($this->metas)) $this->saveMetas();

		return $return;
	}

	/**
	 * Elimina un artículo y todos sus comentarios de
	 * la base de datos.
	 */
	public function delete(){
		if(!$this->deleteFromTable())
			return false;

		$this->db->queryF("DELETE FROM ".$this->db->prefix("mod_qpages_meta")." WHERE page='".$this->id()."'");
	}

    public function add_read(){

        $sql = "UPDATE " . $this->_dbtable ." SET hits = hits+1 WHERE id_page = " . $this->id();
        return $this->db->queryF($sql);

    }
	
	/**
	* Save existing meta
	*/
	private function saveMetas(){
		
		$this->db->queryF("DELETE FROM ".$this->db->prefix("mod_qpages_meta")." WHERE page='".$this->id()."'");
		if (empty($this->metas)) return true;
		$sql = "INSERT INTO ".$this->db->prefix("mod_qpages_meta")." (`name`,`value`,`page`) VALUES ";
		$values = '';
		foreach ($this->metas as $name => $value){
			$values .= ($values=='' ? '' : ',')."('".MyTextSanitizer::addSlashes($name)."','".MyTextSanitizer::addSlashes($value)."','".$this->id()."')";
		}
		
		if ($this->db->queryF($sql.$values)){
			return true;
		} else {
			$this->addError($this->db->error());
			return false;
		}
	}
}
