<?php
// $Id: search.func.php 981 2012-06-03 07:49:59Z mambax7@gmail.com $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

if (!defined('XOOPS_ROOT_PATH')) {
    die("XOOPS root path not defined");
}

/**
 * Función para realizar búsquedas
 */
function qpages_search($qa, $andor, $limit, $offset, $userid)
{
    global $xoopsUser, $mc;

    include_once XOOPS_ROOT_PATH.'/modules/qpages/class/qppage.class.php';

    $mc = RMSettings::module_settings('qpages');
    $db = XoopsDatabaseFactory::getDatabaseConnection();

    $sql = "SELECT * FROM ".$db->prefix("mod_qpages_pages");
    $adds = '';

    if (is_array($qa) && $count = count($qa)) {
        $adds = '';
        for ($i=0;$i<$count;$i++) {
            $adds .= $adds=='' ? "(titulo LIKE '%$qa[$i]%' OR titulo_amigo LIKE '%$qa[$i]%')" : " $andor (titulo LIKE '%$qa[$i]%' OR titulo_amigo LIKE '%$qa[$i]%')";
        }
    }

    $sql .= $adds!='' ? " WHERE $adds" : '';
    if ($userid>0) {
        $sql .= ($adds!='' ? " AND " : " WHERE ")."uid='$userid'";
    }
    $sql .= " ORDER BY modificado DESC";

    $i = 0;
    $result = $db->query($sql);
    $ret = array();
    while ($row = $db->fetchArray($result)) {
        $page = new QPPage();
        $page->assignVars($row);
        $ret[$i]['image'] = "images/page.png";
        $ret[$i]['link'] = $mc['links']==0 ? 'page.php?page='.$page->getFriendTitle() : $page->getFriendTitle().'/';
        $ret[$i]['title'] = $page->getTitle();
        $ret[$i]['time'] = $page->getDate();
        $ret[$i]['uid'] = $page->uid();
        $ret[$i]['desc'] = $page->getDescription();
        $i++;
    }
    return $ret;
}
