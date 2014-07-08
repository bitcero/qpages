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
    /**
     * @var string Template name
     */
    private $template_name = '';
    /**
     * @var array Template options
     */
    private $options = array();

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

        if ( $this->isNew() )
            return;

        if ( $this->template == '' )
            return true;

        $this->make_tpl_name();
		
	}

    private function make_tpl_name(){

        if ( $this->template == '' )
            return;

        $tpl_info = pathinfo( $this->template );
        $this->template_name = str_replace( "tpl-", '', $tpl_info['filename'] );

    }

    /**
     * Gets a value from template option. When name is not provided, then all options are returned
     * @param string $name Name of the option
     * @return mixed
     */
    public function tpl_option( $name = '' ){

        if ( empty( $this->options ) )
            $this->load_template_options();

        if ( $name == '' )
            return $this->options;

        if ( isset( $this->options[ $name ] ) )
            return $this->options[ $name ];

        return false;

    }

    /**
     * Sets the options for the selected template
     * @param array $options
     */
    public function set_template_options( $options ){

        $this->options = $options;

    }

    /**
     * Load options for the selected template from database
     * @return array
     */
    protected function load_template_options(){

        /*if ( $this->template_name == '' )
            return array();

        $this->options = array();
        $sql = "SELECT * FROM " . $this->db->prefix("mod_qpages_templates") . " WHERE page = " . $this->id() . " AND template = '" . $this->template_name . "';";
        $result = $this->db->query( $sql );
        while ( $row = $this->db->fetchArray( $result ) ){

            $this->options[ $row['name'] ] = $row['valuetype'] == 'array' ? json_decode($row['value'], true) : $row['value'];

        }*/

        $file = XOOPS_CACHE_PATH . '/qpages';
        $file .= '/' . $this->template_name . '-' . $this->id() . '.json';

        $this->options = json_decode( file_get_contents( $file ), true );

    }

    public function load_home(){

        $this->primary = 'home';
        if ($this->loadValues(1))
            $this->unsetNew();

        $this->primary = 'id_page';

        $tpl_info = pathinfo( $this->template );
        $this->template_name = str_replace( "tpl-", '', $tpl_info['filename'] );

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
        if ( $this->getVar('template') != '' ) $this->save_options();

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

        if ( $this->getVar('template') != '' ) $this->save_options();

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

    private function save_options(){

        /*$this->db->queryF( "DELETE FROM ".$this->db->prefix("mod_qpages_templates")." WHERE page='".$this->id()."'");
        $sql = '';

        if ( empty( $this->options ) )
            return true;

        foreach( $this->options as $name => $value ){

            $type = '';

            if ( is_array( $value ) ){
                $value = json_encode( $value );
                $type = 'array';
            }

            $sql .= ( $sql == '' ? '' : ', ') . "(".$this->id().", '$name', '$value', '$type', '".$this->template_name."')";

        }

        $sql = "INSERT INTO " . $this->db->prefix("mod_qpages_templates") . " (`page`,`name`,`value`,`valuetype`,`template`) VALUES " . $sql;

        return $this->db->queryF( $sql );*/

        if ( empty( $this->options ) )
            return true;

        $tpl_info = pathinfo( $this->getVar('template') );
        $path = XOOPS_ROOT_PATH . $tpl_info['dirname'];
        $url = XOOPS_URL . $tpl_info['dirname'];

        $file = XOOPS_CACHE_PATH . '/qpages';
        if ( !is_dir( $file ) )
            mkdir( $file, 0777 );

        $this->options['url'] = $url;
        $this->options['path'] = $path;

        $this->make_tpl_name();

        $file .= '/' . $this->template_name . '-' . $this->id() . '.json';
        file_put_contents( $file, json_encode( $this->options ) );

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
