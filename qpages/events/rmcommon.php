<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortes <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class QpagesRmcommonPreload
{

    public function eventRmcommonLoadRightWidgets($widgets){
        global $xoopsModule;

        if (!isset($xoopsModule) || $xoopsModule->getVar('dirname')!='qpages')
            return $widgets;

        if (defined("RMCSUBLOCATION") && RMCSUBLOCATION=='new-page'){
            include_once '../widgets/qp-widgets.php';

            $id = rmc_server_var($_REQUEST, 'id', 0);
            $page = new QPPage($id);

            $widgets[] = qp_widget_basic($page);
            $widgets[] = qp_widget_visualization($page);
            $widgets[] = qp_widget_template($page);
            $widgets[] = qp_widget_image($page);

        }

        return $widgets;
    }

    /**
     * Home page
     */
    public function eventRmcommonIndexStart(){

        /**
         * Local function to assign smarty values
         * @param $page
         */
        function assign_template( $page ){
            $GLOBALS['xoopsTpl']->assign('page', array(
                'title'		=> $page->title,
                'text'		=> $page->content,
                'id'		=> $page->id(),
                'name'		=> $page->nameid,
                'mod_date'	=> sprintf(__('Last update: %s', 'qpages'), formatTimestamp($page->modified,'c')),
                'reads'		=> sprintf(__('Read %u times','qpages'), $page->hits),
                'metas'		=> $page->get_meta()
            ));
        }

        include_once XOOPS_ROOT_PATH . '/modules/qpages/class/qppage.class.php';
        $page = new QPPage();
        $page->load_home();

        if ( $page->isNew() )
            return;

        if ( $page->template == '' ){
            RMTemplate::get()->header();
            assign_template( $page );
            echo $GLOBALS['xoopsTpl']->fetch('db:qpages_page.html');
            RMTemplate::get()->footer();
            die();
        }

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

        if ( substr($page->template, -4 ) == '.php'){
            if ( isset( $data->Standalone ) && $data->Standalone )
                include $file;
            else {
                include $file;
                RMTemplate::get()->footer();
            }

        } else {
            assign_template( $page );
            if ( isset( $data->Standalone ) && $data->Standalone )
                echo $GLOBALS['xoopsTpl']->fetch($file);
            else {
                echo $GLOBALS['xoopsTpl']->fetch($file);
                RMTemplate::get()->footer();
            }
        }
        die();

    }

}