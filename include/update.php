<?php
// $Id: update.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------
// Quick Pages
// Módulo para la publicación de páginas individuales
// CopyRight © 2007 - 2008. Red México
// Autor: BitC3R0
// http://www.redmexico.com.mx
// http://www.exmsystem.net
// --------------------------------------------
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of
// the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public
// License along with this program; if not, write to the Free
// Software Foundation, Inc., 59 Temple Place, Suite 330, Boston,
// MA 02111-1307 USA
// --------------------------------------------------------
// @copyright: 2007 - 2008 Red México
// @author: BitC3R0

function xoops_module_update_qpages(&$mod){
	$db = XoopsDatabaseFactory::getDatabaseConnection();
	// Actualizamos tablas
	$db->queryF("ALTER TABLE ".$db->prefix('qpages_pages')." ADD `porder` INT(6) NOT NULL DEFAULT '0';");
	$db->queryF("ALTER TABLE ".$db->prefix('qpages_pages')." ADD `type` TINYINT(1) NOT NULL DEFAULT '0';");
	$db->queryF("ALTER TABLE ".$db->prefix('qpages_pages')." ADD `url` VARCHAR(255) NOT NULL;");
  	
  	return true;
}

?>