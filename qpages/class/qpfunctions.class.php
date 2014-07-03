<?php
// $Id$
// --------------------------------------------------------------
// Quick Pages
// Create simple pages easily and quickly
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class QPFunctions
{
	/**
	 * Send json response for AJAX purposes
	 * @param string Message to send
	 * @param int This is an error or no (1 or 0)
	 * @param array extra data to send
	 */
	static function jsonResponse($msg, $error = 0, $token = 0, $data = array()){
		global $xoopsSecurity;

		$ret = array();
		$ret['message'] = $msg;
		$ret['error']   = $error;
		$ret['token']   = $token==1 ? $xoopsSecurity->createToken() : '';
		$ret['data']    = $data;

		echo json_encode($ret);
		die();

	}

	/**
	 * Get template information
	 */
	static function templateInfo($path, $file){

		if(!is_file($path . '/' . $file)) return;

        $content = file_get_contents( $path . '/' . $file );

        if ( substr( $file, -4 ) == '.php' ){

            $info = array();
            preg_match( "/\/\*(.*)\*\//s", $content, $info );

        } elseif ( substr( $file, -5 ) == '.html' ){

            $info = array();
            preg_match( "/^<{\*(.*)\*\}>/sm", $content, $info );

        }

        if( !isset($info[1]))
            return false;

		$data = parse_ini_string($info[1]);
        unset($content, $info);

		return (object) array_merge(array('File' => str_replace(XOOPS_ROOT_PATH, '', $path) . '/' . $file), $data);

	}

	static function getTemplates($paths){

		$tpls = array();

        $tpls[] = (object) array(
            'Name'    => __('No template', 'qpages'),
            'File'          => ''
        );

		$lists = new XoopsLists();

		foreach($paths as $path){

			if(!is_dir($path)) continue;
			$dirs = $lists->getFileListAsArray($path);

			foreach($dirs as $file ){
                if ( substr( $file, 0, 4 ) != "tpl-" ) continue;

				$info = QPFunctions::templateInfo($path, $file);
                if (false !== $info)
                    $tpls[] = $info;
			}

		}

		return $tpls;

	}

	/**
	 * Función para obtener las categorías en un array
	 */
	static function categoriesTree(&$ret,$jumps=0,$parent=0, $exclude=null){

		$db = XoopsDatabaseFactory::getDatabaseConnection();

		$result = $db->query("SELECT * FROM ".$db->prefix("mod_qpages_categos")." WHERE parent='$parent' ORDER BY `id_cat`");

		while ($row = $db->fetchArray($result)){
			if (is_array($exclude) && (in_array($row['parent'], $exclude) || in_array($row['id_cat'], $exclude))){
				$exclude[] = $row['id_cat'];
			} else {
				$rtn = array();
				$rtn = $row;
				$rtn['jumps'] = $jumps;
				$ret[] = $rtn;
			}
			QPFunctions::categoriesTree($ret, $jumps + 1, $row['id_cat'], $exclude);
		}

		return true;

	}

	static function verboseType($type){

		switch($type){
			case 'redir':
				return __('Redirection Page','qpages');
				break;
			case 'sales':
				return __('Sales Page','qpages');
				break;
			case 'squeeze':
				return __('Squeeze Page','qpages');
				break;
			default:
				return __('Normal Page','qpages');
			break;
		}

	}

    static function toolbar( $category, $page = '' ){
        global $rmTpl;

        $pages = array(
            array(
                'caption' => __('Normal Pages','qpages'),
                'url' => 'pages.php?type=normal&category='.$category,
                'icon' => '../images/page-.png'
            ),
            array(
                'caption' => __('Redirection Pages','qpages'),
                'url' => 'pages.php?type=redir&category='.$category,
                'icon' => '../images/page-redir.png'
            )
        );
        $rmTpl->add_tool(__('Add Page','qpages'), 'pages.php?action=new&category='.$category.'&page='.$page, '../images/add.png', 'pages-new');
        $rmTpl->add_tool(__('Published','qpages'), 'pages.php?public=1&category='.$category, '../images/public.png', 'pages-public');
        $rmTpl->add_tool(__('Drafts','qpages'), 'pages.php?public=0&category='.$category, '../images/drafts.png', 'pages-draft');
        $rmTpl->add_tool(__('Pages','qpages'), '#', '../images/pages.png', 'pages-list', array(), $pages );

    }

    static function error_404(){

        header("HTTP/1.0 404 Not Found");
        if (substr(php_sapi_name(), 0, 3) == 'cgi')
            header('Status: 404 Not Found', TRUE);
        else
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');

        echo "<h1>ERROR 404. Document not Found</h1>";
        die();

    }

}