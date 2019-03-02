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

function xoops_module_update_qpages($mod, $pre)
{
    global $xoopsDB;

    // Update table names and engine
    $xoopsDB->queryF('RENAME TABLE `'.$xoopsDB->prefix("qpages_categos").'` TO  `'.$xoopsDB->prefix("mod_qpages_categos").'` ;');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_categos").'` ENGINE = INNODB;');

    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_categos").'` CHANGE  `nombre`  `name` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_categos").'` CHANGE  `nombre_amigo`  `nameid` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_categos").'` CHANGE  `descripcion`  `description` TEXT NOT NULL');

    $xoopsDB->queryF('RENAME TABLE `'.$xoopsDB->prefix("qpages_meta").'` TO  `'.$xoopsDB->prefix("mod_qpages_meta").'` ;');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_meta").'` ENGINE = INNODB;');

    $xoopsDB->queryF('RENAME TABLE `'.$xoopsDB->prefix("qpages_pages").'` TO  `'.$xoopsDB->prefix("mod_qpages_pages").'` ;');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` ENGINE = INNODB;');

    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `titulo`  `title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `titulo_amigo`  `nameid` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `cat`  `category` INT( 11 ) NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `desc`  `extract` TEXT NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `texto`  `content` TEXT NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `fecha`  `created` INT( 11 ) NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `modificado`  `modified` INT( 11 ) NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `lecturas`  `hits` INT( 11 ) NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` CHANGE  `acceso`  `public` TINYINT( 1 ) NOT NULL DEFAULT '0'");
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `grupos`  `groups` TEXT NOT NULL');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` CHANGE  `type`  `type` VARCHAR( 10 ) NOT NULL');

    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` DROP `dohtml`');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` DROP `doxcode`');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` DROP `doimage`');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` DROP `dobr`');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` DROP `dosmiley`');
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages").'` DROP `porder`');

    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` ADD  `home` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `nameid`");
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` ADD  `description` VARCHAR( 255 ) NOT NULL AFTER  `extract`");
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` ADD  `custom_title` VARCHAR( 255 ) NOT NULL AFTER  `keywords`");
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` ADD  `custom_url` VARCHAR( 100 ) NOT NULL AFTER  `url`");
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` ADD  `image` MEDIUMTEXT NOT NULL AFTER  `custom_url`");
    $xoopsDB->queryF('ALTER TABLE  `'.$xoopsDB->prefix("mod_qpages_pages")."` ADD  `template` VARCHAR( 100 ) NOT NULL AFTER  `image`");


    return true;
}
