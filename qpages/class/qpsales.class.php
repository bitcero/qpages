<?php
// $Id: qppage.class.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class QPSales extends RMObject {

	public function __construct($id = 0){

		$this->db =& XoopsDatabaseFactory::getDatabaseConnection();
		$this->_dbtable = $this->db->prefix('mod_qpages_sales');

		$this->setNew();
		$this->initVarsFromTable();
		$this->primary = 'id_page';

		if($id<=0) return;

		if($this->loadValues($id))
			$this->unsetNew();

	}

	public function save(){

		if ($this->isNew())
			return $this->saveToTable();
		else
			return $this->updateTable();
	}

	public function delete(){
		return $this->deleteFromTable();
	}

}
