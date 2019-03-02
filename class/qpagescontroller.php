<?php
// $Id: qpagescontroller.php 373 2010-05-08 22:58:48Z i.bitcero $
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class QpagesController
{
    public function get_main_link()
    {
        $mc = RMSettings::module_settings('qpages');
        
        if ($mc->permalinks) {
            return XOOPS_URL.$mc->basepath;
        } else {
            return XOOPS_URL.'/modules/qpages';
        }
    }

    public static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new QpagesController();
        }

        return $instance;
    }
}
